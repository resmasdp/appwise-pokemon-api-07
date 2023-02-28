<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'stat',
        'base_stat',
        'effort'
    ];


    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, PokemonType::class);
    }
}
