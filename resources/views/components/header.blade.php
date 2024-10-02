<nav class="headerStyle" id="headView">
    <h1 class="logo">HoneVeg</h1>
    <div class="navButtons">
        @php
            $notChosen = "notChosenButton";
            $chosen = "chosenButton";
            $visible = "visibleElement";
            $hidden = "hiddenElement";

            $homeBtn = $catBtn = $evBtn = $regBtn = $signinBtn = $notChosen;
        @endphp
            
        @if (Route::currentRouteNamed("home.index")) @php $homeBtn = $chosen; @endphp @endif
        @if (Route::currentRouteNamed("categories.index")) @php $catBtn = $chosen; @endphp @endif
        @if (Route::currentRouteNamed("events.index")) @php $evBtn = $chosen; @endphp @endif
        @if (Route::currentRouteNamed("registration.index")) @php  $regBtn =  $chosen;  @endphp @endif 
        @if (Route::currentRouteNamed("signin.index")) @php $signinBtn =  $chosen; @endphp @endif 

        <a href={{ url("/home") }}><x-navButton class={{$homeBtn}}>Home</x-navButton></a>
        <a href="{{ url("/categories") }}"><x-navButton class={{$catBtn}}>Categories</x-navButton></a>
        <a href="{{ url("/events") }}"><x-navButton class={{$evBtn}}>Events</x-navButton></a>
    </div>
    <div class="regButtons">
        @guest
            <a href="{{ url("/register") }}"><x-defaultButton class={{$regBtn}}>Register</x-defaultButton></a>
            <a href="{{ url("/signin") }}"><x-defaultButton class={{$signinBtn}}>Sign In</x-defaultButton></a>
        @endguest

        @auth
            <a href="{{ url("/profile") }}" style="display:flex"><img src="{{ asset('/icons/user.png') }}" width=35 heigh=35 style="background-color: var(--background-style); border-radius: 30px;"></a>
            <a href="{{ url("/home") }}" style="display:flex; align-items:center; text-decoration: none;"><x-defaultButton class={{$signinBtn}}>Log out</x-defaultButton></a>
        @endauth
    </div>
</nav>