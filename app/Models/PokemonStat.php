<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id',
        'stat_id'
    ];


    public function pokemon() {
        return $this->belongsTo(Pokemon::class);
    }

    public function stat() {
        return $this->belongsTo(Stat::class);
    }
}
