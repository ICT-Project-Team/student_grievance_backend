<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculties')->insert([
            'name' => 'វិទ្យាសាស្រ្ត',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'សង្គមសាស្រ្ត និង មនុស្សសាស្រ្ត',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'វិស្វកម្ម',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'សិក្សាអភិវឌ្ឍន៍',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'អប់រំ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'ភាសាបរទេស',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'មជ្ឈមណ្ឌលសហប្រតិបត្តិការកម្ពុជា-កូរ៉េ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('faculties')->insert([
            'name' => 'មជ្ឈមណ្ឌលសហប្រតិបត្តិការកម្ពុជា-ជប៉ុន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
