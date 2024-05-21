@extends('admin.admin')

@section('title', 'Professeurs')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between">
        <h1>Les professeurs</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Matière</th>
                <th>Statut</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professeurs as $professeur)
                <tr>
                    <td>{{ $professeur->id_prof }}</td>
                    <td>{{ $professeur->nom_user }}</td>
                    <td>{{ $professeur->prenom }}</td>
                    <td>{{ $professeur->email }}</td>
                    <td>{{ $professeur->role }}</td>
                    <td>{{ $professeur->nom_matiere }}</td>
                    <td>
                        @if ($professeur->non_valide == 0)
                            Compte non validé
                        @else
                            Compte validé
                        @endif
                    </td>
                    <td>
                        @if ($professeur->non_valide == 0)
                            <a href="{{ route('admin.professeur.approve', $professeur->id_user) }}" class="btn btn-primary">
                                Valider
                            </a>
                        @endif
                        <form action="{{ route('admin.professeur.destroy', $professeur->id_prof) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
