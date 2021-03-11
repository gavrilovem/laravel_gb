@extends('admin/index')

@section('title')
    Создание записи: новость
@endsection

@section('content')
    <form action="{{ route('admin.news.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Title</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="title" placeholder="Title"">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Description</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="description" placeholder="Another input"">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Text</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="is_private">
            <label class="form-check-label" for="defaultCheck1">
                Default checkbox
            </label>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection
