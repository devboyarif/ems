<?php

namespace Database\Seeders;

use App\Models\EmailGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email_groups = [
           'Marketing',
           'Support',
           'Sales',
        ];

        foreach ($email_groups as $email_group) {
            EmailGroup::create([
                'name' => $email_group,
                'slug' => \Str::slug($email_group),
            ]);
        }
    }
}
