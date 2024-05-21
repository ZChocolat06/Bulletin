@extends('admin.admin')

@section('title', 'Bulletins')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between">
        <h1>Les bulletins</h1>
        <a href="{{ route('admin.bulletin.create') }}" class="btn btn-primary">Ajouter un bulletin</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom de l'élève</th>
                <th>Prénom de l'élève</th>
                <th>Année</th>
                <th>Trimestre</th>
                <th>Matière</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Moyenne</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bulletins as $bulletin)
                <tr>
                    <td>{{ $bulletin->nom_user }}</td>
                    <td>{{ $bulletin->prenom }}</td>
                    <td>{{ $bulletin->annee }}</td>
                    <td>{{ $bulletin->trimestre }}</td>
                    <td>{{ $bulletin->nom_matiere }}</td>
                    <td>{{ $bulletin->note_val }}</td>
                    <td>{{ $bulletin->commentaire }}</td>
                    <td>{{ $bulletin->moyenne_val }}</td>
                    <td>
                        <a href="{{ route('admin.bulletin.edit', $bulletin->bulletin_id) }}" class="btn btn-primary">Editer</a>
                        <form action="{{ route('admin.bulletin.destroy', $bulletin->bulletin_id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bulletin ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
