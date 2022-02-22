<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Transaksi;
use App\TransaksiDetail;
use App\User;


class TransaksiController extends Controller
{
    public function store(Request $request){
        $validasi = Validator::make($request->all(),[
            'user_id' => 'required',
            'total_item' => 'required',
            'total_harga' => 'required',
            'name' => 'required',
            'jasa_pengiriman' => 'required',
            'ongkir' => 'required',
            'total_transfer' => 'required',
            'bank' => 'required',
            'phone' => 'required'
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_payment = "INV/PYM/".now()->format('Y-m-d')."/".rand(100, 999);
        $kode_trx = "INV/PYM/".now()->format('Y-m-d')."/".rand(100, 999);
        $kode_unik = rand(100, 999);
        $status = "MENUNGGU";
        $expired_at = now()->addDay();


        $dataTransaksi = array_merge($request->all(), [
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'expired_at' => $expired_at,
        ]);

        \DB::beginTransaction();
        $transaksi = Transaksi::create($dataTransaksi);

        foreach ($request->produks as $produk) {   //lagi lagi produk pake S karna yang dikirim array
            $detail = [
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk['id'],
                'total_item' => $produk['total_item'],
                'catatan' => $produk['catatan'],
                'total_harga' => $produk['total_harga']
            ];
        $transaksiDetail = TransaksiDetail::create($detail);
        }

        if (!empty($transaksi) && !empty($transaksiDetail)){
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => ' Transaksi Berhasil',
                'transaksi' => collect($transaksi)
            ]);
        } else {
            \DB::rollback();
            $this->error('Transaksi Gagal');
        }

    }

    public function history($id){
        
        $transaksis = Transaksi::with(['user'])->whereHas('user', function ($query) use ($id){
            $query->whereId($id);
        })->orderby("id", "desc")->get();

        foreach ($transaksis as $transaksi){
            $details = $transaksi->details;

            foreach ($details as $detail) {
                $detail->produk;
                
            }
        }



        if (!empty($transaksis)){
            return response()->json([
                'success' => 1,
                'message' => ' Transaksi Berhasil',
                'transaksis' => collect($transaksis)
            ]);
        } else {
            $this->error('Transaksi Gagal');
        }

    }

    public function batal($id){
        $transaksi = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
        if ($transaksi) {

            $transaksi->update([
                'status' => "BATAL"
            ]);

            $this->pushNotif('Transaksi Dibatalkan', "Transaksi produk ".$transaksi->details[0]->produk->name." Berhasil Dibatalkan", $transaksi->user->fcm);

            return response()->json([
                'success' => 1,
                'message' => '  Berhasil',
                'transaksi' => $transaksi
            ]);
        } else {
            return $this->error('Gagal Memuat Transaksi');
        }
    }

    public function pushNotif($title, $message, $mFcm) {

        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mFcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAAUj6A9oQ:APA91bGGIyWvAA5V2ddF-EWwUFvpt9mUuaZraSD13GZB1qVD1ProqXdDzzURKQDINPf6AUfqdSFIiY5npvUz3XGTyEzNiApzMqz-YHQ9Z-QHEqR7s1QtAfAtOf2vq_puKyPU61Y5TIVD "
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }

    public function upload(Request $request, $id){

        

        $transaksi = Transaksi::with(['details.produk', 'user'])->where('id', $id)->first();
        if ($transaksi) {

            $fileName = '';
        if($request->image->getClientOriginalName()){
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName = date('mYdHs').rand(1,100).'_'.$file;
            $request->image->move('/home/u7082880/public_html/wisnukripik/dist/transfer', $fileName);
        } else{
            return $this->error('Gagal Memuat Data');
        }

            $transaksi->update([
                'status' => "DIBAYAR",
                'buktiTransfer' => $fileName
            ]);

            $this->pushNotif('Transaksi Dibayar', "Transaksi produk ".$transaksi->details[0]->produk->name." Berhasil Dibayar", $transaksi->user->fcm);

            return response()->json([
                'success' => 1,
                'message' => '  Berhasil',
                'transaksi' => $transaksi
            ]);
        } else {
            return $this->error('Gagal Memuat Transaksi');
        }

    }

    public function error($pesan){
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
        }
}
