@extends('admin/index')

@section('title')
    Редактирование записи: категория
@endsection

@section('content')
    <form action="{{ route('admin.category.update', ['category' => $category->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="formGroupExampleInput">Category Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name" value="{{ $category->name }}">
        </div>
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection
