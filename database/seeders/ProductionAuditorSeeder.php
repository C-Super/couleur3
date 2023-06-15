<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Auditor;
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

        $address = Address::factory()->create([
            'street' => '1 rue de la Paix',
            'city' => 'Yverdons-les-Bains',
            'zip_code' => '1400',
            'country' => 'Suisse',
        ]);

        while (($data = fgetcsv($file, 86, ',')) !== false) {
            $email = $data[0]; // assuming email is the first column in the csv
            $name = explode('.', $email)[0]; // get the name before the dot
            $name = ucfirst($name); // capitalize the first letter

            $auditor = Auditor::factory()
                ->withUser([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('password'),
                ])
                ->create([
                    'address_id' => $address->id,
                ]);
        }

        fclose($file);
    }
}
