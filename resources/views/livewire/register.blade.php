<div>
    <form wire:submit="submit">
        {{ $this->form }}

        <div class="mt-4 flex justify-end items-center space-x-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="submit">
                S'enregistrer
            </x-primary-button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
