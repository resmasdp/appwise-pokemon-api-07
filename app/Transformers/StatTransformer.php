<?php

namespace App\Transformers;

use App\Models\Pokemon;
use League\Fractal\TransformerAbstract;

class StatTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];
    protected array $availableIncludes = [];

    public function transform(Pokemon $resource) {
        return [
            'id' => $resource->id,

            'stat' => $resource->stat,
            'base_stat' => (int)$resource->base_stat,
            'effort' => (int)$resource->effort,
        ];
    }
}
