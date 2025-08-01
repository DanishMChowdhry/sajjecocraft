<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
         return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->numerify('98########'), // Adjust to your format
            'address' => $this->faker->address(),
            'company_name' => $this->faker->company(),
            'company_website' => $this->faker->unique()->url(),
            'gst' => $this->faker->unique()->regexify('[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}'),
            'account_holder_name' => $this->faker->name(),
            'bank_name' => $this->faker->company() . ' Bank',
            'account_number' => $this->faker->bankAccountNumber(),
            'ifsc_code' => strtoupper($this->faker->bothify('????0#####')),
            'bank_address' => $this->faker->address(),
            'account_type' => $this->faker->randomElement(['current', 'savings']),
        ];
    }
}
