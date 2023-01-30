<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    use HasFactory, BelongsToTeam;

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'name' => 'Unnamed Automation'
    ];
}
