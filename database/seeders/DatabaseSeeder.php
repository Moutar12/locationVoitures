<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Client;
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
        $this->call(TypeArticleTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(DureeLocationTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(StatutLocationTableSeeder::class);


        Article::factory(30)->create();
        Client::factory(30)->create();
    }
}
