<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AdminTestimonialController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminManagementController;
use Illuminate\Http\Request;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// Universal login (combined user/admin UI)
Route::get('/universal-login', function () { return view('auth.universal-login'); })->name('universal.login');
Route::post('/universal-login', [AuthController::class, 'universalLoginSubmit'])->name('universal.login.submit');

Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// Forgot Password (verifikasi via email OTP)
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendUserOtp'])->name('password.email');
Route::get('/forgot-password/verify', [AuthController::class, 'showUserOtpVerify'])->name('password.verify');
Route::post('/forgot-password/verify', [AuthController::class, 'verifyUserOtp'])->name('password.verify.post');

// Admin Forgot Password (verifikasi via email OTP)
Route::get('/forgot-password-admin', [AuthController::class, 'showAdminForgotPassword'])->name('admin.password.request');
Route::post('/forgot-password-admin', [AuthController::class, 'sendAdminOtp'])->name('admin.password.send-otp');
Route::get('/forgot-password-admin/verify', [AuthController::class, 'showAdminOtpVerify'])->name('admin.password.verify');
Route::post('/forgot-password-admin/verify', [AuthController::class, 'verifyAdminOtp'])->name('admin.password.verify.post');

// Backwards-compatible user-specific routes
Route::get('/user/login', [AuthController::class, 'showLogin'])->name('user.login');
Route::get('/user/register', [AuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [AuthController::class, 'register'])->name('user.register.submit')->middleware('guest');

use Illuminate\Support\Facades\Artisan;

Route::get('/run-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrasi berhasil dijalankan! Silakan coba checkout lagi.';
});

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if (isset($user->role) && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }

    return redirect()->route('home');
});

// Home page for normal users (after register/login)
Route::get('/home', [MenuController::class, 'home'])->name('home');

Route::get('/tentang-bbc', [MenuController::class, 'about'])->name('pages.tentang');

Route::get('/lokasi-dan-kontak', function () {
    return view('pages.lokasi-kontak');
})->name('pages.lokasi_kontak');

Route::get('/filter-menu', [MenuController::class, 'filterMenu'])->name('menu.filter');

Route::post('/contact', function (Request $request) {
    return back()->with('contact_success', 'Pesan berhasil dikirim.');
})->name('contact.submit');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/api/cart-count', [CartController::class, 'apiCount'])->name('cart.api.count');

    Route::get('/pesanan-saya', [PesananController::class, 'myOrders'])->name('pesanan.saya');

    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/transaksi/{orderId}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/transaksi/{orderId}/transfer-notify', [TransaksiController::class, 'notifyTransfer'])->name('transaksi.transfer.notify');
    Route::post('/transaksi/{orderId}/pay', [TransaksiController::class, 'pay'])->name('transaksi.pay');
    Route::post('/transaksi/{orderId}/upload-proof', [TransaksiController::class, 'uploadProof'])->name('transaksi.upload-proof');

    Route::get('/my-orders', [TransaksiController::class, 'index'])->name('my-orders');
});

// Public menu page (user/customer) - separate from admin CRUD
Route::get('/menu', [MenuController::class, 'publicIndex'])->name('menu.public');

// Backwards compatibility
Route::get('/menu-public', function () {
    return redirect()->route('menu.public');
});

// Admin Dashboard
Route::get('/admin/dashboard', function (Request $request) {
    $pendingCount = \App\Models\Pesanan::where('status', 'pending')->count();
    $totalOrders = \App\Models\Pesanan::count();
    $totalRevenue = \App\Models\Pesanan::where('status', 'completed')->sum('total_price');
    $totalCustomers = \App\Models\User::where('role', 'user')->count();
    $totalMenus = \App\Models\Menu::count();

    // Search & Filter for orders
    $q = trim((string) $request->query('q', ''));
    $status = trim((string) $request->query('status', ''));

    $ordersQuery = \App\Models\Pesanan::query();

    if ($q !== '') {
        $ordersQuery->where(function ($sub) use ($q) {
            $sub->where('order_id', 'like', "%{$q}%")
                ->orWhere('customer_name', 'like', "%{$q}%")
                ->orWhere('customer_email', 'like', "%{$q}%")
                ->orWhere('customer_phone', 'like', "%{$q}%");
        });
    }

    if (in_array($status, ['pending', 'confirmed', 'shipped', 'completed', 'rejected'], true)) {
        $ordersQuery->where('status', $status);
    }

    $latestOrders = $ordersQuery->orderByDesc('created_at')->paginate(5)->withQueryString();

    $monthlySalesRaw = \App\Models\Pesanan::where('status', 'completed')
        ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, SUM(total_price) as total")
        ->groupBy('ym')
        ->pluck('total', 'ym');

    $monthlySalesLabels = [];
    $monthlySalesData = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = now()->copy()->subMonths($i);
        $key = $month->format('Y-%m');
        $monthlySalesLabels[] = $month->translatedFormat('M Y');
        $monthlySalesData[] = (float) ($monthlySalesRaw[$key] ?? 0);
    }

    return view('admin.dashboard', compact(
        'pendingCount',
        'totalOrders',
        'totalRevenue',
        'totalCustomers',
        'totalMenus',
        'latestOrders',
        'monthlySalesLabels',
        'monthlySalesData'
    ));
})->name('admin.dashboard')->middleware(['auth:admin', 'admin']);

