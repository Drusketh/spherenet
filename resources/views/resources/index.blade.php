<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($resources as $resource)
                <div class="p-6 flex space-x-2">
                <img src="{{ asset($resource->image) }}" class="resource-icon" alt="{{ $resource->name }}">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $resource->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $resource->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <form method="POST" action="{{ route('resources.destroy', $resource) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('resources.destroy', $resource)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <p class="mt-4 text-lg text-gray-900"></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>