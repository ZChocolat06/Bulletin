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
        <h1>Les eleves</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Classe</th>
                <th>Statut</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eleves as $eleve)
                <tr>
                    <td>{{ $eleve->id_eleve }}</td>
                    <td>{{ $eleve->nom_user }}</td>
                    <td>{{ $eleve->prenom }}</td>
                    <td>{{ $eleve->email }}</td>
                    <td>{{ $eleve->role }}</td>
                    <td>{{ $eleve->nom_classe }}</td>
                    <td>
                        @if ($eleve->non_valide == 0)
                            Compte non validé
                        @else
                            Compte validé
                        @endif
                    </td>
                    <td>
                        @if ($eleve->non_valide == 0)
                            <a href="{{ route('admin.eleve.approve', $eleve->id_user) }}" class="btn btn-primary">Valider</a>
                        @endif
                        <form action="{{ route('admin.eleve.destroy', $eleve->id_eleve) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce eleve ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
