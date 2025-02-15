<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\JobType;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Fake ข้อมูล 3 ตัวสำหรับ Category
        Category::factory(4)->create();

        // Fake ข้อมูล 3 ตัวสำหรับ JobType
        JobType::factory(4)->create();

        // Fake ข้อมูล 3 ตัวสำหรับ User
        User::factory(3)->create();
    }
}
