<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
        
    }

    /**
     * @test
     */
    public function todoの新規作成()
    {
        $params = [
            'title' => 'test title',
            'content' => 'test content',
        ];

        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertOk();
        $data = Todo::all();

        $this->assertCount(1, $data);

        $newData = $data->last();
        $this->assertEquals($params['title'], $newData->title);
        $this->assertEquals($params['content'], $newData->content);
    }

        /**
     * @test
     */
    public function todoの新規作成失敗()
    {
        $params = [
            'title' => 'test title',
            'content' => null, // key未定義、null、空、文字列ではない、256文字以上、の場合バリデーションエラー（ステータスコード：422）が返ってくる。
        ];

        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertUnprocessable();

        $data = Todo::all();
        $this->assertCount(0, $data);
    }

    /**
     * @test
     */
    public function todoの詳細取得()
    {
        $id = Todo::factory()->createOne()->id;
        $res = $this->getJson(route('api.todo.show', ['id' => $id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function todoの詳細取得失敗()
    {
        $id = Todo::factory()->createOne()->id + 1;
        $res = $this->getJson(route('api.todo.show', ['id' => $id]));
        $res->assertNotFound(); // 存在しないidで検索をかけた結果、404エラーが返ってくる。
    }

    /**
     * @test
     */
    public function todoの更新処理()
    {
        $id = Todo::factory()->createOne()->id;
        // var_dump($id);　//factoryにて作成のid取得
        $params = [
            'title' => 'chaged title',
            'content' =>  'chaged content',
        ];

        $res = $this->putJson(route('api.todo.update', ['id' => $id]), $params);
        $res->assertOk();
        

        $editedData = Todo::find($id);
        // var_dump($editedData);exit;　//idにて確認,title,contentの更新確認
        $this->assertEquals($params['title'], $editedData->title);
        $this->assertEquals($params['content'], $editedData->content);
    }

    /**
     * @test
     */
    public function todoの更新処理失敗()
    {
        $id = Todo::factory()->createOne()->id;
        $params = [
            'title' => 'chaged title',
            'content' =>  null, // key未定義、null、空、文字列ではない、256文字以上、の場合バリデーションエラー（ステータスコード：422）が返ってくる。
        ];
        
        $res = $this->putJson(route('api.todo.update', ['id' => $id]), $params);
        $res->assertUnprocessable();

    }

    /**
     * @test
     */
    public function todoの削除処理()
    {
        $id = Todo::factory()->createOne()->id;
        // var_dump($id); //factoryにて作成のid取得
        $res = $this->deleteJson(route('api.todo.destroy', ['id' => $id]));
        $res->assertOk();
        // $deleteId = Todo::find($id); //delete実行後のidがあるか変数に代入
        // var_dump($deleteId);exit;　//idがあるか確認

    }

    /**
     * @test
     */
    public function todoの削除処理失敗()
    {
        $id = Todo::factory()->createOne()->id + 1;
        $res = $this->deleteJson(route('api.todo.destroy', ['id' => $id]));
        $res->assertNotFound();
    }
}