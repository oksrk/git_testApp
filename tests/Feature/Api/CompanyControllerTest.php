<?php

namespace Tests\Feature\Api;

use App\Models\Company;
use App\Models\CompanyClaim;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function companyRegister()
    {
        $params = $this->companyParam();

        $res = $this->postJson(route('api.company.create'), $params);
        $res->assertOk();

        $data = Company::all();
        $this->assertCount(1, $data);

        $newData = $data->last();
        $this->assertEquals($params['company_name'], $newData->company_name);
        $this->assertEquals($params['company_name_kana'], $newData->company_name_kana);
        $this->assertEquals($params['post_code'], $newData->post_code);
        $this->assertEquals($params['address'], $newData->address);
        $this->assertEquals($params['tel'], $newData->tel);
        $this->assertEquals($params['representative_name'], $newData->representative_name);
        $this->assertEquals($params['representative_name_kana'], $newData->representative_name_kana);
    }

    /**
     * @test
     */
    public function companyRegisterFailure()
    {
        $params = $this->companyParam();
        $params['company_name'] = null;

        $res = $this->postJson(route('api.company.create'), $params);
        $res->assertUnprocessable();

        $data = Company::all();
        $this->assertCount(0, $data);
    }

    /**
     * @test
     */
    public function companyDetail()
    {
        $id = Company::factory()->createOne();

        $res = $this->getJson(route('api.company.show', ['id' => $id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function companyDetailFailure()
    {
        $id = Company::factory()->createOne()->id + 1;

        $res = $this->getJson(route('api.company.show', ['id' => $id]));
        $res->assertNotFound();
    }

    /**
     * @test
     */
    public function companyUpdata()
    {
        $id = Company::factory()->createOne()->id;
        $params = $this->companyParam();

        $res = $this->putJson(route('api.company.update', ['id' => $id]), $params);
        $res->assertOk();

        $editedData = Company::find($id);
        $this->assertEquals($params['company_name'], $editedData->company_name);
        $this->assertEquals($params['company_name_kana'], $editedData->company_name_kana);
        $this->assertEquals($params['post_code'], $editedData->post_code);
        $this->assertEquals($params['address'], $editedData->address);
        $this->assertEquals($params['tel'], $editedData->tel);
        $this->assertEquals($params['representative_name'], $editedData->representative_name);
        $this->assertEquals($params['representative_name_kana'], $editedData->representative_name_kana);
    }

    /**
     * @test
     */
    public function companyUpdataFailure()
    {
        $id = Company::factory()->createOne()->id;
        $params = $this->companyParam();
        $params['company_name'] = null;

        $res = $this->putJson(route('api.company.update', ['id' => $id]), $params);
        $res->assertUnprocessable();
    }

    /**
     * @test
     */
    public function companyDelete()
    {
        $id = Company::factory()->createOne()->id;

        $res = $this->deleteJson(route('api.company.destroy', ['id' => $id]));
        $res->assertOk();
        $this->assertEquals(0, Company::count());
    }

    /**
     * @test
     */
    public function companyDeleteFailure()
    {
        $id = Company::factory()->createOne()->id + 1;

        $res = $this->deleteJson(route('api.company.destroy', ['id' => $id]));
        $res->assertNotFound();
    }

    /**
     * @test
     */
    public function companyAndClaimDelete()
    {
        $id = CompanyClaim::factory()->createOne()->company_id;

        $res = $this->deleteJson(route('api.company.destroy.and.claim', ['id' => $id]));
        $res->assertOk();
        $this->assertEquals(0, CompanyClaim::count());
        $this->assertEquals(0, Company::count());
    }

    /**
     * @test
     */
    public function companyAndClaimDeleteFailure()
    {
        $id = CompanyClaim::factory()->createOne()->company_id + 1;

        $res = $this->deleteJson(route('api.company.destroy.and.claim', ['id' => $id]));
        $res->assertNotFound();
    }

    /**
     * @test
     */
    public function companyAndClaimDetail()
    {
        $id = CompanyClaim::factory()->createOne()->company_id;

        $res = $this->getJson(route('api.company.show.and.claim', ['id' => $id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function companyAndClaimDetailFailure()
    {
        $id = CompanyClaim::factory()->createOne()->company_id + 1;

        $res = $this->getJson(route('api.company.show.and.claim', ['id' => $id]));
        $res->assertNotFound();
    }

    private function companyParam()
    {
        return [
        'company_name' => 'テスト会社',
        'company_name_kana'=> 'てすとかいしゃ',
        'post_code'=> '333-333',
        'address'=> '東京都',
        'tel'=> '090-1111-2222',
        'representative_name'=> '代表者',
        'representative_name_kana'=> 'だいひょうしゃ',
        ];
    }
}
