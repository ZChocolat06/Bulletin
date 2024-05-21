<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class EmailMatchesUser implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        $user = User::find($this->userId);
        return $user && $user->email === $value;
    }

    public function message()
    {
        return 'L\'email du professeur doit correspondre à l\'email de l\'utilisateur sélectionné.';
    }
}

