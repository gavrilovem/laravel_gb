<h2>Привет, {{ Auth::user()->name }}</h2>

<p><b><a href="{{route('admin.index')}}">В админку</a></b></p>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <input type="submit" value="Выход">
</form>
