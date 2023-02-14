<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CompanyClaim;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyClaim>
 */
class CompanyClaimFactory extends Factory
{
/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyClaim::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $claim_name = $this->faker->company();
        $claim_name_kana= $this->faker->kanaName();
        $post_code= $this->faker->postcode();
        $address= $this->faker->address();
        $tel= $this->faker->phoneNumber();
        $claim_department_name= $this->faker->name();
        $claim_address_name= $this->faker->address();
        $claim_address_name_kana= $this->faker->kanaName();

        return [
            'claim_name' => $claim_name,
            'claim_name_kana'=> $claim_name_kana,
            'post_code'=> $post_code,
            'address'=> $address,
            'tel'=> $tel,
            'claim_department_name'=> $claim_department_name,
            'claim_address_name'=> $claim_address_name,
            'claim_address_name_kana'=> $claim_address_name_kana,
        ];
    }
}
