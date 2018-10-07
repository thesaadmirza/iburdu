<?php

use Illuminate\Database\Seeder;
use App\Option;
class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        DB::table('options')->delete();
        Option::insert([
            ['label' => 'Site Name', 'name' => 'sitename', 'value' => 'Laravel Blog', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Description', 'name' => 'sitedesc', 'value' => 'A Blog Created with Laravel', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Kyewords', 'name' => 'keywords', 'value' => 'Laravel,Blog,PHP', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['label' => 'description', 'name' => 'description', 'value' => 'A Site Created with Laravel', 'type' => 'textarea', 'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Analytics', 'name' => 'site_analytics', 'value' => '', 'type' => 'textarea', 'created_at' => $now, 'updated_at' => $now],

            ['label' => 'Twitter', 'name' => 'twitter', 'value' => '', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Facebook', 'name' => 'facebook', 'value' => '', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
