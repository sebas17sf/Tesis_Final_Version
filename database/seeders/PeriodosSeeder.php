<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periodo;
class PeriodosSeeder extends Seeder
{

    public function run(): void
    {
        $periodos = [
            ['Periodo' => 'APR2017-AUG17', 'numeroPeriodo' => '201710', 'PeriodoInicio' => '2017-04-04', 'PeriodoFin' => '2017-08-15'],
            ['Periodo' => 'OCT2017-FEB18', 'numeroPeriodo' => '201720', 'PeriodoInicio' => '2017-10-01', 'PeriodoFin' => '2018-02-06'],
            ['Periodo' => 'APR2018-AUG18', 'numeroPeriodo' => '201810', 'PeriodoInicio' => '2018-04-16', 'PeriodoFin' => '2018-08-27'],
            ['Periodo' => 'OCT2018-FEB19', 'numeroPeriodo' => '201811', 'PeriodoInicio' => '2018-10-30', 'PeriodoFin' => '2019-02-18'],
            ['Periodo' => 'SEP2019-JAN20', 'numeroPeriodo' => '201951', 'PeriodoInicio' => '2019-09-16', 'PeriodoFin' => '2020-01-24'],
            ['Periodo' => 'MAY2020-SEP20', 'numeroPeriodo' => '202050', 'PeriodoInicio' => '2020-05-18', 'PeriodoFin' => '2020-09-11'],
            ['Periodo' => 'NOV2020-APR21', 'numeroPeriodo' => '202051', 'PeriodoInicio' => '2020-11-30', 'PeriodoFin' => '2021-04-05'],
            ['Periodo' => 'MAY2021-SEP21', 'numeroPeriodo' => '202150', 'PeriodoInicio' => '2021-05-17', 'PeriodoFin' => '2021-09-10'],
            ['Periodo' => 'OCT2021-MAR22', 'numeroPeriodo' => '202151', 'PeriodoInicio' => '2021-10-25', 'PeriodoFin' => '2022-03-11'],
            ['Periodo' => 'APR2022-SEP22', 'numeroPeriodo' => '202250', 'PeriodoInicio' => '2022-04-25', 'PeriodoFin' => '2022-09-01'],
            ['Periodo' => 'OCT2022-MAR23', 'numeroPeriodo' => '202251', 'PeriodoInicio' => '2022-10-24', 'PeriodoFin' => '2023-03-18'],
            ['Periodo' => 'MAY2023-SEP23', 'numeroPeriodo' => '202350', 'PeriodoInicio' => '2023-05-02', 'PeriodoFin' => '2023-09-13'],
            ['Periodo' => 'NOV2023-MAR24', 'numeroPeriodo' => '202351', 'PeriodoInicio' => '2023-11-06', 'PeriodoFin' => '2024-03-22'],
            ['Periodo' => 'MAY2024-AUG24', 'numeroPeriodo' => '202450', 'PeriodoInicio' => '2024-05-06', 'PeriodoFin' => '2024-08-30'],
        ];

        foreach ($periodos as $periodo) {
            Periodo::firstOrCreate($periodo);
        }
    }
}
