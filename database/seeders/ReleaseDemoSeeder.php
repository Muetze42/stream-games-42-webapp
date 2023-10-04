<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Release;
use Illuminate\Support\Str;

class ReleaseDemoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $versions = [
            '1.0.0-beta.1' => true,
            '1.0.0-beta.2' => true,
            '1.0.0-beta.3' => true,
            '1.0.0-beta.4' => false,
            '1.0.0' => false,
            '1.0.1' => true,
            '1.0.2-beta.1' => true,
            '1.0.2-beta.2' => false
        ];

        $now = now()->subWeeks(6);
        $releaseId = mt_rand(10000, 9999999);

        foreach ($versions as $version => $createFile) {
            Release::updateOrCreate(
                ['tag' => $version],
                [
                    'release_id' => $releaseId = $releaseId + mt_rand(10000, 99999),
                    'download_url' => $createFile ? Str::random() : null,
                    'prerelease' => str_contains($version, '-'),
                    'published_at' => $now->addDays(mt_rand(1, 3)),
                ]
            );
        }
    }
}
