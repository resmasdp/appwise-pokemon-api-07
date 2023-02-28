<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonMove extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id',
        'move_id'
    ];


    public function pokemon() {
        return $this->belongsTo(Pokemon::class);
    }

    public function move() {
        return $this->belongsTo(Move::class);
    }
}
