<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ticketTypes = [
            ['nama' => 'Tribune', 'harga' => 1000000, 'kuota' => 100, 'keterangan' => 'Tribune Tiket', 'maksimal_pembelian' => 5],
            ['nama' => 'VIP', 'harga' => 1500000, 'kuota' => 75, 'keterangan' => 'VIP Tiket', 'maksimal_pembelian' => 3],
            ['nama' => 'Gold', 'harga' => 1000000, 'kuota' => 20, 'keterangan' => 'Gold Tiket', 'maksimal_pembelian' => 2],
            ['nama' => 'Silver', 'harga' => 750000, 'kuota' => 50, 'keterangan' => 'Silver Tiket', 'maksimal_pembelian' => 3],
            ['nama' => 'Bronze', 'harga' => 500000, 'kuota' => 50, 'keterangan' => 'Bronze Tiket', 'maksimal_pembelian' => 3],
        ];

        for ($i = 1; $i <= 10; $i++) {
            $eventId = DB::table('events')->insertGetId([
                'nama' => 'Event ' . $i,
                'lokasi' => 'Lokasi ' . chr(64 + $i),
                'provinsi' => 'Provinsi ' . $i,
                'kategori' => 'Kategori ' . $i,
                'deskripsi' => 'Deskripsi Event ' . $i,
                'informasi' => 'Informasi Event ' . $i,
                'gambar' => 'event_' . $i . '.jpg',
                'mulai' => now()->addDays($i)->format('Y-m-d H:i:s'),
                'akhir' => now()->addDays($i)->addHours(3)->format('Y-m-d H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($ticketTypes as $ticketType) {
                DB::table('tickets')->insert([
                    'event_id' => $eventId,
                    'nama' => $ticketType['nama'],
                    'harga' => $ticketType['harga'],
                    'kuota' => $ticketType['kuota'],
                    'keterangan' => $ticketType['keterangan'],
                    'maksimal_pembelian' => $ticketType['maksimal_pembelian'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
