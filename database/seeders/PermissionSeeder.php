<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(['admin', 'boss', 'manager', 'poweruser', 'user'])
            ->each(fn($p) => Permission::findOrCreate($p, 'senhaunica'));
    }
}
