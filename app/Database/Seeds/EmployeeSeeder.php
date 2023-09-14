<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\EmployeeModel;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = $this->generateFakeData();
        }
        $employeeModel = new EmployeeModel();
        $employeeModel->insertBatch($data);
    }

    private function generateFakeData()
    {
        $faker = Factory::create();
        return [
            "name" => $faker->name(),
            "email" => $faker->unique()->email,
            "designation" => $faker->randomElement([
                "Backend Engineer",
                "Frontend Engineer",
                "Database Administrator",
                "Business executive",
                "Human Resource",
            ]),
            "experience" => $faker->randomDigit(),
        ];
    }
}
