<form action="{{ route('admin.note.update', $note) }}" method="POST">
    @csrf
    @method('PUT') <!-- Utilisation de PUT pour la mise à jour -->

    <!-- Nom -->
    <div>
        <p>{{ $note->matiere->nom_matiere }}</p>
        <p>{{ $note->eleve->user->nom_user }}</p>
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">{{ __('Note') }}</label>
        <input type="text" class="form-control" id="note" name="note" value="{{ old('note', $note->note) }}" required autofocus autocomplete="note">
        @if ($errors->has('note'))
            <div class="text-danger mt-2">
                {{ $errors->first('note') }}
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
