<?php

namespace App\Repositories;

/**
 * Application
 */
use App\{User, Election, Position};

/**
 * Laravel
 */
use Illuminate\Support\Facades\DB;

class ElectionRepository
{
    /**
     * @var \App\Election
     */
    protected $election;

    /**
     * @param \App\Election
     */
    public function __construct($election)
    {
        $this->election = $election;
    }

    /**
     * @param string
     * @return array
     */
    public function getTally($position = null)
    {
        $election_votes = DB::table('election_votes')
            ->select(
                'position_uuid as position',
                'candidate_uuid as candidate',
                DB::raw('COUNT(*) as votes')
            )
            ->groupBy('candidate')
            ->get()
            ->map(function($vote) {
                $vote->position = Position::find($vote->position);
                $vote->candidate = User::find($vote->candidate);

                return $vote;
            })
            ->sortBy('position.level')
            ->values();

        $archives = [];

        foreach ($election_votes as $vote) {
            $archives[$vote->position->uuid]['votes'][] = $vote;
            $archives[$vote->position->uuid]['position'] = $vote->position;
        }

        if ($position != null) {
            $archive = $archives[Position::encodeUuid($position)];
            $archives = [$archive];
        }

        return $archives;
    }

    /**
     * @return Illuminate\Support\Collection
     */
    public function getWinners()
    {
        // position, candidate, votes.
        return DB::table('election_votes')
            ->select(
                'position_uuid',
                'candidate_uuid',
                DB::raw('COUNT(*) as votes')
            )
            ->where('election_uuid', $this->election->uuid)
            ->groupBy('candidate_uuid')
            ->get()
            ->sortByDesc('votes')
            ->unique('position_uuid')
            ->map(function ($value, $key) {
                $value->position = Position::find($value->position_uuid);
                $value->user = User::find($value->candidate_uuid);

                return $value;
            })
            ->sortBy('position.level')
            ->values();
    }
}