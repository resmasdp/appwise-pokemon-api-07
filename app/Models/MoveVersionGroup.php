<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveVersionGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_group_id',
        'move_id',
    ];


    public function version_group() {
        return $this->belongsTo(VersionGroup::class);
    }

    public function move() {
        return $this->belongsTo(Move::class);
    }
}
