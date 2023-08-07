<?php

namespace CommunityHive\Database\seeders;

use CommunityHive\App\Models\PluginModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        PluginModel::factory()->count(10)->create();
    }
}
