<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, TeamPokemon::class);
    }

    public function team_pokemon() {
        return $this->hasMany(TeamPokemon::class);
    }
}
