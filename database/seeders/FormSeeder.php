<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleName = ['Contract','Project','Task','Report','Payment'];
        $code = ['CTR','PRJ','TSK','RPT','PAY'];

        foreach ($moduleName as $index => $module) {
            \App\Models\Form::create([
                'module' => $module,
                'code' => $code[$index] ?? null,
                'count' => 0
            ]);
        }
    }
}
