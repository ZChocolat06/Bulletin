@extends('admin.admin')


@section('title', 'Creer')

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route('admin.classe.store', $classe) }}" method="post">
        @csrf

        @include('shared.input', [
            'label' => 'Classe',
            'name' => 'nom_classe',
            'value' => $classe->nom_classe,
        ])
        @include('shared.select', [
            'label' => 'Matiere',
            'name' => 'matiere_id',
        ])
        <div>
            <button class="btn btn-primary">Créer</button>
        </div>
    </form>
@endsection
