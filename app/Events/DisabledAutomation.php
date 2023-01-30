<?php

namespace App\Events;

use App\Models\Automation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DisabledAutomation
{
    use Dispatchable, SerializesModels;

    public function __construct(public Automation $automation)
    {
    }
}
