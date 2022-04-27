<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '1',
            'name' => 'គ្រូបង្រៀន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '1',
            'name' => 'កម្មវិធីសិក្សា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '1',
            'name' => 'ឯកសារបង្រៀន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '1',
            'name' => 'សម្ភារៈឧបទេស',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '1',
            'name' => 'ពិន្ទុ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'បរិក្ខារថ្នាក់រៀន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'អនាម័យ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'សន្តិសុខនិង សណ្ដាប់ធ្នាប់',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'ហេដ្ឋារចនាសម្ព័ន្ត',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'សុខភាពនិង សង្គ្រោះបឋម',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'សីលធម៌',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('complain_sub_categories')->insert([
            'complain_category_id' => '2',
            'name' => 'ផ្សេងៗ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
