<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $file = storage_path('app/users.json');

        if (file_exists($file)) {
            $fillable = (new User())->getFillable();
            $users = json_decode(file_get_contents($file), true);
            foreach ($users as $user) {
                User::create(Arr::only($user, $fillable));
            }
        }
    }
}
