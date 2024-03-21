<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tours')->insert([
        [
          'id' => '2a0edc99-c9fe-4206-8da5-413586667a21',
          'travelId' => 'd408be33-aa6a-4c73-a2c8-58a70ab2ba4d',
          'name' => 'ITJOR20211101',
          'startDate' => '2021-11-01',
          'endDate' => '2021-11-09',
          'price' => 199900
      ],
      [
          'id' => '7f0ff8cc-6b19-407e-9915-279ad76c0b5c',
          'travelId' => 'd408be33-aa6a-4c73-a2c8-58a70ab2ba4d',
          'name' => 'ITJOR20211112',
          'startDate' => '2021-11-12',
          'endDate' => '2021-11-20',
          'price' => 189900
      ],
      [
        'id' => '0be966b8-0a9b-4220-b9b2-e49d2cc0c2ab',
        'travelId' => 'd408be33-aa6a-4c73-a2c8-58a70ab2ba4d',
        'name' => 'ITJOR20211125',
        'startDate' => '2021-11-25',
        'endDate' => '2021-12-03',
        'price' => 214900,
    ],
    [
        'id' => '94682e59-cbbd-44f5-861f-fb06c0ce18da',
        'travelId' => '4f4bd032-e7d4-402a-bdf6-aaf6be240d53',
        'name' => 'ITICE20211101',
        'startDate' => '2021-11-01',
        'endDate' => '2021-11-08',
        'price' => 199900,
    ],
    [
        'id' => '90155d92-01e5-4c4b-a5a8-e24011fa8418',
        'travelId' => 'cbf304ae-a335-43fa-9e56-811612dcb601',
        'name' => 'ITARA20211221',
        'startDate' => '2021-12-21',
        'endDate' => '2021-12-28',
        'price' => 189900,
    ],
    [
        'id' => '9cefe1bc-eeb7-4d6d-b572-8a7aea2688d1',
        'travelId' => 'cbf304ae-a335-43fa-9e56-811612dcb601',
        'name' => 'ITARA20211221',
        'startDate' => '2022-01-03',
        'endDate' => '2022-01-10',
        'price' => 149900,
    ],
    ]);
    }
}
