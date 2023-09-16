<?php

namespace Database\Seeders;

use App\Models\LoanType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = ['Personal', 'Student', 'Auto', 'Payday', 'Business'];
        foreach($loans as $loan)
        {
            LoanType::create([
                'name' => $loan,
            ]);
        }
    }
}
