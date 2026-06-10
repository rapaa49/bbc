<?php

namespace App\Http\Controllers;

use App\Models\InfluencerTestimonial;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTestimonialController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', ''));

        $influencerQuery = InfluencerTestimonial::query()->orderBy('display_order')->latest('id');
        $customerQuery = Testimonial::query()->latest();

        if ($q !== '') {
            $influencerQuery->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('youtube_url', 'like', "%{$q}%");
            });

            $customerQuery->where(function ($sub) use ($q) {
                $sub->where('customer_name', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%")
                    ->orWhere('admin_reply', 'like', "%{$q}%");
            });
        }

        if ($type === 'influencer') {
            $customerQuery->whereRaw('1=0');
        } elseif ($type === 'customer') {
            $influencerQuery->whereRaw('1=0');
        }

        $influencerTestimonials = $influencerQuery->paginate(10, ['*'], 'influencer_page')->withQueryString();
        $customerTestimonials = $customerQuery->paginate(10, ['*'], 'customer_page')->withQueryString();

        return view('admin.testimoni.index', compact('influencerTestimonials', 'customerTestimonials'));
    }

    public function createInfluencer()
    {
        return view('admin.testimoni.create');
    }

    public function storeInfluencer(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'youtube_url' => 'required|url|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['thumbnail'] = InfluencerTestimonial::makeYoutubeThumbnailUrl($validated['youtube_url']);
        $validated['title'] = $this->normalizeInfluencerName($validated['title'] ?? null);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        InfluencerTestimonial::create($validated);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni influencer berhasil ditambahkan.');
    }

    public function editInfluencer($id)
    {
        $influencerTestimonial = InfluencerTestimonial::findOrFail($id);

        return view('admin.testimoni.edit', compact('influencerTestimonial'));
    }

    public function updateInfluencer(Request $request, $id)
    {
        $influencerTestimonial = InfluencerTestimonial::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'youtube_url' => 'required|url|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['thumbnail'] = InfluencerTestimonial::makeYoutubeThumbnailUrl($validated['youtube_url']);
        $validated['title'] = $this->normalizeInfluencerName($validated['title'] ?? null);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        $influencerTestimonial->update($validated);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni influencer berhasil diperbarui.');
    }

    public function destroyInfluencer($id)
    {
        $influencerTestimonial = InfluencerTestimonial::findOrFail($id);

        $influencerTestimonial->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni influencer berhasil dihapus.');
    }

    public function indexUlasan(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $ulasanQuery = Testimonial::query();

        if ($q !== '') {
            $ulasanQuery->where(function ($sub) use ($q) {
                $sub->where('customer_name', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        $customerTestimonials = $ulasanQuery->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.testimoni.ulasan', compact('customerTestimonials', 'q'));
    }

    public function replyCustomer(Request $request, $id)
    {
        $validated = $request->validate([
            'admin_reply' => 'nullable|string|max:2000',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update([
            'admin_reply' => $validated['admin_reply'] ?? null,
        ]);

        return back()->with('success', 'Balasan ulasan berhasil diperbarui.');
    }

    public function destroyCustomer($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return back()->with('success', 'Ulasan pelanggan berhasil dihapus.');
    }

    private function normalizeInfluencerName(?string $name): ?string
    {
        $name = trim((string) $name);

        if ($name === '') {
            return null;
        }

        $acronyms = [
            'tv' => 'TV',
            'tvri' => 'TVRI',
            'bbc' => 'BBC',
            'rcti' => 'RCTI',
            'sctv' => 'SCTV',
            'mnc' => 'MNC',
            'net' => 'NET',
            'cnn' => 'CNN',
            'id' => 'ID',
        ];

        return collect(preg_split('/\s+/', $name) ?: [])
            ->map(function (string $part) use ($acronyms) {
                return collect(explode('-', $part))
                    ->map(function (string $segment) use ($acronyms) {
                        $cleanSegment = strtolower($segment);

                        if (isset($acronyms[$cleanSegment])) {
                            return $acronyms[$cleanSegment];
                        }

                        return Str::of($cleanSegment)->headline()->toString();
                    })
                    ->implode('-');
            })
            ->implode(' ');
    }
}
