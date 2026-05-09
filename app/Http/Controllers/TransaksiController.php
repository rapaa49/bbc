<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $tab = $request->query('tab', 'semua');

        $baseQuery = Pesanan::query();
        if (!$user) {
            $baseQuery->whereRaw('1 = 0');
        } else {
            $baseQuery->where(function ($q) use ($user) {
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
        $orderIds = (clone $baseQuery)->pluck('order_id')->filter();
        $reviewedOrderIds = $orderIds->isEmpty()
            ? []
            : Testimonial::whereIn('order_id', $orderIds)->pluck('order_id')->filter()->all();

        $query = clone $baseQuery;

        if ($tab === 'belum-dibayar') {
            $query->where('status', 'pending');
        } elseif ($tab === 'diproses') {
            $query->whereIn('status', ['confirmed', 'shipped']);
        } elseif ($tab === 'selesai') {
            $query->where('status', 'completed');
            if (!empty($reviewedOrderIds)) {
                $query->whereNotIn('order_id', $reviewedOrderIds);
            }
        }

        $orders = $query->orderByDesc('created_at')->get();

        return view('user.pesanan', [
            'orders' => $orders,
            'tab' => $tab,
            'reviewedOrderIds' => $reviewedOrderIds,
        ]);
    }

    public function show(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        return view('transaksi', [
            'pesanan' => $pesanan,
        ]);
    }

    public function pay(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        if ($pesanan->status === 'pending') {
            $pesanan->update(['status' => 'confirmed']);

            // Proses Kirim Notifikasi WA ke Nomor Admin Otomatis
            // Menggunakan Fonnte (Satu Nomor Pengirim/Bot, Satu Nomor Admin/Penerima)
            $nomorAdmin = ''; 
            $tokenFonnte = 'iVYAMrABUfg37ybY3mMp'; // Ganti dengan Token Fonnte akun Bot (Pengirim)
            $pesan = "Halo Admin, pesanan baru ID *{$pesanan->order_id}* a/n *{$pesanan->customer_name}* senilai Rp " . number_format($pesanan->total_price, 0, ',', '.') . " telah dibayar dan siap diproses.\n\nSilakan cek Dashboard!";

            try {
                $response = Http::withHeaders([
                    'Authorization' => $tokenFonnte,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomorAdmin,
                    'message' => $pesan,
                ]);
                
                Log::info("Notifikasi WA terkirim ke {$nomorAdmin}. Response: " . $response->body());
            } catch (\Exception $e) {
                Log::error("Gagal kirim notifikasi WA: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi',
            'order_id' => $pesanan->order_id,
            'customer_name' => $pesanan->customer_name,
            'total_price' => $pesanan->total_price,
            'items_count' => count(is_array($pesanan->items) ? $pesanan->items : []),
        ]);
    }

    public function notifyTransfer(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        // Assuming this is called when transfer is confirmed
        if ($pesanan->status === 'pending') {
            $pesanan->update(['status' => 'confirmed']);

            // Similar notification as pay method
            $nomorAdmin = '';
            $tokenFonnte = 'iVYAMrABUfg37ybY3mMp';
            $pesan = "Halo Admin, transfer untuk pesanan ID *{$pesanan->order_id}* a/n *{$pesanan->customer_name}* senilai Rp " . number_format($pesanan->total_price, 0, ',', '.') . " telah dikonfirmasi.\n\nSilakan cek Dashboard!";

            try {
                $response = Http::withHeaders([
                    'Authorization' => $tokenFonnte,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomorAdmin,
                    'message' => $pesan,
                ]);

                Log::info("Notifikasi WA transfer terkirim ke {$nomorAdmin}. Response: " . $response->body());
            } catch (\Exception $e) {
                Log::error("Gagal kirim notifikasi WA transfer: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Transfer berhasil dikonfirmasi',
        ]);
    }

    public function uploadProof(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');

            // Validate file
            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120'
            ]);

            $filename = 'payment_proof_' . $pesanan->order_id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Create directory if not exists
            $uploadPath = public_path('uploads/payment_proofs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);

            try {
                $pesanan->update([
                    'payment_proof' => $filename,
                    'status' => 'confirmed'
                ]);
            } catch (\Exception $e) {
                // If payment_proof column doesn't exist, just update status
                if (str_contains($e->getMessage(), 'payment_proof')) {
                    $pesanan->update([
                        'status' => 'confirmed'
                    ]);
                    Log::warning("Kolom payment_proof belum ada di database, hanya update status: " . $e->getMessage());
                } else {
                    throw $e;
                }
            }

            // Kirim notifikasi WA ke Admin
            $nomorAdmin = '';
            $tokenFonnte = 'iVYAMrABUfg37ybY3mMp';
            $pesan = "Halo Admin, bukti pembayaran untuk pesanan ID *{$pesanan->order_id}* a/n *{$pesanan->customer_name}* senilai Rp " . number_format($pesanan->total_price, 0, ',', '.') . " telah diupload.\n\nSilakan verifikasi di Dashboard!";

            try {
                $response = Http::withHeaders([
                    'Authorization' => $tokenFonnte,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomorAdmin,
                    'message' => $pesan,
                ]);

                Log::info("Notifikasi WA bukti pembayaran terkirim ke {$nomorAdmin}. Response: " . $response->body());
            } catch (\Exception $e) {
                Log::error("Gagal kirim notifikasi WA: " . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Bukti pembayaran berhasil diupload',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengupload bukti pembayaran',
        ]);
    }
}
