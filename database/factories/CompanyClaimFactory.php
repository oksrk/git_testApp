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
        $companyId = Company::factory()->create()->id;
        $claimName = $this->faker->company();
        $claimNameKana= $this->faker->kanaName();
        $postCode= $this->faker->postCode();
        $address= $this->faker->address();
        $tel= $this->faker->phoneNumber();
        $claimDepartmentName= $this->faker->name();
        $claimAddressName= $this->faker->address();
        $claimAddressNameKana= $this->faker->kanaName();

        return [
            'company_id' => $companyId,
            'claim_name' => $claimName,
            'claim_name_kana'=> $claimNameKana,
            'post_code'=> $postCode,
            'address'=> $address,
            'tel'=> $tel,
            'claim_department_name'=> $claimDepartmentName,
            'claim_address_name'=> $claimAddressName,
            'claim_address_name_kana'=> $claimAddressNameKana,
        ];
    }
}
