<?php

namespace App\Actions;

use App\Events\DisabledAutomation;
use App\Models\Automation;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteIntegration
{
    use AsAction;

    public function handle(Automation $automation): void
    {
        shell_exec(base_path('kamel').' delete '.$automation->id);
    }

    public function asListener(DisabledAutomation $event): void
    {
        $this->handle($event->automation);
    }
}
