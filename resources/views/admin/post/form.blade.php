@extends('layouts.app')

@section('content')
<form method="POST"
 action="{{ isset($post) ? route('admin.post.update', ['post' => $post->id]) : route('admin.post.store') }}"
 enctype="multipart/form-data">
    @csrf
    @if (isset($post))
        @method('PUT')
    @endif

    <div class="mb-3">
      <label for="title" class="form-label">Post Title</label>
      <input type="text" name="title" value="{{ isset($post) ? $post->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" id="title" >
      @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
    <div class="mb-3">
        <label for="catgeory">Select Category</label>
        <select class="form-control @error('category') is-invalid @enderror" name="category_id" id="catgeory">
            <option></option>
            @foreach ($categories as $category)
                <option @if (isset($post) && $category->id == $post->category_id)
                    selected="selected"
            @endif
            value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach

        </select>
        @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-control-file">Choose Post Image</label>
        @if (isset($post))
        <img src="{{ url($post->image) }}" width="100" height="100"
            style="padding-bottom: 10px;">
        @endif
        <input name="image" value="{{ old('image')}}" class="form-control @error('image') is-invalid @enderror" type="file" id="image" >
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Text</label>
        <textarea name="text" class="form-control  @error('text') is-invalid @enderror" id="text" rows="3">
            {{ isset($post) ? $post->text : old('text') }}
        </textarea>
        @error('text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update' : 'Create' }}</button>
</form>
@endsection
