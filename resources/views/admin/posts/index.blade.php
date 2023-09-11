@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">Elenco dei Post</h2>

        <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">Crea un nuovo post</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Immagine</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Contenuto</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-thumbnail"
                                width="100">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info btn-sm">Mostra</a>
                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                    class="btn btn-primary btn-sm">Modifica</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
