<?php

namespace Database\Seeders;

use App\Models\Auditor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionAuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(storage_path('listeAuditeurs.csv'), 'r');

        while (($data = fgetcsv($file, 86, ',')) !== false) {
            $email = $data[0]; // assuming email is the first column in the csv
            $name = explode('.', $email)[0]; // get the name before the dot
            $name = ucfirst($name); // capitalize the first letter

            $auditor = Auditor::factory()->create(); // Create an Auditor first
            $user = User::factory()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'), // Hash the password
                'roleable_id' => $auditor->id, // Set the roleable_id to the Auditor's id
                'roleable_type' => Auditor::class, // Set the roleable_type to the Auditor class
            ]);
        }

        fclose($file);
    }
}
