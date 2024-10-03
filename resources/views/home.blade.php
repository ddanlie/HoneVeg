@props(['products'])

<x-default>
    <x-postHeaderContent>
    </x-postHeaderContent>

    <x-catalog :products="$products"></x-catalog>
    

</x-default>