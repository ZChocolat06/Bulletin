@extends('admin.admin')

@section('title', 'matiere')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between">
        <h1>Les matieres</h1>
        <a href="{{ route('admin.matiere.create') }}" class="btn btn-primary">Ajouter une matiere</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Matiere</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matieres as $matiere)
                <tr>
                    <td>{{ $matiere->nom_matiere }}</td>
                    <td>
                        <a href="{{ route('admin.matiere.edit', $matiere) }}" class="btn btn-primary">Editer</a>
                        <form action="{{ route('admin.matiere.destroy', $matiere) }}" method="post">
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
