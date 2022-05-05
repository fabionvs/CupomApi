<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filial;
use App\Models\Empresa;
use App\Models\Promocao;
use App\Models\User;
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
        $user = User::create(['username' => 'burgernuts', 'nm_nome' => 'Burger Nuts SA', 'email' => 'teste@teste.com']);
        $empresa = Empresa::create(['nm_nome' => 'Burger Nuts', 'nr_cnpj' => '0123121231232', 'logo' => 'https://img.freepik.com/vetores-gratis/logotipo-burger_1366-144.jpg', 'user_id' => $user->id]);
        $filial = Filial::create(['latitude' => '-15.8169455', 'longitude' => '-47.900049', 'empresa_id' => $empresa->id, 'categoria' => 'Hamburgueria Artesanal']);
        $filial = Filial::create(['latitude' => '-16.8169455', 'longitude' => '-48.900049', 'empresa_id' => $empresa->id, 'categoria' => 'Almoço/Janta']);
        $filial = Filial::create(['latitude' => '-15.8569455', 'longitude' => '-47.980049', 'empresa_id' => $empresa->id, 'categoria' => 'Comida Japonesa']);
        $filial = Filial::create(['latitude' => '37.4220061', 'longitude' => '-122.084033', 'empresa_id' => $empresa->id, 'categoria' => 'Almoço/Janta']);
    }
}
