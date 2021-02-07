@extends('layouts.app')

@section('content')
<div class="row">
@foreach ($posts as $post)
<div class="col-md-4">
    <div class="card mb-4 box-shadow">
        <img class="card-img-top" src="{{url($post->image)}}" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">{{ $post->title }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <form method="POST"
                    action="{{ route('admin.post.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                    <a href="{{ route('admin.post.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-success">Edit</a>
                </form>
                <a href="{{ route('front.post', ['slug' => $post->slug]) }}"
                    class="btn btn-sm btn-outline-secondary">View</a>
            </div>
                <small class="text-muted">{{ $post->created_at->diffForHumans(now()) }}</small>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@endsection
