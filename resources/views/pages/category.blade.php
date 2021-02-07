@extends('layouts.app')

@section('content')
<div class="row">
    @if (count($category->posts) == 0)
        <div class="alert alert-warning text-center" style="width: 100%">No Posts Found</div>
    @else
        @foreach ($category->posts as $post)
            <x-post-card :post="$post"/>
        @endforeach
    @endif
</div>
@endsection
