@props(['products'])

<catalog>
    <section class="catalogStructure">
        <main class="catalog">
            <h1 style="margin-top: 5%; margin-bottom: 2%;">Catalog</h1>
            <hr style="border-top:1px grey solid; " width="90%">
            <div class="catalogContent">
                @foreach($products as $product)
                    <a href="{{ url('/product/'.$product->product_id) }}" style="text-decoration: none; color:inherit;"><x-productCard :product="$product"></x-productCard></a>    
                @endforeach 
            </div>
            <hr style="border-top:1px grey solid; " width="90%">
            <div class="pagination" style="margin-bottom: 5%;">
                {{$products->links()}}
            </div>
        </main>

        <script>
            // Save scroll position in sessionStorage
            window.addEventListener('beforeunload', function() {
                sessionStorage.setItem('scrollPosition', window.scrollY);
            });
        
            // Restore scroll position after page load
            window.addEventListener('load', function() {
                if (sessionStorage.getItem('scrollPosition') !== null) {
                    window.scrollTo(0, parseInt(sessionStorage.getItem('scrollPosition')));
                }
            });
        </script>
        
        

        <aside class="filters">
            <h1 style="margin-top: 20%; margin-bottom: 10%;">Filters</h1>
        </aside>
    </section>
</catalog>