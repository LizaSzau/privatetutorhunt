<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TutorSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tutors')->insert([
            'name' => ucfirst(Str::random(7)).' '.ucfirst(Str::random(6)),
        ]);
    }
}
