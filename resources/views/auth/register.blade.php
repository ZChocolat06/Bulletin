<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <!-- Name -->
        <div>
            <x-input-label for="nom_user" :value="__('Nom')" />
            <x-text-input id="nom_user" class="block mt-1 w-full" type="text" name="nom_user" :value="old('nom_user')" required
                autofocus autocomplete="nom_user" />
            <x-input-error :messages="$errors->get('nom_user')" class="mt-2" />
        </div>
        <!-- Prenom -->
        <div>
            <x-input-label for="prenom" :value="__('Prenom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>
        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" class="block mt-1 w-full" name="role" required autofocus>
                <option value="Administrateur" {{ old('role') == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                <option value="Professeur" {{ old('role') == 'Professeur' ? 'selected' : '' }}>Professeur</option>
                <option value="Eleve" {{ old('role') == 'Eleve' ? 'selected' : '' }}>Eleve</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
