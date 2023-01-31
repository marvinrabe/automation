<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TeamScope implements Scope
{
    /**
     * @param  Builder<Model>  $builder
     * @param  Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where(
            "{$model->getTable()}.team_id",
            Auth::user()?->currentTeam?->getKey()
        );
    }
}
