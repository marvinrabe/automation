<?php

namespace App\Http\Controllers;

use App\Models\Automation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AutomationController extends Controller
{
    public function index(): View
    {
        return view('automations.index', [
            'automations' => Automation::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $automation = Automation::create();

        return Redirect::route('automations.show', $automation);
    }

    public function show(Automation $automation): View
    {
        return view('automations.show', [
            'automation' => $automation
        ]);
    }

    public function destroy(Automation $automation): RedirectResponse
    {
        $automation->delete();

        return Redirect::route('automations.index');
    }
}
