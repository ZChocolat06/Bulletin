@extends('admin.admin')

@section('title', 'classe')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between">
        <h1>Les classes</h1>
        <a href="{{ route('admin.classe.create') }}" class="btn btn-primary">Ajouter une classe</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Classe</th>
                <th>Matiere</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $classe)
                <tr>
                    <td>{{ $classe->nom_classe }}</td>
                    <td>{{ $classe->matieres->nom_matiere }}</td>
                    <td>
                        <a href="{{ route('admin.classe.edit', $classe) }}" class="btn btn-primary">Editer</a>
                        <form action="{{ route('admin.classe.destroy', $classe) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
