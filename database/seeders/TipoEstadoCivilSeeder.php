<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoEstadoCivil;

class TipoEstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoEstadoCivil::create(['nm_estado_civil' => 'Solteiro(a)']);
        TipoEstadoCivil::create(['nm_estado_civil' => 'Casado(a)']);
        TipoEstadoCivil::create(['nm_estado_civil' => 'Separado(a)']);
        TipoEstadoCivil::create(['nm_estado_civil' => 'Divorciado(a)']);
        TipoEstadoCivil::create(['nm_estado_civil' => 'Viúvo(a)']);
        TipoEstadoCivil::create(['cd_tipo_estado_civil']);
    }
}
