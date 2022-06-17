<?php

namespace Database\Seeders;

use App\Models\Newsletter;
use App\Models\Fields;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Newsletter::factory()->times(3)->create();
        User::factory(10)->create();
        Fields::factory()->times(50)->create();
    }
}
