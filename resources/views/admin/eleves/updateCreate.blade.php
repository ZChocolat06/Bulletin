@extends('admin.admin')


@section('title', $eleve->exists ? 'Editer' : 'Creer')

@section('content')

    <h1>@yield('title')</h1>

    <form action="{{ route($eleve->exists ? 'admin.eleve.update' : 'admin.eleve.store', $eleve) }}" method="post">
        @csrf

        @method($eleve->exists ? 'put' : 'post')
        @include('shared.select', [
            'label' => 'Classe',
            'name' => 'classe_id',
            // 'value' => $eleve->email_prof,
        ])
        @include('shared.select', [
            'label' => 'Utilisateur',
            'name' => 'user_id',
            // 'value' => $eleve->email_prof,
        ])
        <div>
            <button class="btn btn-primary">
                @if ($eleve->exists)
                    modifier
                @else
                    creer
                @endif
            </button>
        </div>
    </form>
@endsection
