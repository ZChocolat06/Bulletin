@extends('admin.admin')

@section('title', 'Editer')

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route('admin.classe.update', $classe->id) }}" method="post">
        @csrf
        @method('put')

        @include('shared.input', [
            'label' => 'Classe',
            'name' => 'nom_classe',
            'value' => $classe->nom_classe,
        ])
        @include('shared.select', [
            'label' => 'Matiere',
            'name' => 'matiere_id',
            'options' => $matieres,
            'selected' => $classe->matiere_id,
        ])
        <div>
            <button class="btn btn-primary">
                @if ($classe->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
