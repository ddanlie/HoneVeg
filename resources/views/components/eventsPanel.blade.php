<div class="panel">
    @can('be-seller')
    <div>
        <h1>Add event</h1>
        <a href="{{url("/events/create/")}}"><x-navButton style="height: 50px; border-radius:50px;">+</x-navButton></a>
    </div>
    @endcan
</div>