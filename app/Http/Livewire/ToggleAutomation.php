<?php

namespace App\Http\Livewire;

use App\Events\DisabledAutomation;
use App\Events\EnabledAutomation;
use App\Models\Automation;
use Illuminate\View\View;
use Livewire\Component;

class ToggleAutomation extends Component
{
    public Automation $automation;

    public function render(): View
    {
        return view('livewire.toggle-automation');
    }

    public function toggle(): void
    {
        if ($this->automation->enabled) {
            $this->automation->enabled = false;
            $this->automation->save();
            DisabledAutomation::dispatch($this->automation);
        } else {
            $this->automation->enabled = true;
            $this->automation->save();
            EnabledAutomation::dispatch($this->automation);
        }
    }
}
