@extends('admin.admin')


@section('title', $matiere->exists ? 'Editer' : 'Creer')

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($matiere->exists ? 'admin.matiere.update' : 'admin.matiere.store', $matiere) }}" method="post">
        @csrf

        @method($matiere->exists ? 'put' : 'post')

        @include('shared.input', [
            'label' => 'Classe',
            'name' => 'nom_matiere',
            'value' => $matiere->nom_matiere,
        ])
        <div>
            <button class="btn btn-primary">
                @if ($matiere->exists)
                    modifier
                @else
                    creer
                @endif
            </button>
        </div>
    </form>
@endsection
