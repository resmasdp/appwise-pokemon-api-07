<?php

namespace App\Transformers;

use App\Models\Pokemon;
use League\Fractal\TransformerAbstract;

class PokemonTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['types'];
    protected array $availableIncludes = ['types', 'sprites', 'moves', 'stats', 'abilities', 'form'];

    public function transform(Pokemon $resource) {
        return [
            'id' => $resource->id,

            'name' => $resource->name,

            'sprites' => (object)[
                'front_default' => $resource->sprites->front_default,
            ]
        ];
    }

    public function includeTypes(Pokemon $resource) {
        return $this->collection($resource->types, new TypeTransformer());
    }

    public function includeMoves(Pokemon $resource) {
        return $this->collection($resource->moves, new MoveTransformer());
    }

    public function includeStats(Pokemon $resource) {
        return $this->collection($resource->stats, new StatTransformer());
    }

    public function includeAbilities(Pokemon $resource) {
        return $this->collection($resource->abilities, new AbilityTransformer());
    }

    public function includeSprites(Pokemon $resource) {
        return $this->primitive($resource, function(Pokemon $resource) {
            $sprites = [];

            foreach(Pokemon::$sprite_types as $sprite_type) {
                $sprites[$sprite_type] = $resource->$sprite_type;
            }

            return (object)$sprites;
        });
    }

    public function includeForm(Pokemon $resource) {
        return $this->primitive($resource, function(Pokemon $resource) {
            return $resource->form;
        });
    }
}
