<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::first()) {
            $this->createSuperAdmin();
        }
    }

    public function createSuperAdmin(): void
    {
        $superAdmin = User::query()->firstOrCreate(
            [
                'email' => 'clubs@info.com',
            ],
            [
                'name' => 'Mahmoud',
                'password' => '123456',
            ],
        );

        BouncerFacade::allow($superAdmin)->everything();
    }
}
