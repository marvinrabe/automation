<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait BelongsToTeam
{
    protected static function bootBelongsToTeam(): void
    {
        static::addGlobalScope(new TeamScope());

        static::creating(function ($model) {
            $model->team_id = $model->team_id ?: Auth::user()?->currentTeam?->getKey();
        });
    }

    public function initializeBelongsToTeam(): void
    {
        $this->guarded[] = ['team_id'];
    }

    /**
     * @return BelongsTo<Team, self>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function ownedBy(Team $team): bool
    {
        return $team->id === $this->team_id;
    }
}
