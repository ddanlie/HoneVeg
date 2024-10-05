@props(['user', 'user_exinfo'])

<x-default>
    <x-header></x-header>
    <div class="profileErrMsg">
        @php $style = "font-size: 16px; color:red; text-align:center;" @endphp
        @if(!$errors->any())
            <h2 style="{{$style}}  visibility:hidden;">fantom error message</h2>
        @endif

        @error('edit_profile') 
            <h2 style="{{$style}}">{{$message}}</h2>
        @enderror

        @error('image') 
            <h2 style="{{$style}}">{{$message}}</h2>
        @enderror
    </div>
    <div class="userBase">
        <div class="userBaseLeft">

            <div class="profileImageContent">
                @php 
                    $avatarPath = 'images/users/'.$user->user_id.'.jpg';
                    $checkPath = public_path($avatarPath) 
                @endphp
                @if(file_exists($checkPath))
                    <img width=350 height=500 src="{{asset($avatarPath)}}" style="border-radius: 5%;">
                @else
                    <img width=350 height=500 src="{{asset('/images/default/defaultAvatar.jpg')}}" style="border-radius: 5%;">
                @endif
                <form id="loadimgform" method="POST" action={{url('/profile/'.$user->user_id)}} enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <input type="file" name="image">    
                </form>
                <h2 style="font-size:16px;">Image size: 350x500</h2>
                <x-defaultButton form="loadimgform" type="submit" name="edit_profile" value="change_avatar">Load image</x-defaultButton>
            </div>
            <div class="statusInfo">
                <div>
                    <h1>Status:</h1>
                    <h2>User</h2> 
                    @php
                        $cans = ['be-admin' => 'Admin', 'be-moder' => 'Moder', 'be-seller' => 'Seller'];
                        $could = 0;
                    @endphp

                    @foreach($cans as $what => $who)
                        {{-- @can($what) --}}
                            @php
                                $could += 1;
                            @endphp
                            <h2>{{$who}}</h2>
                        {{-- @endcan --}}   
                    @endforeach

                    @php
                        for($i = 0; $i < count($cans)-$could; $i++)
                            echo '<h2 style="visibility:hidden;">fantom status</h2>'
                    @endphp
                    
                    {{-- @can('be-admin')
                        <h2>Admin</h2>
                    @else
                        <h2 style="visibility:hidden;">fantom status</h2>
                    @endcan

                    @can('be-moder')
                        <h2>Moder</h2>
                    @else
                        <h2 style="visibility:hidden;">fantom status</h2>
                    @endcan
                
                    @can('be-seller')
                        <h2>Seller</h2>
                    @else
                        <h2 style="visibility:hidden;">fantom status</h2>
                    @endcan
                     --}}

                    <hr></hr>
                </div>
                <form id="editForm" method="POST" action={{url('/profile/'.$user->user_id)}}>
                    @csrf
                    @method("PATCH")
                </form>
                @can('be-seller')
                    <x-defaultButton form="editForm" type="submit" name="edit_profile" value="stop_selling">Stop selling</x-defaultButton>
                @else
                    <x-defaultButton form="editForm" type="submit" name="edit_profile" value="start_selling">Start selling</x-defaultButton>
                @endcan
            </div>
        </div>

        <div class="userBaseRight">
            <h1>Info</h1>
            
            <div class="userInfo">
                <hr></hr>
                <span style="display: flex; justify-content: space-between;"><h2>Earned:</h2><h2>{{$user_exinfo['earned']}} Kč</h2></span>
                <span style="display: flex; justify-content: space-between;"><h2>Rating:</h2><h2>{{$user_exinfo['rating']}}/5</h2></span>
            </div>
        </div>
    </div>
    <div class="userActivities">
            <div class="activity myActivity">
                    <h1 style="color:white;">Rated products</h1>
                    @foreach($user_exinfo['ratedProducts'] as $product)
                    <a href="{{url('/product/'.$product->product_id)}}">
                        <div class="activityItem">
                            <h2>{{$product->name}}</h2>
                            <h2>{{$product->rating}}/5</h2>
                        </div> 
                    </a>
                    @endforeach
            </div>
            
            <div class="activity myActivity">
                    <h1 style="color:white;">My events</h1>
                    @foreach($user_exinfo['events'] as $event)
                    <a href="{{url('/events/'.$event->event_id)}}">
                        <div class="activityItem">
                            <h2>{{$event->name}}</h2>
                            @php
                                $date = date_parse($event->start_date);
                                $hrdate = $monthName = $date['day'].' '.date('M', mktime(0, 0, 0, $date['month'], 0)).' '.$date['hour'].':'.$date['minute'];
                            @endphp
                            <h2>{{$hrdate}}</h2>
                        </div> 
                    </a>
                    @endforeach
            </div>

            <div class="activity myActivity">
                <h1 style="color:white;">My orders</h1>
                @foreach($user_exinfo['orders'] as $order)
                <a href="{{url('/orders/'.$order->order_id)}}">
                        @php 
                            $date = date_parse($order->creation_date);
                            $hrdate = $monthName = $date['day'].' '.date('M', mktime(0, 0, 0, $date['month'], 0)).' '.$date['hour'].':'.$date['minute'];

                            $states =  ['draft' => 'white', 'in process' => 'yellow', 'cancelled' => 'red', 'delivered' => 'green'];
                            $color = $states[$order->status];
                        @endphp
                    <div class="activityItem" style="background-color: {{$color}};">

                        <h2>{{$hrdate}}</h2>
                        <h2>{{$order->status}}</h2>
                    </div> 
                </a>
                @endforeach
            </div>

            <div class="activity myActivity">
                <h1 style="color:white;">My designs:TODO</h1>
                @foreach($user_exinfo['orders'] as $order)
                <a href="{{url('/orders/'.$order->order_id)}}">
                    <div class="activityItem">
                        <h2>d1</h2>
                        <h2>d2</h2>
                    </div> 
                </a>
                @endforeach
            </div>

        @can('be-seller')           
            <div class="activity mySales">

            </div>

            <div class="activity productsForSale">

            </div>
        @endcan

        @can('be-moder')   
            <div class="activity suggestedDesigns">

            </div> 
        @endcan     

        {{-- @can('be-admin')  --}}
            <div class="activity moders">

            </div>
        {{-- @endcan --}}
        
        <script>
            const pointerXScroll = (elem) => {
            let isDragging = false;
            let pd = false;
            let startX = 0;
            let distX = 0;

            elem.addEventListener("pointerdown", (ev) => {
                isDragging = false;
                pd = true;
                startX = ev.clientX;
                distX = 0;
                ev.preventDefault();
            });

            elem.addEventListener("pointermove", (ev) => {
                if (pd) {
                    const moveX = ev.clientX - startX;
                    elem.scrollLeft -= moveX;
                    isDragging = true;
                    distX += Math.abs(moveX);
                    startX = ev.clientX;
                }
            });

            elem.addEventListener("pointerup", () => {
                pd = false;
            });

            elem.addEventListener("click", (ev) => {
                if (isDragging) {
                    ev.preventDefault();
                    isDragging = false;
                }
            });

            elem.addEventListener("touchstart", (ev) => {
                isDragging = false;
                pd = true;
                startX = ev.touches[0].clientX;
                distX = 0;
            });

            elem.addEventListener("touchmove", (ev) => {
                if (pd) {
                    const moveX = ev.touches[0].clientX - startX;
                    elem.scrollLeft -= moveX;
                    isDragging = true;
                    distX += Math.abs(moveX);
                    startX = ev.touches[0].clientX;
                }
            });

            elem.addEventListener("touchend", (ev) => {
                if (distX < 5) {
                    isDragging = false;
                }
                pd = false;
            });
        };

            document.querySelectorAll(".userActivities").forEach(pointerXScroll);
        </script>
    </div>

</x-default>