<?php

namespace App\Actions;

use App\Events\EnabledAutomation;
use App\Models\Automation;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use RuntimeException;

class RunIntegration
{
    use AsAction;

    public function handle(Automation $automation): void
    {
        $file = "integration/{$automation->id}.yaml";
        $code = BuildIntegration::run($automation);
        if (!Storage::put($file, $code)) {
            throw new RuntimeException('Integration file could not be created.');
        }
        $output = shell_exec(base_path('kamel').' run '.Storage::path($file));
        if ($output != "Integration \"{$automation->id}\" created\n") {
            throw new RuntimeException('Integration could not run with Kamel.');
        }
        Storage::delete($file);
    }

    public function asListener(EnabledAutomation $event): void
    {
        $this->handle($event->automation);
    }
}
