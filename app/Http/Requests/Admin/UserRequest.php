<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\users;
use App\Rules\EmailMatchesUser;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_user' => ['required', 'string', 'min:2'],
            'prenom' => ['required', 'string', 'min:2'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => [
                'required',
                'string',
                Rule::in(['Administrateur', 'Professeur', 'Eleve']),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom_user.required' => 'Le champ nom est obligatoire.',
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'role.required' => 'Le champ rôle est obligatoire.',
            'role.in' => 'Le rôle doit être soit Administrateur soit Utilisateur.',
        ];
    }
}
