<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TipoEstadoCivilSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // $this->call([
        //     \TipoEstadoCivilSeeder::class,
        // ]);
    }
}
