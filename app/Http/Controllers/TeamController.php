<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Transformers\TeamTransformer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request) {
        return fractal()->collection(Team::all(), new TeamTransformer());
    }

    public function show(Team $team) {
        return fractal()->item($team->fresh(), new TeamTransformer())
            ->parseIncludes(['pokemon']);
    }

    public function create(CreateTeamRequest $request) {
        $team = Team::create($request->validated);

        return $this->show($team);
    }

    public function update(UpdateTeamRequest $request, Team $team) {
        $team->team_pokemon()->whereNotIn('pokemon_id', $request->pokemons)->delete();

        foreach($request->pokemons as $pokemon_id) {
            $team->team_pokemon()->firstOrCreate(['pokemon_id' => $pokemon_id]);
        }

        return $this->show($team);
    }
}
