@props(['name', 'label', 'type' => 'text', 'required' => false])

<div>

    <x-input-label :for="$name" :value="$label . ' ' . ($required ? '*' : '')" />

    <x-text-input :id="$name" class="block mt-1 w-full" :type="$type" :name="$name"
        {{ $attributes->merge(['value']) }} :required="$required" />

    <x-input-error :messages="$errors->get($name)" class="mt-2" />

</div>
