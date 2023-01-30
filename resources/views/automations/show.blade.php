<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-screen md:items-stretch bg-gray-100">
        <aside class="bg-white shadow w-full md:max-w-[320px] grow ">
            <div class="flex items-center border-b border-gray-100 px-5 py-3">
                <a href="{{ route('automations.index') }}"
                   title="{{ __('Return to List') }}"
                   class="p-3 -ml-3 text-gray-500 hover:text-gray-800">
                    <x-fas-chevron-left class="w-5 h-5"/>
                </a>

                <div class="flex-1">
                    <livewire:rename-automation :automation="$automation" />
                </div>

                <livewire:toggle-automation :automation="$automation" />
            </div>
        </aside>
        <main class="flex-1">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <form action="{{ route('automations.destroy', $automation) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-jet-danger-button type="submit">
                        {{ __('Delete') }}
                    </x-jet-danger-button>
                </form>
            </div>
        </main>
    </div>
</x-guest-layout>
