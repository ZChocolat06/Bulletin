<form action="{{ route('admin.eleve.update', $eleve) }}" method="POST">
    @csrf
    @method('PUT') <!-- Utilisation de PUT pour la mise à jour -->

    <!-- Nom -->
    <div class="mb-3">
        <label for="nom_user" class="form-label">{{ __('Nom') }}</label>
        <input type="text" class="form-control" id="nom_user" name="nom_user" value="{{ old('nom_user', $user->nom_user) }}" required autofocus autocomplete="nom_user">
        @if ($errors->has('nom_user'))
            <div class="text-danger mt-2">
                {{ $errors->first('nom_user') }}
            </div>
        @endif
    </div>

    <!-- Prenom -->
    <div class="mb-3">
        <label for="prenom" class="form-label">{{ __('Prenom') }}</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required autofocus autocomplete="prenom">
        @if ($errors->has('prenom'))
            <div class="text-danger mt-2">
                {{ $errors->first('prenom') }}
            </div>
        @endif
    </div>

    <!-- Role (caché ou en lecture seule) -->
    <input type="hidden" name="role" value="Utilisateur">

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @if ($errors->has('email'))
            <div class="text-danger mt-2">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>

    <!-- Matiere -->
    <div class="mb-3">
        <label for="classe_id" class="form-label">{{ __('Classe') }}</label>
        <select id="classe_id" class="form-select" name="classe_id" required autofocus>
            @foreach($classes as $classe)
                <option value="{{ $classe->id }}" {{ old('classe_id', $classe->classe_id) == $classe->id ? 'selected' : '' }}>
                    {{ $classe->nom_classe }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('classe_id'))
            <div class="text-danger mt-2">
                {{ $errors->first('classe_id') }}
            </div>
        @endif
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
        @if ($errors->has('password'))
            <div class="text-danger mt-2">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        @if ($errors->has('password_confirmation'))
            <div class="text-danger mt-2">
                {{ $errors->first('password_confirmation') }}
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
