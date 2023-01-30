<div x-data class="flex items-center">
    <input
        type="text"
        class="text-lg font-semibold text-gray-800 leading-tight rounded border-white hover:border-gray-200 focus:border-blue-300 px-2 py-1 w-full"
        wire:model="automation.name"
        wire:blur="save"
        x-on:keydown.enter="$event.target.blur()"
        title="{{ __('Rename') }}"
    />
</div>
