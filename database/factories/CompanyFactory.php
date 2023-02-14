<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company_name = $this->faker->company();
        $company_name_kana= $this->faker->kanaName();
        $post_code= $this->faker->postcode();
        $address= $this->faker->address();
        $tel= $this->faker->phoneNumber();
        $representative_name= $this->faker->name();
        $representative_name_kana= $this->faker->kanaName();

        return [
            'company_name' => $company_name,
            'company_name_kana'=> $company_name_kana,
            'post_code'=> $post_code,
            'address'=> $address,
            'tel'=> $tel,
            'representative_name'=> $representative_name,
            'representative_name_kana'=> $representative_name_kana,
        ];
    }
}