// Admin routes
Route::middleware(['auth:admin', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/kelola-pesanan', function (Request $request) {
            $recentOrders = \App\Models\Pesanan::orderByDesc('created_at')->limit(5)->get();

            $q = trim((string) $request->query('q', ''));
            $status = trim((string) $request->query('status', ''));

            $query = \App\Models\Pesanan::query();

            if ($q !== '') {
                $query->where(function ($sub) use ($q) {
                    $sub->where('order_id', 'like', "%{$q}%")
                        ->orWhere('customer_name', 'like', "%{$q}%")
                        ->orWhere('customer_email', 'like', "%{$q}%")
                        ->orWhere('customer_phone', 'like', "%{$q}%");
                });
            }

            if (in_array($status, ['pending', 'confirmed', 'shipped', 'completed', 'rejected'], true)) {
                $query->where('status', $status);
            }

            $orders = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

            return view('admin.kelola-pesanan.index', compact('recentOrders', 'orders'));
        })->name('admin.kelola_pesanan.index');

        Route::get('/kelola-pesanan/export', function () {
            $orders = \App\Models\Pesanan::orderByDesc('created_at')->get();
            $filename = 'kelola-pesanan-' . now()->format('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($orders) {
                $out = fopen('php://output', 'w');
                fwrite($out, "\xEF\xBB\xBF");

                fputcsv($out, ['ID Pesanan', 'Pelanggan', 'Total', 'Status', 'Tanggal'], ';');

                foreach ($orders as $o) {
                    $status = (string) ($o->status ?? '');

                    if ($status === 'completed') {
                        $label = 'Selesai';
                    } elseif ($status === 'shipped') {
                        $label = 'Dikirim';
                    } elseif ($status === 'rejected') {
                        $label = 'Cancel';
                    } else {
                        $label = 'Proses';
                    }

                    fputcsv($out, [
                        (string) ($o->order_id ?? ''),
                        (string) ($o->customer_name ?? ''),
                        (float) ($o->total_price ?? 0),
                        $label,
                        optional($o->created_at)->format('Y-m-d H:i:s') ?? '',
                    ], ';');
                }

                fclose($out);
            }, $filename, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        })->name('admin.kelola_pesanan.export');

        // Menu CRUD Routes (Admin)
        Route::get('/menu-management', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('/menu-management/create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('/menu-management', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/menu-management/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('/menu-management/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::delete('/menu-management/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
        Route::get('/menu-management/{id}/delete', function ($id) {
            // Redirect ke delete
            return redirect()->route('admin.menu.index');
        })->name('admin.menu.delete.get');

        // Testimoni Management Routes (Admin)
        Route::get('/testimoni', [AdminTestimonialController::class, 'index'])->name('admin.testimoni.index');
        Route::get('/testimoni/ulasan', [AdminTestimonialController::class, 'indexUlasan'])->name('admin.testimoni.ulasan');
        Route::get('/testimoni/influencer/create', [AdminTestimonialController::class, 'createInfluencer'])->name('admin.testimoni.influencer.create');
        Route::post('/testimoni/influencer', [AdminTestimonialController::class, 'storeInfluencer'])->name('admin.testimoni.influencer.store');
        Route::get('/testimoni/influencer/{id}/edit', [AdminTestimonialController::class, 'editInfluencer'])->name('admin.testimoni.influencer.edit');
        Route::put('/testimoni/influencer/{id}', [AdminTestimonialController::class, 'updateInfluencer'])->name('admin.testimoni.influencer.update');
        Route::delete('/testimoni/influencer/{id}', [AdminTestimonialController::class, 'destroyInfluencer'])->name('admin.testimoni.influencer.destroy');

        Route::post('/testimoni/customer/{id}/reply', [AdminTestimonialController::class, 'replyCustomer'])->name('admin.testimoni.customer.reply');
        Route::delete('/testimoni/customer/{id}', [AdminTestimonialController::class, 'destroyCustomer'])->name('admin.testimoni.customer.destroy');
    });

    // Paket CRUD Routes
    Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
    Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->name('paket.edit');
    Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');
    Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
    Route::get('/paket/{id}/delete', function($id) {
        // Redirect ke delete
        return redirect()->route('paket.index');
    })->name('paket.delete.get');

    // Pesanan (Orders) Routes
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{id}/confirm', [PesananController::class, 'confirm'])->name('pesanan.confirm');
    Route::get('/pesanan/{id}/reject', [PesananController::class, 'reject'])->name('pesanan.reject');
    Route::post('/pesanan/{id}/reject', [PesananController::class, 'reject'])->name('pesanan.reject.post');
    Route::get('/pesanan/{id}/ship', [PesananController::class, 'ship'])->name('pesanan.ship');
    Route::get('/pesanan/{id}/complete', [PesananController::class, 'complete'])->name('pesanan.complete');
    Route::get('/pesanan/{id}/paid', [PesananController::class, 'paid'])->name('pesanan.paid');

    // Admin Management Routes
    Route::get('/kelola-admin', [AdminManagementController::class, 'index'])->name('admin.management.index');
    Route::get('/kelola-admin/create', [AdminManagementController::class, 'create'])->name('admin.management.create');
    Route::post('/kelola-admin', [AdminManagementController::class, 'store'])->name('admin.management.store');
    Route::get('/kelola-admin/{id}/edit', [AdminManagementController::class, 'edit'])->name('admin.management.edit');
    Route::put('/kelola-admin/{id}', [AdminManagementController::class, 'update'])->name('admin.management.update');
    Route::delete('/kelola-admin/{id}', [AdminManagementController::class, 'destroy'])->name('admin.management.destroy');
    Route::get('/kelola-admin/{id}/delete', function($id) {
        return redirect()->route('admin.management.index');
    })->name('admin.management.delete.get');

    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('admin.laporan.export');
});