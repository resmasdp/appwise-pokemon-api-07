<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonAbility extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id',
        'ability_id'
    ];


    public function pokemon() {
        return $this->belongsTo(Pokemon::class);
    }

    public function ability() {
        return $this->belongsTo(Ability::class);
    }
}
