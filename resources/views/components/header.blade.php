<nav class="headerStyle" id="headView">
    <h1 class="logo">HoneVeg</h1>
    <div class="navButtons">
        @php
            $notChosen = "notChosenButton";
            $chosen = "chosenButton";
            $homeBtn = $catBtn = $evBtn = $regBtn = $signinBtn = $notChosen;
        @endphp

        @if (Route::is("/home"))        $homeBtn = $chosen      @endif
        @if (Route::is("/categories"))  $catBtn = $chosen       @endif
        @if (Route::is("/events"))      $evBtn = $chosen        @endif
        @if (Route::is("/register"))    $regBtn =  $chosen      @endif
        @if (Route::is("/hsigninome"))  $signinBtn =  $chosen   @endif

        <a href={{ url("/home") }}><x-navButton class={{$homeBtn}}>Home</x-navButton></a>
        <a href="{{ url("/categories") }}"><x-navButton class={{$catBtn}}>Categories</x-navButton></a>
        <a href="{{ url("/events") }}"><x-navButton class={{$evBtn}}>Events</x-navButton></a>
    </div>
    <div class="regButtons">
        <a href="{{ url("/registration") }}"><x-defaultButton class={{$regBtn}}>Registration</x-defaultButton></a>
        <a href="{{ url("/signin") }}"><x-defaultButton class={{$signinBtn}}>Sign In</x-defaultButton></a>
    </div>
</nav>