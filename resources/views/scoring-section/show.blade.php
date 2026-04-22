<x-app-layout>

    <div class="grid grid-cols-3">

        <div class="col-span-2">

            <a href="{{route('scorings.show', $scoring)}}" class="text-blue-500 hover:underline">
                <span>
                    < Retour aux catégories</span>
            </a>

            <div class="mt-2 flex space-x-2">
                <img src="{{asset('images/icon_category_gouvergance.png')}}" alt="icon" class="h-10">
                <x-h1 class="content-center">{{$section->title}}</x-h1>
            </div>


            <div class="mt-10">
                Il n'y a pas encore de question dans cette catégorie
            </div>

        </div>

        <div class="mx-auto">
            side column
        </div>

    </div>


</x-app-layout>