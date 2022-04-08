<?php


namespace App\Http\Controllers\Api;


use App\Filters\ParticipantFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParticipantsRequest;
use App\Http\Resources\ParticipantResource;
use App\Loaders\ParticipantLoaders;
use App\Models\Participant;

class ParticipantsController extends Controller
{
    public function index(ParticipantFilters $filters)
    {
        $participants = Participant::filter($filters);

        return ParticipantResource::collection($participants);
    }

    public function store(ParticipantsRequest $request)
    {
        return new ParticipantResource($request->persist());
    }

    public function show(Participant $participant, ParticipantLoaders $loaders)
    {
        return new ParticipantResource($participant->filter($loaders));
    }

    public function update(Participant $participant,ParticipantsRequest $request)
    {
        return new ParticipantResource($request->persist($participant));
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return response()->json([], 204);
    }

    public function restore($id)
    {
        $participant = Participant::withTrashed()->where('id',$id)->restore();

        return response()->json([], 204);
    }
}
