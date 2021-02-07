@extends('layouts.front')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            @foreach ($users as $user)
                <h2>{{ $user->name }}</h2>
                {{-- @if (empty($user->posts))
                    <p>NO Data</p>
                @else --}}
                    @foreach ($user->posts as $post)
                        <p>{{ $post->title }}</p>
                    @endforeach
                {{-- @endif --}}
            @endforeach
        </div>
    </div>
</div>

@endsection
