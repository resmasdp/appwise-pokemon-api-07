<?php

namespace App\Transformers;

use App\Models\Pokemon;
use League\Fractal\TransformerAbstract;

class MoveTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['version_groups'];
    protected array $availableIncludes = ['version_groups'];

    public function transform(Pokemon $resource) {
        return [
            'id' => $resource->id,

            'move' => $resource->move,
        ];
    }

    public function includeVersionGroups(Pokemon $resource) {
        return $this->collection($resource->version_groups, new VersionGroupTransformer());
    }
}
