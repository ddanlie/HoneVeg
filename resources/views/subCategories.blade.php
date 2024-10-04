@props(['hierarchy', 'subcategories', 'categoryProducts']) <!-- hierarchy is an ordered array where [0] is main category, [1] its subacegory [2] sub-subcategory ... -->

<x-default>

    <x-header></x-header>

    <div class="subcategories">
        <div class="subcatsNavigation">
            @php $path = "/categories"; @endphp
            @foreach ($hierarchy as $subcatName)
                @php $path .= "/".$subcatName; @endphp
                <a href="{{ url("$path") }}" ><h2>{{$subcatName}}</h2></a>
                @if (!$loop->last)
                    <img width=20 height=20 src="{{asset('/icons/subcatNavArrow.png')}}">
                @endif
            @endforeach
        </div>
        <div class="subcatsGeneral">
            <div class="subcatsPreview">
                @if($subcategories)
                    @foreach($subcategories as $subcat)
                        @php $subpath = $path . '/' . $subcat->name @endphp
                        <a href="{{ url($subpath) }}"><x-categoryCard :category="$subcat" :isSubcat="true"></x-categoryCard></a>
                    @endforeach
                @endif
            </div>
        </div>
        <x-catalog :products="$categoryProducts"></x-catalog>
    </div>


</x-default>

