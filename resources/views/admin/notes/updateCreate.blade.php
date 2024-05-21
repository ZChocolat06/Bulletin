@extends('admin.admin')

@section('title', 'Créer Note')

@section('content')

    <h1>Créer Note</h1>

    <form action="{{ route('admin.note.store') }}" method="post">
        @csrf

        <!-- Sélection de l'élève -->
        <div class="form-group">
            <label for="eleve_id">Élève</label>
            <select class="form-control @error('eleve_id') is-invalid @enderror" id="eleve_id" name="eleve_id">
                @foreach ($elevesOptions as $eleveId => $eleveLabel)
                    <option value="{{ $eleveId }}" {{ old('eleve_id') == $eleveId ? 'selected' : '' }}>
                        {{ $eleveLabel }}
                    </option>
                @endforeach
            </select>
            @error('eleve_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Entrée de la note -->
        <div class="form-group">
            <label for="note">Note</label>
            <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note"
                value="{{ old('note') }}">
            @error('note')
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
