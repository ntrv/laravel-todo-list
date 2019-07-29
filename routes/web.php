<?php

use App\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks,
    ]);
});

Route::post('/task', function (Request $request) {
    $request->validate([
        'name' => 'required|max:255',
    ]);

    $task = new Task;
    $task->name = $request->name;
    $task->save();
    return redirect('/')->with('message', '追加完了しました');
});

Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    return redirect('/')->with('message', '削除完了しました');
});

