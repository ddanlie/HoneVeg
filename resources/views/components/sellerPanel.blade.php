@props(['currentCategoryId'])

<div class="panel">
    <h1>Add my product to this category</h1>
    <a href="{{url("/product/create-in/".$currentCategoryId)}}"><x-navButton style="height: 50px; border-radius:50px;">+</x-navButton></a>

</div>