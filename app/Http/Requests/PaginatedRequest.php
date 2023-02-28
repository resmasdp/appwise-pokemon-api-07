<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginatedRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sort' => 'string',

            'limit' => 'numeric',
            'offset' => 'numeric',
        ];
    }
}
