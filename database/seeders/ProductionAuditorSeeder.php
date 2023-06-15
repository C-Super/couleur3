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
            $email = $data[0];
            $name = explode('.', $email)[0];
            $name = ucfirst($name);

            Auditor::factory()
                ->withUser([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ])
                ->create([
                    'address_id' => $address->id,
                ]);
        }

        fclose($file);
    }
}
