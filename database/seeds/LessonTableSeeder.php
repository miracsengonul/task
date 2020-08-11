<?php

use App\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            'code' => 'TUR',
            'name' => 'Türkçe',
        ]);
        DB::table('lessons')->insert([
            'code' => 'MAT',
            'name' => 'Matematik',
        ]);
        DB::table('lessons')->insert([
            'code' => 'GEO',
            'name' => 'Geometri',
        ]);
        DB::table('lessons')->insert([
            'code' => 'TAR',
            'name' => 'Tarih',
        ]);
    }
}
