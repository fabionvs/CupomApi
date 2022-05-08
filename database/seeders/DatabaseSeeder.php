<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filial;
use App\Models\Empresa;
use App\Models\Promocao;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Cupons;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory;
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
        $user = User::create([
            'username' => 'teste@teste.com',
            'nm_nome' => 'Burger Nuts SA',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123456')
        ]);
        $empresa = Empresa::create([
            'nm_nome' => 'Burger Nuts',
             'nr_cnpj' => '0123121231232',
             'logo' => 'https://img.freepik.com/vetores-gratis/logotipo-burger_1366-144.jpg',
             'user_id' => $user->id
            ]);
        $filial = array();
        $filial[1] = Filial::create([
            'ds_endereco' => 'SQS 201 Bloco B - Asa Sul',
            'latitude' => '-15.8169455',
            'longitude' => '-47.400049',
            'empresa_id' => $empresa->id,
            'nm_categoria' => 'Cervejaria/Hamburgueria'
            ]);
        $filial[2] = Filial::create([
            'ds_endereco' => 'Rua Maria Teste 123',
            'latitude' => '-16.8169455',
            'longitude' => '-47.550049',
            'empresa_id' => $empresa->id,
            'nm_categoria' => 'Cervejaria/Hamburgueria'
        ]);
        $filial[3] = Filial::create([
            'ds_endereco' => 'Rua Joao Teste 412',
            'latitude' => '-15.8569455',
            'longitude' => '-47.980049',
            'empresa_id' => $empresa->id,
            'nm_categoria' => 'Cervejaria/Hamburgueria'
        ]);
        $filial[4] = Filial::create([
            'ds_endereco' => 'Rua Marcos Teste 42',
            'latitude' => '37.4220061',
            'longitude' => '-122.084033',
            'empresa_id' => $empresa->id,
            'nm_categoria' => 'Cervejaria/Hamburgueria'
        ]);
        $promocao[1] = Promocao::create([
            'nm_nome' => $empresa->nm_nome.' '.rand(10, 9999),
            'nr_porcentagem' => rand(5, 50),
            'st_ativo' => true,
            'dt_vencimento' => Carbon::parse('next sunday')->format("Y-m-d H:i:s"),
            'filial_id' => $filial[1]['id']
        ]);
        $promocao[2] = Promocao::create([
            'nm_nome' => $empresa->nm_nome.' '.rand(10, 9999),
            'nr_porcentagem' => rand(5, 50),
            'st_ativo' => true,
            'dt_vencimento' => Carbon::parse('next sunday')->format("Y-m-d H:i:s"),
            'filial_id' => $filial[1]['id']
        ]);
        for ($i = 1; $i <= 30; $i++) {
            $cupons[$i] = Cupons::create([
                'cd_cupom' =>  uniqid(),
                'st_ativo' => true,
                'st_consumido' => false,
                'promocao_id' => $promocao[1]['id']
            ]);
        }
        for ($i = 1; $i <= 1; $i++) {
            $cupons[$i] = Cupons::create([
                'cd_cupom' =>  uniqid(),
                'st_ativo' => true,
                'st_consumido' => false,
                'promocao_id' => $promocao[2]['id']
            ]);
        }

    }
}
