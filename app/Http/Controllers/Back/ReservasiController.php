<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Http\Requests\StoreReservasiRequest;
use App\Http\Requests\UpdateReservasiRequest;
use DateTime;
use Intervention\Image\Format;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = $this->_generateTable(['2024-09-10', '2024-09-15']);

        // print_r($data);
        // die;


        if (request()->ajax()) {

            $dateRange = [request()->input('start'), request()->input('end')]; // Misalkan rentang tanggal
            $reservations = $this->_generateTable($dateRange); // Panggil fungsi untuk generate data

            return response()->json([
                'status' => 'success',
                'data' => $reservations
            ]);
        }


        $curentDate = date('Y-m-d', time());
        $_dateStart = '2024-09-10';
        $_dateEnd = '2024-09-15';
        return view('back.reservation.index', [
            'page' => 'reservasi',
            'reservations' => $this->_generateTable([$_dateStart, $_dateEnd]),
            'date' => $curentDate
        ]);
    }


    private function _generateTable(array $date)
    {
        // Ambil data reservasi berdasarkan rentang tanggal
        $reserved = Reservasi::whereBetween('date', $date)->get();
        // dd($date[1]);

        // Tanggal awal dan akhir
        $_dateStart = new DateTime($date[0]);
        $_dateEnd = new DateTime($date[1]);

        // Menghitung selisih hari antara dua tanggal
        $interval = $_dateStart->diff($_dateEnd);

        // Clone $dateStart agar bisa dimodifikasi dalam loop
        $dateStart = clone $_dateStart;

        // Inisialisasi data reservasi tabel
        $tableReservasi = [];
        $startTime = 10; // Jam mulai
        $endTime = 22;   // Jam berakhir

        // Looping berdasarkan jumlah hari
        for ($i = 0; $i <= $interval->days; $i++) {
            $dataPerDate = []; // Data per tanggal

            // Looping untuk setiap jam dari startTime ke endTime
            for ($hour = $startTime; $hour <= $endTime; $hour++) {
                // Format waktu yang akan dicek
                $timeString = sprintf("%02d:00:00", $hour);
                $dateString = $dateStart->format('Y-m-d');

                // Cek apakah slot waktu sudah direservasi
                $isBooked = $reserved->contains(function ($reservation) use ($dateString, $timeString) {
                    return $reservation->date === $dateString && $reservation->time === $timeString;
                });

                // Tentukan status berdasarkan apakah sudah di-book atau tidak
                $status = $isBooked ? "booked" : "open";

                // Tambahkan data waktu dan status ke array
                $dataPerTime = [
                    "status" => $status,
                    "time" => $timeString,
                    "date" => $dateString
                ];
                array_push($dataPerDate, $dataPerTime);
            }

            // Pindah ke hari berikutnya
            $dateStart->modify('+1 day');

            // Masukkan data per tanggal ke tabel reservasi
            array_push($tableReservasi, [
                "date" => $dateString,
                "times" => $dataPerDate
            ]);
        }

        // Mengembalikan hasil sebagai collection agar mudah diproses di frontend
        return collect($tableReservasi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservasiRequest $request)
    {
        $data = $request->validated();
        Reservasi::create($data);
        return back()->with('success', 'reservasion has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservasi $reservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservasi $reservasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservasiRequest $request, Reservasi $reservasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
        //
    }
}
