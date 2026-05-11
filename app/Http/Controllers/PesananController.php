<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PesananController extends Controller
{
    public function myOrders(Request $request)
    {
        $user = $request->user();
        $tab = (string) $request->query('tab', 'belum-bayar');

        $query = Pesanan::query();

        if ($user) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);

                if (!empty($user->email)) {
                    $q->orWhere(function ($legacy) use ($user) {
                        $legacy->whereNull('user_id')
                            ->where('customer_email', $user->email);
                    });
                }

                if (!empty($user->phone)) {
                    $q->orWhere(function ($legacy) use ($user) {
                        $legacy->whereNull('user_id')
                            ->where('customer_phone', $user->phone);
                    });
                }
            });
        }

        $orderIds = (clone $query)->pluck('order_id')->filter();
        $reviewedOrderIds = $orderIds->isEmpty()
            ? []
            : Testimonial::whereIn('order_id', $orderIds)->pluck('order_id')->filter()->all();

        if ($tab === 'diproses') {
            $query->whereIn('status', ['confirmed', 'shipped']);
        } elseif ($tab === 'beri-penilaian') {
            $query->where('status', 'completed');
            if (!empty($reviewedOrderIds)) {
                $query->whereNotIn('order_id', $reviewedOrderIds);
            }
        } else {
            $tab = 'belum-bayar';
            $query->whereIn('status', ['pending', 'paid']);
        }

        $orders = $query->orderByDesc('created_at')->get();

        return view('pages.pesanan-saya', [
            'orders' => $orders,
            'tab' => $tab,
            'reviewedOrderIds' => $reviewedOrderIds,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = trim((string) $request->query('status', ''));

        $query = Pesanan::query();

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('order_id', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%")
                    ->orWhere('customer_email', 'like', "%{$q}%")
                    ->orWhere('customer_phone', 'like', "%{$q}%");
            });
        }

        if (in_array($status, ['pending', 'paid', 'confirmed', 'shipped', 'completed', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $pesanans = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        
        // Group by status for stats
        $stats = [
            'pending' => Pesanan::where('status', 'pending')->count(),
            'paid' => Pesanan::where('status', 'paid')->count(),
            'confirmed' => Pesanan::where('status', 'confirmed')->count(),
            'shipped' => Pesanan::where('status', 'shipped')->count(),
            'completed' => Pesanan::where('status', 'completed')->count(),
            'rejected' => Pesanan::where('status', 'rejected')->count(),
        ];

        return view('admin.pesanan.index', compact('pesanans', 'stats'));
    }

    /**
     * Show the form for viewing the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Confirm the specified resource.
     */
    public function confirm($id)
    {
        Pesanan::findOrFail($id)->update(['status' => 'confirmed']);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikonfirmasi');
    }

    /**
     * Reject the specified resource.
     */
    public function reject($id, Request $request)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        Pesanan::findOrFail($id)->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('reason')
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditolak. Alasan: ' . $request->input('reason'));
    }

    /**
     * Ship the specified resource.
     */
    public function ship($id)
    {
        Pesanan::findOrFail($id)->update(['status' => 'shipped']);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikirim');
    }

    /**
     * Complete the specified resource.
     */
    public function complete($id)
    {
        Pesanan::findOrFail($id)->update(['status' => 'completed']);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diselesaikan');
    }

    /**
     * Dummy payment confirmation (no payment gateway).
     */
    public function paid($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Allow marking as paid if it's still pending, uploaded (paid), or already confirmed
        if (!in_array($pesanan->status, ['pending', 'paid', 'confirmed'])) {
            return redirect()->route('admin.kelola_pesanan.index')->with('error', 'Status pesanan tidak bisa ditandai sudah dibayar.');
        }

        $pesanan->update(['status' => 'confirmed']);

        $token = (string) config('services.fonnte.token');
        $target = trim((string) ($pesanan->customer_phone ?? ''));

        if ($token !== '' && $target !== '') {
            try {
                $targetDigits = preg_replace('/[^0-9]/', '', $target);
                if ($targetDigits !== '') {
                    if (str_starts_with($targetDigits, '0')) {
                        $targetDigits = '62' . substr($targetDigits, 1);
                    }

                    $orderLabel = (string) ($pesanan->order_id ?? $pesanan->id);
                    $total = number_format((float) ($pesanan->total_price ?? 0), 0, ',', '.');
                    $customerName = (string) ($pesanan->customer_name ?? 'Pelanggan');

                    $message = "Halo {$customerName},\n\nPembayaran kamu untuk pesanan #{$orderLabel} sudah dikonfirmasi.\nTotal: Rp {$total}\nStatus: Selesai\n\nTerima kasih sudah order di BBC.";

                    Http::withHeaders([
                        'Authorization' => $token,
                    ])->asForm()->post('https://api.fonnte.com/send', [
                        'target' => $targetDigits,
                        'message' => $message,
                        'countryCode' => '62',
                    ]);
                }
            } catch (\Throwable $e) {
                // ignore wa failures
            }
        }

        return redirect()->route('pesanan.index')->with('success', 'Pembayaran dikonfirmasi. Pesanan ditandai selesai.');
    }
}

