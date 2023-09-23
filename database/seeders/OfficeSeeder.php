<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = ['Mayors Office', 'ICT Office', 'Treasurers Office', 'Assessors Office', 'Supplies Office'];

        foreach($offices as $office)
        {
            Office::create([
                'name' => $office,
            ]);
        }
    }
}
