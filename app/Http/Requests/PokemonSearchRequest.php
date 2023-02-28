<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonSearchRequest extends FormRequest
{
    public function rules()
    {
        return [
            'query' => 'required|string',
            'limit' => 'numeric',
        ];
    }
}
