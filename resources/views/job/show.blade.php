<x-guest-layout>

    {{-- <x-slot name="header">
        <x-h1>{{ $job->title }}</x-h1>
    </x-slot> --}}

    <x-container>

        <div>
            <img src="{{ $job->company->image ? asset('storage/' . $job->company->image) : asset('images/hero-jobs.jpg') }}"
                alt="" class="h-64 w-full object-cover object-center rounded-lg">
        </div>

        <div class="mt-16 px-10 grid grid-cols-3 gap-10">

            <div class=" col-span-2">
                <x-h1 class="text-5xl font-light">{{ $job->title }}</x-h1>
                <div class="opacity-75">
                    <span>{{ $job->company->name }} | </span>
                    <span>{{ $job->address->city }} - {{ $job->address->postcode }} | </span>
                    <span>{{ $job->contract_type }}</span>
                </div>

                <div class="mt-12">
                    <x-h2 class="mt-6">Détails du poste</x-h2>
                    <div>
                        {{ $job->description }}
                    </div>

                    <x-h2 class="mt-6">Le profil recherché</x-h2>
                    <div>
                        {{ $job->description }}
                    </div>

                    <x-h2 class="mt-6">Informations complémentaires</x-h2>
                    <div>
                        {{ $job->description }}
                    </div>
                </div>

                @if ($job->images)
                    <div class="mt-16 flex flex-wrap gap-8">
                        @foreach ($job->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                class="h-40 object-cover object-center rounded-lg">
                        @endforeach
                    </div>
                @endif

            </div>

            <div class="col-span-1">

                <div class="border-gray-300 border rounded-lg p-6">
                    <x-h2 class="">{{ $job->title }}</x-h2>
                    <div class="opacity-75">
                        <span class="mt-1">{{ $job->company->name }}</span>
                    </div>

                    <button class="mt-4 btn btn-primary rounded-full block mx-auto w-full bg-blue-800">Postuler</button>

                    <div class="mt-4">

                        @if ($job->category)
                            <div class="badge badge-outline p-3">
                                <x-heroicon-c-square-3-stack-3d class="w-3 mr-1" />
                                {{ $job->category->name }}
                            </div>
                        @endif

                        @if ($job->contract_type)
                            <div class="badge badge-outline p-3">
                                <x-heroicon-o-clock class="w-3 mr-1" />
                                {{ $job->contract_type }}
                            </div>
                        @endif
                    </div>


                </div>

            </div>

        </div>

    </x-container>

</x-guest-layout>
