<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'move_learn_method',
        'version_group',
        'level_learned_at'
    ];


    public function pokemon() {
        return $this->hasManyThrough(Pokemon::class, PokemonType::class);
    }
}
