<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonSearchRequest;
use App\Models\Pokemon;
use App\Models\PokemonType;
use App\Models\Type;
use App\Transformers\PokemonTransformer;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index(Request $request) {
        $query = Pokemon::query()
            ->with(['types']);

        $query = $this->apply_sort($request, $query);

        return fractal()->collection($query->get(), new PokemonTransformer());
    }

    public function show(Pokemon $pokemon) {
        $pokemon->load(['types', 'abilities', 'moves', 'stats', 'abilities']);

        return fractal()->item($pokemon, new PokemonTransformer())
            ->parseIncludes(['types', 'sprites', 'moves', 'stats', 'abilities', 'form']);
    }

    public function search(PokemonSearchRequest $request) {
        $matching_type_ids = Type::whereLike('name', $request->types)->select('id')->get()->pluck('id');
        $matching_type_pokemon_ids = [];

        if($matching_type_ids->count()) {
            $matching_type_pokemon_ids = PokemonType::whereIn('type_id', $matching_type_ids)->select('pokemon_id')
                ->get()
                ->pluck('pokemon_id');
        }

        $limit = max($request->limit, 50);
        $query = Pokemon::query()
            ->where('name', 'like', "%{$request->name}%")
            ->orWhereIn('id', $matching_type_pokemon_ids)
            ->with(['types']);

        return fractal()->collection($query->get(), new PokemonTransformer());
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

        return $query;
    }
}
