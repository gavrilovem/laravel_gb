@extends('layouts/main')

@section('content')
    <div class="col-md-8">

        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- Blog Post -->
        @forelse($newsCollection as $key => $news)
            <div class="card mb-4">
                <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ $news->title }}</h2>
                    <p class="card-text">{{ $news->description }}</p>
                    <a href="{{ route('news.show', ['id' => $news->id]) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on January 1, 2020 by
                    <a href="#">Start Bootstrap</a>
                </div>
            </div>
            @if($loop->last)
            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>
            @endif
        @empty
            <div>
                <p class="card-text">No news</p>
            </div>
        @endforelse
    </div>
@endsection
