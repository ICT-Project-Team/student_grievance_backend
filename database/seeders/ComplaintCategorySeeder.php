<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('complain_categories')->insert([
            'name' => 'ការសិក្សា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_categories')->insert([
            'name' => 'សេវាកម្ម',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_categories')->insert([
            'name' => 'ផ្សេងៗ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
