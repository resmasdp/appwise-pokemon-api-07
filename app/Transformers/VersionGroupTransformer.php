<?php

namespace App\Transformers;

use App\Models\VersionGroup;
use League\Fractal\TransformerAbstract;

class VersionGroupTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];
    protected array $availableIncludes = [];

    public function transform(VersionGroup $resource) {
        return [
            'id' => $resource->id,

            'move_learn_method' => $resource->move_learn_method,
            'version_group' => $resource->version_group,
            'level_learned_at' => (int)$resource->level_learned_at
        ];
    }
}
