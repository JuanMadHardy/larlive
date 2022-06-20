<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Nodes manager') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-2">
                <x-jet-form-section submit="storeNode">
                    <x-slot name="title"></x-slot>
                    <x-slot name="description">
                        <div class="float-right">
                            <h1 class="text-xl text-center float-right">{{ __('Add new node') }}</h1>
                        </div>

                    </x-slot>

                    <x-slot name="form">
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="nodename" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full"
                                         wire:model="nodename" autocomplete="nodename" />
                            <x-jet-input-error for="nodename" class="mt-2" />
                        </div>

                        <!-- manifesto-->

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="manifesto" value="{{ __('Observations') }}" />
                            <textarea id="manifesto" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                         wire:model="manifesto" autocomplete="manifesto">
                            </textarea>
                            <x-jet-input-error for="manifesto" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="active" value="{{ __('Active') }}" />
                            <x-jet-checkbox wire:model="active"/>
                        </div>
                    </x-slot>

                    <x-slot name="actions">
                        <x-jet-action-message class="mr-3" on="saved">
                            {{ __('Saved.') }}
                        </x-jet-action-message>

                        <x-jet-button wire:loading.attr="enable">
                            {{ __('Save') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-form-section>
            </div>
        </div>
    </div>
</div>
