<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    /**
    * @var Todo
    */
    private Todo $todo;

    /**
    * constructor function
    * @param Todo $todo
    */

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Todoの新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
        ]);
        $this->todo->fill($validated)->save();

        return ['message' => 'ok'];
    }

    /**
     * Todoの詳細取得
     *
     * @param  int $id
     * @return array
     */
    public function show(int $id)
    {
        return [
            'message' => 'ok',
            $this->todo->findOrFail($id),
        ];
    }

    /**
     * Todoの更新処理
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
        ]);
        $this->todo->findOrFail($id)->update($validated);

        return ['message' => 'ok'];
    }

    /**
     * Todoの削除処理
     *
     * @param  int $id
     * @return array
     */
    public function destroy(int $id)
    {
        $this->todo->findOrFail($id)->delete();
        return ['message' => 'ok'];
    }

}