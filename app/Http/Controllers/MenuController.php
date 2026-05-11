<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Paket;
use App\Models\InfluencerTestimonial;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    private function homeCategoryLimit(string $category): int
    {
        return PHP_INT_MAX;
    }

    private function ensureDummyMenus(): void
    {
        if (!Schema::hasTable('menus')) {
            return;
        }

        if (Menu::query()->count() > 0) {
            return;
        }

        $items = [
            [
                'name' => 'Bakso Urat',
                'description' => 'Bakso urat gurih dengan kuah kaldu hangat.',
                'price' => 15000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Bakso Telur',
                'description' => 'Bakso isi telur, cocok untuk yang suka porsi lebih.',
                'price' => 18000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Bakso Tulang',
                'description' => 'Bakso tulang dengan cita rasa autentik.',
                'price' => 25000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Mie Ayam Original',
                'description' => 'Mie ayam dengan topping ayam manis gurih.',
                'price' => 14000,
                'category' => 'mie',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Mie Ayam Bakso',
                'description' => 'Mie ayam ditambah bakso, lebih kenyang.',
                'price' => 18000,
                'category' => 'mie',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Paket Hemat 1',
                'description' => '1 Bakso + 1 Es Teh.',
                'price' => 22000,
                'category' => 'paket',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Paket Hemat 2',
                'description' => '1 Mie Ayam + 1 Es Jeruk.',
                'price' => 24000,
                'category' => 'paket',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Es Teh',
                'description' => 'Es teh manis segar.',
                'price' => 5000,
                'category' => 'minuman',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Es Jeruk',
                'description' => 'Es jeruk segar.',
                'price' => 6000,
                'category' => 'minuman',
                'image' => null,
                'status' => 'active',
            ],
        ];

        foreach ($items as $item) {
            Menu::create($item);
        }
    }

    public function home()
    {
        $this->ensureDummyMenus();
        $menus = Menu::where('status', 'active')
            ->where('category', 'bakso')
            ->latest()
            ->get();
        $pakets = Paket::where('status', 'active')->get();
        $recommendedItems = Menu::where('status', 'active')
            ->where('is_recommended', true)
            ->latest()
            ->take(12)
            ->get();

        if ($recommendedItems->isEmpty()) {
            $recommendedItems = Menu::where('status', 'active')->latest()->take(12)->get();
        }
        $influencerTestimonials = InfluencerTestimonial::where('is_active', true)
            ->orderBy('display_order')
            ->latest('id')
            ->take(12)
            ->get();
        $testimonials = Testimonial::orderByDesc('created_at')->take(12)->get();

        return view('home', [
            'menus' => $menus,
            'pakets' => $pakets,
            'recommendedItems' => $recommendedItems,
            'influencerTestimonials' => $influencerTestimonials,
            'testimonials' => $testimonials,
        ]);
    }

    public function about()
    {
        $influencerTestimonials = InfluencerTestimonial::where('is_active', true)
            ->orderBy('display_order')
            ->latest('id')
            ->take(12)
            ->get();

        $testimonials = Testimonial::orderByDesc('created_at')->take(12)->get();

        return view('pages.tentang-halal', [
            'influencerTestimonials' => $influencerTestimonials,
            'testimonials' => $testimonials,
        ]);
    }

    public function publicIndex()
    {
        $this->ensureDummyMenus();
        $menus = Menu::where('status', 'active')->get();
        return view('pages.menu', [
            'menus' => $menus,
        ]);
    }

    public function filterMenu(Request $request)
    {
        $this->ensureDummyMenus();
        $category = $request->query('category', 'all');

        $query = Menu::query()->where('status', 'active');
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $menus = $query->latest()->get();

        if (!View::exists('partials.menu-items')) {
            return response()->json([
                'html' => '',
            ]);
        }

        $html = view('partials.menu-items', ['menus' => $menus])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->ensureDummyMenus();

        $q = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $status = trim((string) $request->query('status', ''));
        $recommended = trim((string) $request->query('recommended', ''));

        $menuQuery = Menu::query();

        if ($q !== '') {
            $menuQuery->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if (in_array($category, ['bakso', 'mie', 'paket', 'minuman'], true)) {
            $menuQuery->where('category', $category);
        }

        if (in_array($status, ['active', 'inactive'], true)) {
            $menuQuery->where('status', $status);
        }

        if ($recommended === '1') {
            $menuQuery->where('is_recommended', true);
        } elseif ($recommended === '0') {
            $menuQuery->where(function ($sub) {
                $sub->whereNull('is_recommended')->orWhere('is_recommended', false);
            });
        }

        $menus = $menuQuery->orderByDesc('created_at')->paginate(10, ['*'], 'menu_page')->withQueryString();

        $paketQ = trim((string) $request->query('paket_q', ''));
        $paketStatus = trim((string) $request->query('paket_status', ''));
        $paketQuery = Paket::query();

        if ($paketQ !== '') {
            $paketQuery->where(function ($sub) use ($paketQ) {
                $sub->where('name', 'like', "%{$paketQ}%")
                    ->orWhere('description', 'like', "%{$paketQ}%");
            });
        }

        if (in_array($paketStatus, ['active', 'inactive'], true)) {
            $paketQuery->where('status', $paketStatus);
        }

        $pakets = $paketQuery->orderByDesc('created_at')->paginate(10, ['*'], 'paket_page')->withQueryString();

        return view('admin.menu.index', compact('menus', 'pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|in:bakso,mie,paket,minuman',
            'status' => 'required|in:active,inactive',
            'is_recommended' => 'nullable|boolean',
        ]);

        $validated['is_recommended'] = $request->boolean('is_recommended');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $extension = strtolower($image->getClientOriginalExtension());
            if (empty($extension)) {
                $extension = 'jpg';
            }
            
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            
            // Ensure directory exists
            $uploadPath = public_path('images/menu');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Move file
            $image->move($uploadPath, $imageName);
            $validated['image'] = 'images/menu/' . $imageName;
        } else {
            $validated['image'] = null;
        }

        Menu::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|in:bakso,mie,paket,minuman',
            'status' => 'required|in:active,inactive',
            'is_recommended' => 'nullable|boolean',
        ]);

        $validated['is_recommended'] = $request->boolean('is_recommended');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Delete old image if exists
            if ($menu->image && file_exists(public_path($menu->image))) {
                @unlink(public_path($menu->image));
            }
            
            $extension = strtolower($image->getClientOriginalExtension());
            if (empty($extension)) {
                $extension = 'jpg';
            }
            
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            
            // Ensure directory exists
            $uploadPath = public_path('images/menu');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Move file
            $image->move($uploadPath, $imageName);
            $validated['image'] = 'images/menu/' . $imageName;
        } else {
            // Keep the old image if no new image is uploaded
            unset($validated['image']);
        }

        $menu->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Delete image if exists
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }
        
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus');
    }
}
