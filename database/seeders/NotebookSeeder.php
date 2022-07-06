<?php

namespace Database\Seeders;

use App\Models\Notebook\Notebook;
use Illuminate\Database\Seeder;

class NotebookSeeder extends Seeder
{
    public function run()
    {
        Notebook::factory(20)->create();
    }
}
