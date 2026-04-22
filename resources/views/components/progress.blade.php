@props(['pourcent' => 50])

<div class="w-full bg-gray-200 rounded-full dark:bg-gray-100">
    <div @class([
        'text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full',
        'bg-blue-600' => $pourcent > 0,
        'text-blue-600' => $pourcent <= 0
    ]) style="width: {{ $pourcent }}%">{{ $slot }}</div>
</div>
