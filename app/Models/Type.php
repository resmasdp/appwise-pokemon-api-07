<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'slot'
    ];


    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, PokemonType::class);
    }
}
