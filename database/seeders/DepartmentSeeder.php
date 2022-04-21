<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'faculty_id' => 1,
            'name' => 'គណិតវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 1,
            'name' => 'រូបវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 1,
            'name' => 'ជីវវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 1,
            'name' => 'គីមី',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 1,
            'name' => 'បរិស្ថាន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 1,
            'name' => 'ព័ត៍មានវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        /////////////////////////////////
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'អក្សរសាស្ដ្រខ្មែរ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ភូមិវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ចិត្ដវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ទេសចរណ៍',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ប្រព័ន្ធផ្សព្វផ្សាយ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ប្រវត្ដិវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'សង្គមវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ទស្សនវិជ្ជា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'ភាសាវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'សង្គមកិច្ចវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 2,
            'name' => 'គ្រប់គ្រងពាណិជ្ជកម្មអន្តរជាតិ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')->insert([
            'faculty_id' => 3,
            'name' => 'វិស្វកម្មព័ត៌មានវិទ្យា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 3,
            'name' => 'វិស្វកម្មអេឡិចត្រូនិច និងទូរគមនាគមន៏',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 3,
            'name' => 'វិស្វកម្មជីវសាស្រ្ត',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')->insert([
            'faculty_id' => 4,
            'name' => 'អភិវឌ្ឍន៍សេដ្ឋកិច្ច',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 4,
            'name' => 'អភិវឌ្ឍន៍សហគមន៍',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 4,
            'name' => 'គ្រប់គ្រងធនធានធម្មជាតិ និងការអភិវឌ្ឍន៍',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')->insert([
            'faculty_id' => 5,
            'name' => 'សិក្សាអប់រំ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 5,
            'name' => 'គ្រប់គ្រងនិងអភិវឌ្ឍន៍ ឧត្តមសិក្សា',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 5,
            'name' => 'ស្រាវជ្រាវនិង បណ្តុះបណ្តាល',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'ភាសាអង់គ្លេស',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'សិក្សាអន្ដរជាតិ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'ភាសាបារាំង',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'ភាសាជប៉ុន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'ភាសាកូរ៉េ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'ភាសាចិន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 6,
            'name' => 'ភាសាថៃ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')->insert([
            'faculty_id' => 7,
            'name' => 'អភិវឌ្ឍន៍ធនធានមនុស្ស',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 7,
            'name' => 'ភាសាជប៉ុន',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 7,
            'name' => 'កម្មវិធីផ្លាស់ប្ដូរវប្បធម៌',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')->insert([
            'faculty_id' => 8,
            'name' => 'រដ្ឋបាល និងហិរញ្ញវត្ថុ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 8,
            'name' => 'អភិវឌ្ឍន៍ធនធានមនុស្ស',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 8,
            'name' => 'កម្មវិធី និងការអភិវឌ្ឍន៍',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('departments')->insert([
            'faculty_id' => 8,
            'name' => 'ទំនាក់ទំនងវប្បធម៌',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
