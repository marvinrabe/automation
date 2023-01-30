<?php

namespace App\Events;

use App\Models\Automation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EnabledAutomation
{
    use Dispatchable, SerializesModels;

    public function __construct(public Automation $automation)
    {
    }
}
