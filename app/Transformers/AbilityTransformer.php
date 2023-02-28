<?php

namespace App\Transformers;

use App\Models\Pokemon;
use League\Fractal\TransformerAbstract;

class AbilityTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];
    protected array $availableIncludes = [];

    public function transform(Pokemon $resource) {
        return [
            'id' => $resource->id,

            'ability' => $resource->ability,
            'is_hidden' => (bool)$resource->is_hidden,
            'slot' => (int)$resource->slot,
        ];
    }
}
