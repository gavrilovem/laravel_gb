@extends('admin/index')

@section('title')
    Добавление записи: категория
@endsection

@section('content')
    <form action="{{ route('admin.category.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Category Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name">
        </div>
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection
