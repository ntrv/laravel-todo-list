@if (Session::has('message'))
    <!-- フォームのエラーリスト -->
    <div class="alert alert-success">
        <strong>{{ session('message') }}</strong>
    </div>
@endif
