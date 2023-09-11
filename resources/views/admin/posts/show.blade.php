@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">Dettagli del Post</h2>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $post->title }}</h5>
            </div>
            <div class="card-body">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-thumbnail"
                    width="300">
                <p class="card-text">{{ $post->content }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Modifica</a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
@endsection
