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
    <div><a href="{{ route('admin.category.create') }}">Создать запись</a></div>
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">created&nbsp;at</th>
            <th scope="col">updated&nbsp;at</th>
            <th>Actions..</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td><span style="white-space: nowrap">{{ $category->created_at }}</span></td>
                <td><span style="white-space: nowrap">{{ $category->updated_at }}</span></td>
                <td>
                    <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}">Edit</a>
                    <a style="text-decoration: line-through" href="#">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
