<x-guest-layout>

    <x-slot name="header">
        Évaluez et valorisez votre engagement <br> en faveur du recrutement
    </x-slot>
    
    <x-container>

        <div class="mx-auto max-w-4xl">
            <p class="text-center">L'outil d'analyse du <b>Recrutement</b> permet aux entreprises de s'autoévaluer
                sur l'ensemble des leviers d'amélioration en matière d'emploi des seniors. Il positionne leurs résultats
                par rapport aux autres entreprises de leur secteur d'activité ou de leur taille. Les critères évalués
                s'inscrivent dans les référentiels Environnementaux, Sociaux et de Gouvernance (ESG) ainsi que dans les
                Objectifs de Développement Durable (ODD).</p>

            <img src="{{ asset('images/home-notes.png') }}" alt="notes" class="mt-2 rounded">

            <div class="text-center mt-4 space-y-2">

                <p>À l'image du Nutri-Score qui renseigne sur la qualité nutritionnelle d'un produit, l'outil d'analyse
                    du <b>Recrutement</b> évalue la qualité de l'engagement d'une entreprise en faveur de
                    l'employabilité des seniors.
                </p>
                <p>
                    Il offre une évaluation transparente des actions et des initiatives mises en place, dans une
                    démarche professionnelle inclusive et solidaire.
                </p>
                <p>
                    L'outil d'analyse du <b>Recrutement</b> vous permet de valoriser votre engagement en faveur de
                    l'emploi des seniors auprès de vos parties prenantes : consommateurs, partenaires commerciaux
                    et investisseurs.
                </p>
            </div>
        </div>

        {{-- Themes --}}
        <div class="mt-10 max-w-7xl mx-auto text-center sm:px-6 lg:px-8">
            <x-h1 class="uppercase text-4xl">8 thèmes</x-h1>

            <div class="mt-6 grid md:grid-cols-2 lg:grid-cols-4 gap-4">

                @foreach ($sections as $section)
                    <x-card.theme :title="$section->title" :icon="$section->icon" />
                @endforeach

            </div>

            <a href="{{ route('dashboard') }}">
                <x-primary-button class="mt-6">
                    Calculer mon indice de recrutement
                </x-primary-button>
            </a>
        </div>

    </x-container>
    
</x-guest-layout>
