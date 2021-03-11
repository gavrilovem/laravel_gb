@extends('layouts/main')

@section('content')
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Contact Us
            <small>And&nbsp;we'll&nbsp;help&nbsp;you</small>
        </h1>

        <hr>

        <form action="{{ route('contact') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="formGroupExampleInput">Name</label>
                <input name="name" type="text" class="form-control" id="formGroupExampleInput" value="{{ old('name') }}" placeholder="input">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Phone number</label>
                <input name="phone" type="text" class="form-control" id="formGroupExampleInput2" value="{{ old('phone') }}" placeholder="input">
            </div>
            <button class="btn btn-primary" type="submit">Contact Us</button>
        </form>

    </div>
@endsection
