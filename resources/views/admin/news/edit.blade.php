@extends('admin/index')

@section('title')
    Редактирование записи: новость
@endsection

@section('content')
    <form action="{{ route('admin.news.update', ['news' => $news->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="formGroupExampleInput">Title</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="title" placeholder="Title" value="{{ $news->title }}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Description</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="description" placeholder="Another input" value="{{ $news->description }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Text</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="3">{{ $news->text }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                {{-- Выбранная категория для редактируемой записи --}}
                <option value="{{ $news->category_id }}">{{ $categories[$news->category_id - 1]->name }}</option>
                @foreach($categories as $category)
                    @if ($category->id == $news->category_id)
                        @continue
                    @endif
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="is_private" @if ($news->is_private) checked @endif >
            <label class="form-check-label" for="defaultCheck1">
                Default checkbox
            </label>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection
