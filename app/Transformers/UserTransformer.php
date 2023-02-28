<?php

namespace App\Transformers;

use App\Models\Team;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];
    protected array $availableIncludes = ['pokemon'];

    public function transform(Team $resource) {
        return [
            'id' => $resource->id,

            'name' => $resource->name,
            'email' => $resource->email,

            'created_at' => $resource->created_at?->timestamp,
            'updated_at' => $resource->updated_at?->timestamp,
        ];
    }
}
