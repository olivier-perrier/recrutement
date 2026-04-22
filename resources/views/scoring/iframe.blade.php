
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">


@vite(['resources/css/app.css', 'resources/js/app.js'])


<div class="border rounded border-indigo-500 w-fit p-4 bg-indigo-200">

    <div class="flex justify-between">
        <h2 class="font-bold text-xl self-center">
            Analyse du recrutement
            {{ @$scoring->company->name }}
        </h2>
        <img src="{{ asset('images/logo-full.png') }}" alt="" class="h-16 ml-6 ">
    </div>

    <div class="mt-4 px-4">
        Certifié recrutement rang {{$scoring->rank}}
    </div>

</div>
