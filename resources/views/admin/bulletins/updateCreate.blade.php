@extends('admin.admin')

@section('title', 'Créer Bulletin')

@section('content')

    <h1>Créer Bulletin</h1>

    <form action="{{ route('admin.bulletin.store') }}" method="post">
        @csrf

        <!-- Sélection de la note -->
        <div class="form-group">
            <label for="note_id">Note</label>
            <select class="form-control @error('note_id') is-invalid @enderror" id="note_id" name="note_id">
                @foreach ($notesOptions as $noteId => $noteLabel)
                    <option value="{{ $noteId }}" {{ old('note_id') == $noteId ? 'selected' : '' }}>
                        {{ $noteLabel }}
                    </option>
                @endforeach
            </select>
            @error('note_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Champ de saisie pour le commentaire -->
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <input type="text" class="form-control @error('commentaire') is-invalid @enderror" id="commentaire"
                name="commentaire" value="{{ old('commentaire') }}">
            @error('commentaire')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Champ de saisie pour le trimestre -->
        <div class="form-group">
            <label for="trimestre">Trimestre</label>
            <input type="number" class="form-control @error('trimestre') is-invalid @enderror" id="trimestre"
                name="trimestre" value="{{ old('trimestre') }}">
            @error('trimestre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Créer</button>
        </div>
    </form>

@endsection
