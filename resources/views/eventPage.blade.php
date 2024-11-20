@props(['event', 'event_exinfo'])

<x-default>

    <x-header></x-header>
    <div class="eventErrMsg">
        @php 
            $style1 = "font-size: 16px; color:red; text-align:center;";
            $style2 = "font-size: 16px; color:green; text-align:center;";
        @endphp
        @if(!$errors->any() && !session()->has('message'))
            <h2 style="{{$style1}}  visibility:hidden;">fantom error message</h2>
        @else
            @foreach($errors->all() as $message)
                <h2 style="{{$style1}}">{{$message}}</h2>     
            @endforeach

            @if(session()->has('message'))
                <h2 style="{{$style2}}">{{session('message')}}</h2>
            @endif
        @endif
                    

    </div>


    <div class="eventBase">
        <div class="eventBaseLeft">
            @php 
                $avatarPath = 'images/events/'.$event->event_id.'.jpg';
                $checkPath = public_path($avatarPath) 
            @endphp
            @if(file_exists($checkPath))
                <img width=300 height=250 src="{{asset($avatarPath)}}" style="border-radius: 5%;">
            @else
                <img width=300 height=250 style="border-radius: 5%;">
            @endif 

            
            <h2>Event products</h2>
            <div class="eventProductList">
                @foreach($event_exinfo['products'] as $prod)
                    <a href="{{url('/product/'.$prod->product_id)}}">
                        <h3>{{$prod->name}}</h3>
                    </a>
                @endforeach
            </div>
        </div>



        <div class="eventBaseRight">
            <h1>{{$event->name}}</h1>
            <a href="{{url('/profile/'.$event->seller_id)}}">
                <h2>Seller - {{$event_exinfo['seller']->name}}</h2>
            </a>
            <div>
                <h2>Start date - {{$event->start_date}}</h2>
                <h2>End date - {{$event->end_date}}</h2>
            </div>

            {{$event->description}};

            <div class="eventButtons">
                <div>
                    @can('be-event-participant', $event->event_id)
                        <a href="{{url('/event/'.$event->event_id.'/remove')}}"><x-defaultButton>Remove</x-defaultButton></a>
                    @else
                        <a href="{{url('/event/'.$event->event_id.'/add')}}"><x-defaultButton>Add</x-defaultButton></a>
                    @endcan
                </div>
                @can('be-event-author', $event->event_id)
                    <a href="{{url('/event/'.$event->event_id.'/edit')}}"><x-defaultButton>Edit</x-defaultButton></a>
                @endcan
            </div>
        </div>

    </div>


</x-default>