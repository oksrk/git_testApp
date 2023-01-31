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
    public function Todoの新規作成()
    {
        $params = [
            'title' => 'test title',
            'content' => 'test content',
        ];

        $beforeData = Todo::all();
        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertOk();

        $afterData = Todo::all();
        var_dump($res);exit;
        $diff = collect($afterData)->diff($beforeData)->all();
        $this->assertCount(1, $diff);

        $newData = $afterData->last();
        $this->assertEquals($params['title'], $newData->title);
        $this->assertEquals($params['content'], $newData->content);
    }

        /**
     * @test
     */
    public function Todoの新規作成失敗()
    {
        $params = [
            'title' => 'test title',
            'content' => null, // key未定義、null、空、文字列ではない、256文字以上、の場合バリデーションエラー（ステータスコード：422）が返ってくる。
        ];

        $beforeData = Todo::all();
        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertUnprocessable();

        $afterData = Todo::all();
        $diff = collect($afterData)->diff($beforeData)->all();
        $this->assertCount(0, $diff);
    }

    /**
     * @test
     */
    public function Todoの詳細取得()
    {
        $id = Todo::all()->first()->id;
        $res = $this->getJson(route('api.todo.show', ['id' => $id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function Todoの詳細取得失敗()
    {
        $id = Todo::all()->last()->id + 1;
        $res = $this->getJson(route('api.todo.show', ['id' => $id]));
        $res->assertNotFound(); // 存在しないidで検索をかけた結果、404エラーが返ってくる。
    }

    /**
     * @test
     */
    public function Todoの更新処理()
    {
        $id = Todo::all()->first()->id;
        $params = [
            'title' => 'chaged title',
            'content' => 'chaged content',
        ];

        $res = $this->putJson(route('api.todo.update', ['id' => $id]), $params);
        $res->assertOk();

        $editedData = Todo::find($id);
        $this->assertEquals($params['title'], $editedData->title);
        $this->assertEquals($params['content'], $editedData->content);
    }

    /**
     * @test
     */
    public function Todoの更新処理失敗()
    {
        // パラメータが不正の場合のチェック
        $id = Todo::all()->first()->id;
        $params = [
            'title' => 'chaged title',
            'content' =>  null, // key未定義、null、空、文字列ではない、256文字以上、の場合バリデーションエラー（ステータスコード：422）が返ってくる。
        ];

        $res = $this->putJson(route('api.todo.update', ['id' => $id]), $params);
        $res->assertUnprocessable();

        // idが存在しない場合のチェック
        $id = Todo::all()->last()->id + 1;
        $params = [
            'title' => 'chaged title',
            'content' => 'chaged content',
        ];

        $res = $this->putJson(route('api.todo.update', ['id' => $id]), $params);
        $res->assertNotFound();
    }

    /**
     * @test
     */
    public function Todoの削除処理()
    {
        $id = Todo::all()->first()->id;
        $res = $this->deleteJson(route('api.todo.destroy', ['id' => $id]));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function Todoの削除処理失敗()
    {
        $id = Todo::all()->last()->id + 1;
        $res = $this->deleteJson(route('api.todo.destroy', ['id' => $id]));
        $res->assertNotFound();
    }
}