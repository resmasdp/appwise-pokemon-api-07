<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $fillable = [
        'move'
    ];


    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, PokemonType::class);
    }
}
