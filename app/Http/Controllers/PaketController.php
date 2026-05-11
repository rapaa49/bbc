<?php



namespace App\Http\Controllers;



use App\Models\Paket;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;



class PaketController extends Controller

{

    private function normalizeRupiah(?string $value): ?float

    {

        if ($value === null) {

            return null;

        }



        $value = trim($value);

        if ($value === '') {

            return null;

        }



        $normalized = preg_replace('/[^0-9]/', '', $value);

        if ($normalized === null || $normalized === '') {

            return null;

        }



        return (float) $normalized;

    }



    /**

     * Display a listing of the resource.

     */

    public function index(Request $request)

    {

        $q = trim((string) $request->query('q', ''));

        $status = trim((string) $request->query('status', ''));



        $query = Paket::query();



        if ($q !== '') {

            $query->where(function ($sub) use ($q) {

                $sub->where('name', 'like', "%{$q}%")

                    ->orWhere('description', 'like', "%{$q}%");

            });

        }



        if (in_array($status, ['active', 'inactive'], true)) {

            $query->where('status', $status);

        }



        $pakets = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.paket.index', compact('pakets'));

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        try {

            return view('admin.paket.create');

        } catch (\Exception $e) {

            return redirect()->route('paket.index')->with('error', 'Gagal memuat halaman create: ' . $e->getMessage());

        }

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        $request->merge([

            'price' => $this->normalizeRupiah($request->input('price')),

            'original_price' => $this->normalizeRupiah($request->input('original_price')),

        ]);



        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'description' => 'required|string',

            'price' => 'required|numeric',

            'original_price' => 'nullable|numeric|gte:price',

            'portion' => 'required|integer|min:1',

            'status' => 'required|in:active,inactive'

        ]);



        if (!Schema::hasColumn('pakets', 'original_price')) {

            unset($validated['original_price']);

        }



        // Handle image upload

        if ($request->hasFile('image')) {

            try {

                $image = $request->file('image');

                

                // Process image even if validation fails - be more permissive

                if ($image) {

                    $extension = $image->getClientOriginalExtension();

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'];

                    

                    // Convert extension to lowercase for comparison

                    $extension = strtolower($extension);

                    

                    if (in_array($extension, $allowedExtensions) || empty($extension)) {

                        // Use a default extension if empty

                        if (empty($extension)) {

                            $extension = 'jpg';

                        }

                        

                        $imageName = time() . '_' . uniqid() . '.' . $extension;

                        

                        // Ensure directory exists

                        $uploadPath = public_path('images/paket');

                        if (!file_exists($uploadPath)) {

                            mkdir($uploadPath, 0777, true);

                        }

                        

                        // Try to move file

                        $image->move($uploadPath, $imageName);

                        $validated['image'] = 'images/paket/' . $imageName;

                    } else {

                        // Try to process anyway with original extension

                        $imageName = time() . '_' . uniqid() . '.' . $extension;

                        $uploadPath = public_path('images/paket');

                        if (!file_exists($uploadPath)) {

                            mkdir($uploadPath, 0777, true);

                        }

                        try {

                            $image->move($uploadPath, $imageName);

                            $validated['image'] = 'images/paket/' . $imageName;

                        } catch (\Exception $e) {

                            $validated['image'] = null;

                        }

                    }

                }

            } catch (\Exception $e) {

                // If upload fails, continue without image

                $validated['image'] = null;

            }

        } else {

            $validated['image'] = null;

        }



        Paket::create($validated);



        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit($id)
    {
        try {
            $paket = Paket::findOrFail($id);
            return view('admin.paket.edit', compact('paket'));
        } catch (\Exception $e) {
            return redirect()->route('paket.index')->with('error', 'Gagal memuat halaman edit: ' . $e->getMessage());
        }
    }



    /**

     * Update the specified resource in storage.

     */

    public function update(Request $request, $id)

    {

        $paket = Paket::findOrFail($id);



        $request->merge([

            'price' => $this->normalizeRupiah($request->input('price')),

            'original_price' => $this->normalizeRupiah($request->input('original_price')),

        ]);



        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'description' => 'required|string',

            'price' => 'required|numeric',

            'original_price' => 'nullable|numeric|gte:price',

            'portion' => 'required|integer|min:1',

            'status' => 'required|in:active,inactive'

        ]);



        if (!Schema::hasColumn('pakets', 'original_price')) {

            unset($validated['original_price']);

        }



        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                
                // Delete old image if exists
                if ($paket->image && file_exists(public_path($paket->image))) {
                    @unlink(public_path($paket->image));
                }
                
                $extension = strtolower($image->getClientOriginalExtension());
                if (empty($extension)) {
                    $extension = 'jpg';
                }
                
                $imageName = time() . '_' . uniqid() . '.' . $extension;
                
                // Ensure directory exists
                $uploadPath = public_path('images/paket');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                // Move file
                $image->move($uploadPath, $imageName);
                $validated['image'] = 'images/paket/' . $imageName;
            } catch (\Exception $e) {
                // If upload fails, keep old image
                unset($validated['image']);
            }
        } elseif ($request->input('remove_image') == '1') {
            // Remove image if requested
            if ($paket->image && file_exists(public_path($paket->image))) {
                @unlink(public_path($paket->image));
            }
            $validated['image'] = null;
        } else {
            // Keep the old image if no new image is uploaded
            unset($validated['image']);
        }

        $paket->update($validated);



        return redirect()->route('paket.index')->with('success', 'Paket berhasil diubah');

    }



    /**

     * Remove the specified resource from storage.

     */

    public function destroy($id)

    {

        $paket = Paket::findOrFail($id);

        

        // Delete image if exists

        if ($paket->image && file_exists(public_path($paket->image))) {

            unlink(public_path($paket->image));

        }

        

        $paket->delete();



        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus');

    }

}

