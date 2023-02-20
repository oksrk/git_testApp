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
        $company_Name = $this->faker->company();
        $company_Name_Kana= $this->faker->kanaName();
        $post_Code= $this->faker->postCode();
        $address= $this->faker->address();
        $tel= $this->faker->phoneNumber();
        $representative_Name= $this->faker->name();
        $representative_Name_Kana= $this->faker->kanaName();

        return [
            'company_name' => $company_Name,
            'company_name_kana'=> $company_Name_Kana,
            'post_code'=> $post_Code,
            'address'=> $address,
            'tel'=> $tel,
            'representative_name'=> $representative_Name,
            'representative_name_kana'=> $representative_Name_Kana,
        ];
    }
}
