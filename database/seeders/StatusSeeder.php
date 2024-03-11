<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            new Status([
                'name' => 'Новая',
            ]),
            new Status([
                'name' => 'В работе',
            ]),
            new Status([
                'name' => 'Завершено',
            ]),
        ];


        foreach ($statuses as $status) {
            DB::table('statuses')->upsert(
                [
                    'name' => $status->name,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ],
                [
                    'name',
                ],
                [
                    "updated_at" => \Carbon\Carbon::now()
                ],
            );
        }
    }
}
