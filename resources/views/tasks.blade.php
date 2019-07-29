@extends('layouts.app')

@section('content')

<!-- Bootstrapの定形コード… -->

<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- メッセージの表示 -->
    @include('common.message')

    <!-- 新タスクフォーム -->
    <form action="/task" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- タスク名 -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Task</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>

        <!-- タスク追加ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa fa-plus"></i> タスク追加
                </button>
            </div>
        </div>
    </form>
</div>

<!-- TODO: 現在のタスク -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        現在のタスク
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- テーブルヘッダー -->
            <thead class="thead-dark">
                <th scope="col">#</th>
                <th scope="col">Task</th>
                <th scope="col">CreatedAt</th>
                <th scope="col">Delete</th>
            </thead>

            <!-- テーブルボディー -->
            <tbody>
                @foreach ($tasks as $idx => $task)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>

                    <!-- タスク名 -->
                    <td class="table-text">
                        <div>{{ $task->name }}</div>
                    </td>

                    <td class="table-text">
                        <div>{{ $task->created_at }}</div>
                    </td>

                    <!-- 削除ボタン -->
                    <td>
                        <form action="/task/{{ $task->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-danger" onclick="return window.confirm('削除しますか？');">
                                タスク削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
