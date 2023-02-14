<?php

namespace Tests\Feature\Api;

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
    public function companyClaim_Register()
    {
        $params = $this->params();
        // dd($params);exit;

        $res = $this->postJson(route('api.companyclaim.create'), $params);
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
    public function companyCialm_Register_Failure()
    {
        $params = $this->params();
        $params['claim_name'] = null;

        $res = $this->postJson(route('api.companyclaim.create'), $params);
        $res->assertUnprocessable();

        $data = CompanyClaim::all();
        $this->assertCount(0, $data);
    }

    /**
     * @test
     */
    public function companyClaim_Detail()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $res = $this->getJson(route('api.companyclaim.show', ['id' => $id]));
        $res->assertOk();
    }
    
    /**
     * @test
     */
    public function companyClaim_Detail_Failure()
    {
        $id = CompanyClaim::factory()->createOne()->id + 1;
        $res = $this->getJson(route('api.companyclaim.show', ['id' => $id]));
        $res->assertNotFound();
    }

    /**
     * @test
     */
    public function companyClaim_Updata()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $params = $this->params();

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
    public function companyCliam_Updata_Failure()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $params = $this->params();
        $params['claim_name'] = null;

        $res = $this->putJson(route('api.companyclaim.update', ['id' => $id]), $params);
        $res->assertUnprocessable();
        
    }

    /**
     * @test
     */
    public function companyClaim_Delete()
    {
        $id = CompanyClaim::factory()->createOne()->id;
        $res = $this->deleteJson(route('api.companyclaim.destroy', ['id'=>$id]));
        $res->assertOk();
    }

    
    /**
     * @test
     */
    public function companyClaim_Delete_Failure()
    {
        $id = CompanyClaim::factory()->createOne()->id + 1;
        $res = $this->deleteJson(route('api.companyclaim.destroy', ['id'=>$id]));
        $res->assertNotFound();
    }
    
    private function params()
    {
        return[
        'claim_name' => 'テスト請求会社',
        'claim_name_kana'=> 'てすとせいきゅうかいしゃ',
        'post_code'=> '333-333',
        'address'=> '東京都',
        'tel'=> '090-1111-2222',
        'claim_department_name'=> '請求部署名',
        'claim_address_name'=> '請求先宛て',
        'claim_address_name_kana'=> 'せいきゅうさきあて',

        ];
    }
}
