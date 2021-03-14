@extends('admin/index')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @elseif($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
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
                    <form method="post" action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
                        @csrf @method('delete')
                        <input class="btn btn-link" style="padding: 0" type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
