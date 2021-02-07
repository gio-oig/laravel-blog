@extends('layouts.app')

@section('content')
<form
 method="POST"
 action="{{ isset($category) ? route('admin.category.update', ['category' => $category->id]) : route('admin.category.store') }}">
    @csrf
    @if (isset($category))
        @method('PUT')
    @endif
    <div class="mb-3">
      <label for="name" class="form-label">Category Name</label>
      <input type="text" value="{{ isset($category) ? $category->name : old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
      @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create'}}</button>
</form>

<div class="card my-3">
    <div class="card-header">Categories</div>

    <div class="card-body">
        <table class="table" id="categories-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>

            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td  class="d-felx">
                        <form
                            class="d-inline-block"
                            method="POST"
                            action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button
                            class="btn btn-sm btn-danger">Delete</button>
                        </form>

                        <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}"
                            class="btn btn-sm btn-success">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>



@endsection
