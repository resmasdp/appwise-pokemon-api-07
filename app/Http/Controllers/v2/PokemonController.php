<?php

namespace App\Http\Controllers\v2;

use App\Exceptions\FriendlyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginatedRequest;
use App\Models\Pokemon;
use App\Transformers\PokemonTransformer;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index(PaginatedRequest $request) {
        $limit = max($request->limit, 50);
        $offset = $request->offset ?? 0;

        $query = Pokemon::query()
            ->with(['types']);

        $count = $query->count();

        $query = $this->apply_sort($request, $query);

        $query->limit($limit);
        $query->offset($offset);

        $response = fractal()->collection($query->get(), new PokemonTransformer());

        return response()->json((object)[
            'data' => $response,

            'metadata' => [
                'next' => route('v2.pokemon.index', [
                    'limit' => $limit,
                    'offset' => $offset + $limit,
                ]),

                'previous' => $offset > 0 ? route('v2.pokemon.index', [
                    'limit' => $limit,
                    'offset' => max($offset - $limit, 0),
                ]) : null,

                'total' => $count,
                'pages' => ceil($count / $limit),

                'page' => $limit > 0 && $offset > 0 ? ($offset / $limit) + 1 : 0,
            ],
        ]);
    }

    private function apply_sort(Request $request, $query) {
        if(!$request->sort) {
            return $query;
        }

        list($field, $direction) = explode('-', $request->sort);

        $acceptable_fields = [
            'id',
            'name',
            'height',
            'weight',
            'base_experience',
            'order',
            'is_default',
        ];

        $acceptable_directions = [
            'asc',
            'desc',
        ];

        if(in_array($field, $acceptable_fields) && in_array($direction, $acceptable_directions)) {
            $query->orderBy($field, $direction);
        }
        else {
            throw new FriendlyException('Invalid sort field or direction', 'ABC');
        }

        return $query;
    }
}
