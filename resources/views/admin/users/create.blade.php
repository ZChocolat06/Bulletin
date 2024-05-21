<h1>Creation Professeur</h1>

<form action="{{ route('professeur.store') }}" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <p>{{ $user->nom_user }}</p>
    <p>{{ $user->prenom }}</p>
    @include('shared.select', [
        'label' => 'Matiere',
        'name' => 'matiere_id',
    ])
    <div>
        <button class="btn btn-primary">Créer</button>
    </div>
</form>
