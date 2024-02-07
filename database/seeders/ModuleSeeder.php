<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleName = ['Contract','Project','Task','Report','Invoice'];
        $code = ['CTR','PRJ','TSK','RPT','INV'];

        foreach ($moduleName as $index => $module) {
            \App\Models\Module::create([
                'module' => $module,
                'code' => $code[$index] ?? null,
                'count' => 0,
                'last_month' => now()->format('m'),
                'current_month' => now()->format('m')
            ]);
        }
    }
}
