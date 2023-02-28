<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = [
        'ability',
        'is_hidden',
        'slot'
    ];

    protected $casts = [
        'is_hidden' => 'boolean'
    ];


    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, PokemonAbility::class);
    }
}
