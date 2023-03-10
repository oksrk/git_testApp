<?php

namespace Tests\Feature\Api;

use App\Models\Company;
use App\Models\CompanyClaim;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyClaimControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }
    
    /**
     * @test
     */
    public function companyClaimRegister()
    {
        $companyId = Company::factory()->create()->id;
        $params = $this->companyClaimParam();

        $res = $this->postJson(route('api.companyclaim.create',['id'=>$companyId]), $params);
        $res->assertOk();
        $data = CompanyClaim::all();

        $this->assertCount(1, $data);

        $newData = $data->last();
        $this->assertEquals($params['claim_name'], $newData->claim_name);
        $this->assertEquals($params['claim_name_kana'], $newData->claim_name_kana);
        $this->assertEquals($params['post_code'], $newData->post_code);
        $this->assertEquals($params['address'], $newData->address);
        $this->assertEquals($params['tel'], $newData->tel);
        $this->assertEquals($params['claim_department_name'], $newData->claim_department_name);
        $this->assertEquals($params['claim_address_name'], $newData->claim_address_name);
        $this->assertEquals($params['claim_address_name_kana'], $newData->claim_address_name_kana);
    }

    /**
     * @test
     */
    public function companyCialmRegisterFailure()
    {
        $companyId = Company::factory()->create()->id;
        $params = $this->companyClaimParam();
        $params['claim_name'] = null;

        $res = $this->postJson(route('api.companyclaim.create', ['id'=>$companyId]), $params);
        $res->assertUnprocessable();

        $data = CompanyClaim::all();
        $this->assertCount(0, $data);
    }

    /**
     * @test
     */
    public function companyClaimDetail()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $res = $this->getJson(route('api.companyclaim.show', ['id' => $id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function companyClaimDetailFailure()
    {
        $id = CompanyClaim::factory()->createOne()->id + 1;
        $res = $this->getJson(route('api.companyclaim.show', ['id' => $id]));
        $res->assertNotFound();
    }

    /**
     * @test
     */
    public function companyClaimUpdata()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $params = $this->companyClaimParam();

        $res = $this->putJson(route('api.companyclaim.update', ['id' => $id]), $params);
        $res->assertOk();

        $editedData = CompanyClaim::find($id);
        $this->assertEquals($params['claim_name'], $editedData->claim_name);
        $this->assertEquals($params['claim_name_kana'], $editedData->claim_name_kana);
        $this->assertEquals($params['post_code'], $editedData->post_code);
        $this->assertEquals($params['address'], $editedData->address);
        $this->assertEquals($params['tel'], $editedData->tel);
        $this->assertEquals($params['claim_department_name'], $editedData->claim_department_name);
        $this->assertEquals($params['claim_address_name'], $editedData->claim_address_name);
        $this->assertEquals($params['claim_address_name_kana'], $editedData->claim_address_name_kana);
    }

    /**
     * @test
     */
    public function companyCliamUpdataFailure()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $params = $this->companyClaimParam();
        $params['claim_name'] = null;

        $res = $this->putJson(route('api.companyclaim.update', ['id' => $id]), $params);
        $res->assertUnprocessable();
        
    }

    /**
     * @test
     */
    public function companyClaimDelete()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $res = $this->deleteJson(route('api.companyclaim.destroy', ['id'=>$id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function companyClaimDeleteFailure()
    {
        $id = CompanyClaim::factory()->createOne()->id + 1;
        $res = $this->deleteJson(route('api.companyclaim.destroy', ['id'=>$id]));
        $res->assertNotFound();
    }

    private function companyClaimParam()
    {
        return[
        'claim_name' => '?????????????????????',
        'claim_name_kana'=> '????????????????????????????????????',
        'post_code'=> '333-333',
        'address'=> '?????????',
        'tel'=> '090-1111-2222',
        'claim_department_name'=> '???????????????',
        'claim_address_name'=> '???????????????',
        'claim_address_name_kana'=> '???????????????????????????',
        ];
    }
}
