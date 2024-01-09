<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KeluhanPelanggan;
use App\Models\KeluhanStatusHis;
use DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function randomDate()
    {
        $startDate = new DateTime("first day of -6 month");
        $endDate = new DateTime(); // Current date and time

        $randomTimestamp = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());

        $randomDate = new DateTime();
        $randomDate->setTimestamp($randomTimestamp);

        return $randomDate;
    }
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Second User',
            'email' => 'test2@example.com',
        ]);
        
        for($i=1; $i<=25; $i++) {
            $randomDate = $this->randomDate();
            \App\Models\KeluhanPelanggan::factory(1)->create([
                'user_id' => User::where('email', 'test@example.com')->first()->id,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
            \App\Models\KeluhanPelanggan::factory(1)->create([
                'user_id' => User::where('email', 'test2@example.com')->first()->id,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }

        foreach(KeluhanPelanggan::get() as $item) {
            $item->history()->create([
                'status_keluhan' => 0,
                'created_at' => $item->created_at,
            ]);
            $processDate = date('Y-m-d h:i:s', strtotime('+3 days', strtotime($item->created_at)));
            $doneDate = date('Y-m-d h:i:s', strtotime('+7 days', strtotime($item->created_at)));
            if($item->status_keluhan > 0) {
                $item->history()->create([
                    'status_keluhan' => 1,
                    'created_at' => $processDate,
                    'updated_at' => $processDate,
                ]);
            }
            if($item->status_keluhan > 1) {
                $item->history()->create([
                    'status_keluhan' => 2,
                    'created_at' => $doneDate,
                    'updated_at' => $doneDate,
                ]);
            }
        }
    }
}
