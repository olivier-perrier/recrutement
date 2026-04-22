<x-guest-layout>

    {{-- <x-slot name="header">Offres d'emploi</x-slot> --}}

    <x-container>

        <div>
            <img src="{{ asset('images/hero-jobs.jpg') }}" alt=""
                class="h-36 w-full object-cover object-center rounded-lg">
        </div>

        <div class="mt-6 max-w-4xl mx-auto">
            <livewire:job.list-jobs />
        </div>

    </x-container>

</x-guest-layout>
