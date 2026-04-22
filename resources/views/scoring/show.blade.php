<x-app-layout>

    <span>
        <a href="{{ route('scorings.scoring-sections.index', $scoring) }}" class="text-blue-500 hover:underline">
            < Retour au tableau de bord </span>
        </a>

        <x-h1 class="mt-4">Votre bilan d'analyse de recrutement</x-h1>
 
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="col-span-1 md:col-span-2">

                <x-card>

                    <span class="text-sm">Mise à jour le {{ $scoring->updated_at }}</span>

                    <div class="flex flex-wrap content-center h-fit align-middle gap-2 mt-2">
                        <a href="{{ route('scorings.scoring-sections.index', $scoring) }}" class="self-center"
                            wire:navigate>
                            <x-primary-button>Modifier</x-primary-button>
                        </a>

                        <form action="{{ route('scorings.destroy', $scoring) }}" method="post" class="self-center"
                            onsubmit="return confirm('Êtes vous sûr de vouloir supprimer cette évaluation ? (Cette action est irreversible)');">
                            @method('delete')
                            @csrf
                            <x-secondary-button type="submit">Supprimer</x-secondary-button>
                        </form>
                        <a href="{{ route('scorings.certification', $scoring) }}" class="self-center" wire:navigate>
                            <x-secondary-button>Télécharger</x-secondary-button>
                        </a>

                        <img src="{{ asset('images/home-notes.png') }}" alt="score-note">

                    </div>

                    <div class="mt-2">
                        <x-h1>Analyse générale</x-h1>
                        <p class="mt-2 text-sm">Félicitations, vous avez complété l'ensemble des informations
                            nécéssaires au calcul de
                            votre Recrutement. Vous en trouverez le détail ci dessous aisni que les points
                            d'amélioration clés à mettre en oeuvre.</p>

                        <p class="mt-2 text-sm">Vous avez obtenu le score de
                            <b>{{ $scoring->score }}</b>
                            sur
                            <b>{{ $scoring->scoringQuiz->scoringQuestions()->sum('points') }}</b>.
                            Ce score vous
                            permet de vous
                            classer dans la catégorie Recrutement D.
                        </p>

                        <p class="mt-2 text-sm">Vous excellez particulièrement dans les domaines du recrutement et
                            de la communication,
                            avec des scores respectifs de 85 et 95 sur 100, indiquant des pratiques de recrutement
                            inclusives et des stratégies de communication claires et valorisaantes sur les employés
                            seniors.</p>

                        <div class="mt-6">
                            <x-h1>Analyse par domaine</x-h1>
                            <p class="mt-2 text-sm">Vous trouverez ci dessous les analyses et proportions d'actions
                                par domaine. Vous pouvez également modifier directement les réponses aux questions
                                dans les tableaux récapitulatifs.</p>

                            <div class="mt-4 space-y-4">
                                @foreach ($scoring->scoringQuiz->scoringSections as $section)
                                    <?php $score = $section->getScoreAttribute($scoring); ?>
                                    <?php $points = $section->scoringQuestions()->sum('points'); ?>
                                    <?php $poucentage = round(($score * 100) / $points); ?>

                                    <div>
                                        <h3 class="font-bold">{{ $section->title }}
                                            ({{ $score }} points)
                                        </h3>

                                        <x-progress :pourcent="$poucentage">{{ $poucentage }}%</x-progress>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </x-card>

            </div>

            <div class="col-span-1">
                @include('scoring-question.partials.list-sections', $scoring)
            </div>

        </div>

</x-app-layout>
