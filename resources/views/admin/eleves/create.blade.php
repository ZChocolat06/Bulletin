<h1>Creation Eleve</h1>

<form action="{{ route('eleve.store') }}" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <p>{{ $user->nom_user }}</p>
    <p>{{ $user->prenom }}</p>
    @include('shared.select', [
        'label' => 'Classe',
        'name' => 'classe_id',
    ])
    <div>
        <button class="btn btn-primary">Créer</button>
    </div>
</form>
