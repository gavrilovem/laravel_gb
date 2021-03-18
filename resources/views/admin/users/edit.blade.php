@extends('admin.index')

@section('title')
    Редактирование записи: пользователь
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.user.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleFormControlSelect1">Access level</label>
            </label><select class="form-control" id="exampleFormControlSelect1" name="access_level">
                <option value="0">Пользователь</option>
                <option value="1">Администратор</option>
            </select>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection
