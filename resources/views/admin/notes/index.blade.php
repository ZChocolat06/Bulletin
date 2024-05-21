@extends('admin.admin')

@section('title', 'Eleves')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between">
        <h1>Les notes</h1>
        <a href="{{ route('admin.note.create') }}" class="btn btn-primary">Ajouter un note</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Note</th>
                <th>Matiere</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Classe</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td>{{ $note->id_note }}</td>
                    <td>{{ $note->note }}</td>
                    <td>{{ $note->nom_matiere }}</td>
                    <td>{{ $note->nom_user }}</td>
                    <td>{{ $note->prenom }}</td>
                    <td>{{ $note->nom_classe }}</td>
                    <td>
                        <a href="{{ route('admin.note.edit', $note->id_note) }}" class="btn btn-primary">Editer</a>
                        <form action="{{ route('admin.note.destroy', $note->id_note) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce note ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
