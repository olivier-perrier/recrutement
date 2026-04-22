<div>
    {{ $this->form }}

    <div class="mt-10 grid gap-6">

        <span class="text-xl font-extrabold">{{ $job_count }} offres</span>

        @foreach ($jobs as $job)
            <a href="{{ route('jobs.show', $job) }}">
                <div class="border border-grey-500 rounded-lg hover:border-gray-950 flex overflow-hidden min-h-52">

                    <img src="{{ isset($job->images[0]) ? asset('storage/' . $job->images[0]) : asset('images/hero-jobs.jpg') }}"
                        alt="" class="w-52 object-cover">

                    <div class="p-6 flex flex-col justify-between w-full">
                        <div>
                            <h3 class="text-2xl">
                                {{ $job->title }}
                            </h3>
                            <p>{{ $job->company->name }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            @if ($job->contract_type)
                                <div class="badge badge-outline p-3">
                                    <x-heroicon-o-clock class="w-3 mr-1" />
                                    {{ $job->contract_type }}
                                </div>
                            @endif
                            <div>
                                <button class="btn btn-outline rounded-full">Voir l'offre</button>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
