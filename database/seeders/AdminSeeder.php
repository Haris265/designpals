<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = new Admin;
        $admin->name = 'admin';
        $admin->email = "admin@gmail.com";
        $admin->password = Hash::make('12345678');
        //$admin->image= "user.jpg";
        $admin->save();
    }
}
