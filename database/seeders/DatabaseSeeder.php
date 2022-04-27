<?php

namespace Database\Seeders;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                FacultySeeder::class,
                DepartmentSeeder::class,
                UserSeeder::class,
                ComplaintCategorySeeder::class,
                ComplaintSubCategorySeeder::class
            ]
        );
    }
}
