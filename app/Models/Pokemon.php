<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemon';

    protected $fillable = [
        'name',

        'height',
        'weight',

        'oder',

        'species',
        'form'
    ];

    public static $sprite_types = [
        'front_default',
        'front_female',
        'front_shiny',
        'front_shiny_female',

        'back_default',
        'back_female',
        'back_shiny',
        'back_shiny_female',
    ];


    public function types() {
        return $this->hasManyThrough(Type::class, PokemonType::class);
    }

    public function moves() {
        return $this->hasManyThrough(Move::class, PokemonMove::class);
    }

    public function stats() {
        return $this->hasManyThrough(Stat::class, PokemonStat::class);
    }

    public function abilities() {
        return $this->hasManyThrough(Ability::class, PokemonAbility::class);
    }
}
