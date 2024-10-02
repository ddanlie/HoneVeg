@props(['products'])

<x-default>
    <x-postHeaderContent>
    </x-postHeaderContent>
        <section class="homeContent">
        
        <main class="catalog">
            <h1 style="margin-top: 5%; margin-bottom: 10%;">Catalog</h1>
            
            <div class="catalogContent">
                @foreach($products as $product)
                    <h1>{{$product->name}}</h1>
                @endforeach 
            </div>
        </main>

        <aside class="filters">
            <h1 style="margin-top: 20%; margin-bottom: 10%;">Filters</h1>
        </aside>
        </section>
    

</x-default>