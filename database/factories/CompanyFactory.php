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
        $companyName = $this->faker->company();
        $companyNameKana= $this->faker->kanaName();
        $postCode= $this->faker->postCode();
        $address= $this->faker->address();
        $tel= $this->faker->phoneNumber();
        $representativeName= $this->faker->name();
        $representativeNameKana= $this->faker->kanaName();

        return [
            'company_name' => $companyName,
            'company_name_kana'=> $companyNameKana,
            'post_code'=> $postCode,
            'address'=> $address,
            'tel'=> $tel,
            'representative_name'=> $representativeName,
            'representative_name_kana'=> $representativeNameKana,
        ];
    }
}
