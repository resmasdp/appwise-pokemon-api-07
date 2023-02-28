<?php

namespace App\Transformers;

use App\Models\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];
    protected array $availableIncludes = ['pokemon'];

    public function transform(Team $resource) {
        return [
            'id' => $resource->id,

            'name' => $resource->name,
        ];
    }

    public function includePokemon(Team $resource) {
        return $this->collection($resource->pokemon, new PokemonTransformer());
    }
}
