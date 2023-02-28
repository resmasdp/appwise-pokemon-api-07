<?php

namespace App\Transformers;

use App\Models\Pokemon;
use League\Fractal\TransformerAbstract;

class TypeTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];
    protected array $availableIncludes = [];

    public function transform(Pokemon $resource) {
        return [
            'id' => $resource->id,

            'type' => $resource->type,
            'slot' => (int)$resource->slot
        ];
    }
}
