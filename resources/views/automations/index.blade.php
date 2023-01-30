<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Automations') }}
            </h2>
            <form action="{{ route('automations.store') }}" method="post">
                @csrf
                <x-jet-button>
                    {{ __('Create') }}
                </x-jet-button>
            </form>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4">
                @foreach($automations as $automation)
                    <a href="{{ route('automations.show', $automation) }}"
                       class="bg-white border border-gray-200 block rounded px-5 py-3 hover:text-blue-500 hover:underline">
                        {{$automation->name}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
