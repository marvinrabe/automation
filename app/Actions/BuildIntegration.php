<?php

namespace App\Actions;

use App\Models\Automation;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\Yaml\Yaml;

class BuildIntegration
{
    use AsAction;

    public function handle(Automation $automation): string
    {
        return Yaml::dump([
            [
                'from' => [
                    'uri' => 'kamelet:timer-source',
                    'parameters' => [
                        'period' => '1000',
                        'message' => 'foo'
                    ],
                    'steps' => [
                        ['to' => 'kamelet:log-sink']
                    ]
                ]
            ]
        ]);
    }
}
