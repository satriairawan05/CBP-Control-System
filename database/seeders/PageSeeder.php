<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageNames = ['Contract','Project','Task','Report','Payment','User'];
        $actions = ['Create', 'Read', 'Update', 'Delete'];

        foreach ($pageNames as $pageName) {
            foreach ($actions as $action) {
                if ($pageName == 'Project' && $action == 'Read') {
                    \App\Models\Page::create([
                        'page_name' => $pageName,
                        'action' => $action,
                    ]);

                    \App\Models\Page::create([
                        'page_name' => $pageName,
                        'action' => 'Print',
                    ]);
                } else {
                    \App\Models\Page::create([
                        'page_name' => $pageName,
                        'action' => $action,
                    ]);
                }
            }
        }
    }
}
