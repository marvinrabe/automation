<div wire:click="toggle" class="cursor-pointer ml-2">
    <div
        class="rounded-full overflow-visible w-12 h-7 p-1 flex items-center {{ $automation->enabled ? 'bg-green-500 justify-end' : 'bg-gray-200' }}">
        <div class="rounded-full w-5 h-5 bg-white text-gray-600 flex items-center justify-center shadow">
            @if($automation->enabled)
                <x-fas-check class="w-3 h-3"/>
            @else
                <x-fas-pause class="w-3 h-3"/>
            @endif
        </div>
    </div>
</div>
