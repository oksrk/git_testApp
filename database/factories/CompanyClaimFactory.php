<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CompanyClaim;
use App\Models\Company;

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
    protected $models = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company_Id = Company::factory()->create()->id;
        $claim_Name = $this->faker->company();
        $claim_Name_Kana= $this->faker->kanaName();
        $post_Code= $this->faker->postCode();
        $address= $this->faker->address();
        $tel= $this->faker->phoneNumber();
        $claim_Department_Name= $this->faker->name();
        $claim_Address_Name= $this->faker->address();
        $claim_Address_Name_Kana= $this->faker->kanaName();

        return [
            'company_id' => $company_Id,
            'claim_name' => $claim_Name,
            'claim_name_kana'=> $claim_Name_Kana,
            'post_code'=> $post_Code,
            'address'=> $address,
            'tel'=> $tel,
            'claim_department_name'=> $claim_Department_Name,
            'claim_address_name'=> $claim_Address_Name,
            'claim_address_name_kana'=> $claim_Address_Name_Kana,
        ];
    }
}
