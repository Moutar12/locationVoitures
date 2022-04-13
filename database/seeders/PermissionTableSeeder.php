<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            ["libelle" => "Ajouter un client"],
            ["libelle" => "Consulter un client"],
            ["libelle" => "editer un client"],


            ["libelle" => "Ajouter une location"],
            ["libelle" => "Consulter une location"],
            ["libelle" => "editer une location"],


            ["libelle" => "Ajouter un article"],
            ["libelle" => "Consulter un article"],
            ["libelle" => "editer un article"],
        ]);
    }
}
