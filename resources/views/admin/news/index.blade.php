@extends('admin/index')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('errors') }}
        </div>
    @endif
    <div><a href="{{ route('admin.news.create') }}">Создать запись</a></div>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">category&nbsp;id</th>
                <th scope="col">is&nbsp;private</th>
                <th scope="col">updated&nbsp;at</th>
                <th>Actions..</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newsCollection as $news)
                <tr>
                    <th scope="row">{{ $news->id }}</th>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->description }}</td>
                    <td>{{ $news->category_id }}</td>
                    <td>{{ $news->is_private }}</td>
                    <td><span style="white-space: nowrap">{{ $news->updated_at }}</span></td>
                    <td>
                        <a href="{{ route('news.show', ['id' => $news->id]) }}">Read</a>
                        <a href="{{ route('admin.news.edit', ['news' => $news->id]) }}">Edit</a>
                        <a style="text-decoration: line-through" href="{{ route('admin.news.destroy', ['news' => $news->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
