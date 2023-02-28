<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pokemons.*' => 'exists:pokemons,id',
        ];
    }
}
