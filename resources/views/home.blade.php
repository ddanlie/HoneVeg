@props(['products'])

<x-default>
    <x-header></x-header>

    <x-catalog :products="$products"></x-catalog>
    

</x-default>