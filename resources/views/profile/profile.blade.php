@props(['userPageOwner', 'user_exinfo'])

<x-default>
    <x-header></x-header>
    <div class="profileErrMsg">
        @php $style = "font-size: 16px; color:red; text-align:center;" @endphp
        @if(!$errors->any())
            <h2 style="{{$style}}  visibility:hidden;">fantom error message</h2>
        @else
            @foreach($errors->all() as $message)
                <h2 style="{{$style}}">{{$message}}</h2>    
            @endforeach
        @endif
    </div>
    <div class="userBase">
        <div class="userBaseLeft">
                <div class="profileImageContent">
                    @php 
                        $avatarPath = 'images/users/'.$userPageOwner->user_id.'.jpg';
                        $checkPath = public_path($avatarPath) 
                    @endphp
                    @if(file_exists($checkPath))
                        <img width=350 height=500 src="{{asset($avatarPath)}}" style="border-radius: 5%;">
                    @else
                        <img width=350 height=500 src="{{asset('/images/default/defaultAvatar.jpg')}}" style="border-radius: 5%;">
                    @endif
                    @can('own-given-profile-id', $userPageOwner->user_id)
                        <form id="loadimgform" method="POST" action={{url('/profile/'.$userPageOwner->user_id)}} enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <input type="file" name="image">    
                        </form>
                        <h2 style="font-size:16px;">Image size: 350x500</h2>
                        <x-defaultButton form="loadimgform" type="submit" name="edit_profile" value="change_avatar">Load image</x-defaultButton>    
                    @endcan   
                </div>
            <div class="statusInfo">
                <div>
                    <h1>{{$userPageOwner->name}}</h1>
                    {{-- <h1>Status:</h1> --}}
                    <h2>User</h2> 
                    @php
                        $cans = ['be-admin' => 'Admin', 'be-moder' => 'Moder', 'be-seller' => 'Seller'];
                        $could = 0;
                    @endphp

                    @foreach($cans as $what => $who)
                        @can($what, $userPageOwner->user_id)
                            @php
                                $could += 1;
                            @endphp
                            <h2>{{$who}}</h2>
                        @endcan   
                    @endforeach

                    @php
                        for($i = 0; $i < count($cans)-$could; $i++)
                            echo '<h2 style="visibility:hidden;">fantom status</h2>'
                    @endphp
                </div>
                <form id="editForm" method="POST" action={{url('/profile/'.$userPageOwner->user_id)}}>
                    @csrf
                    @method("PATCH")
                </form>
                @can('own-given-profile-id', $userPageOwner->user_id)
                    @can('be-seller')
                        <x-defaultButton form="editForm" type="submit" name="edit_profile" value="stop_selling">Stop selling</x-defaultButton>
                    @else
                        <x-defaultButton form="editForm" type="submit" name="edit_profile" value="start_selling">Start selling</x-defaultButton>
                    @endcan
                @endcan
            

            </div>
        </div>

        <div class="userBaseRight">
            <h1 style="margin-bottom: 40%;">Info</h1>
            
            <div class="userInfo">
                <hr></hr>
                @can('own-given-profile-id', $userPageOwner->user_id)
                    <span style="display: flex; justify-content: space-between;"><h2>Earned:</h2><h2>{{$user_exinfo['earned']}} Kč</h2></span>
                @endcan
                <span style="display: flex; justify-content: space-between;"><h2>Rating:</h2><h2>{{$user_exinfo['rating']}}/5</h2></span>
            </div>
        </div>
    </div>
    <div class="userActivities">
        @can('own-given-profile-id', $userPageOwner->user_id)
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
                    <h1 style="color:white;">Events</h1>
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
                <h1 style="color:white;">Orders</h1>
                @foreach($user_exinfo['orders'] as $order)
                <a href="{{url('/order/'.$order->order_id)}}">
                        @php 
                            $date = date_parse($order->creation_date);
                            $hrdate = $monthName = $date['day'].' '.date('M', mktime(0, 0, 0, $date['month'], 0)).' '.$date['hour'].':'.$date['minute'];

                            $states =  ['cart' => 'white', 'in process' => 'yellow', 'canceled' => 'red', 'delivered' => 'green'];
                            $color = $states[$order->status];
                            if(!$color)
                                $color = "white";
                        @endphp
                    <div class="activityItem" style="background-color: {{$color}};">

                        <h2>{{$hrdate}}</h2>
                        <h2>{{$order->status}}</h2>
                    </div> 
                </a>
                @endforeach
            </div>

            <div class="activity myActivity">
                <h1 style="color:white;">Designs:TODO</h1>
                @foreach($user_exinfo['orders'] as $order)
                <a href="{{url('/orders/'.$order->order_id)}}">
                    <div class="activityItem">
                        <h2>d1</h2>
                        <h2>d2</h2>
                    </div> 
                </a>
                @endforeach
            </div>

            @can('be-seller', $userPageOwner->user_id){{-- if page owner is a seller, he can watch this  --}}
                <div class="activity myActivity">
                    <h1 style="color:white;">Sales</h1>
                    @foreach($user_exinfo['sellerOrds'] as $ord)
                        <div class="activityItem">
                            @php
                                $total = 0 ;
                                $s = ["canceled"=>"red", "accepted"=>"green"];
                            @endphp
                            <h2 style="margin: 0 0 7% 0; color:{{$s[$ord->status]}};">{{$ord->order->creation_date}}</h2>
         
                            @foreach($ord->orderProducts as $prod)
                                @php 
                                    $price = $prod->pivot->product_amount*$prod->price;
                                    $total += $price 
                                @endphp
                                <div style="display:flex; flex-direction:column; border: 1px solid black; align-items:center; width:100%;">
                                    <h2>{{$prod->name}} x{{$prod->pivot->product_amount}}</h2>
                                    <h5>({{$price}})Kč</h5>
                                </div>    
                            @endforeach
                            <h2 style="margin: 4% 0 4% 0;">Total: {{$total}}Kč</h2>
                            <div>
                                <form id="patchStatusForm{{$ord->order->order_id}}" method="POST" action="{{url('/order/'.$ord->order->order_id.'/edit')}}">{{-- ERRORRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR--}}
                                    @csrf
                                    @method("PATCH")
                                    <input id="patchInput{{$ord->order->order_id}}" name="whatToDo" type="hidden">

                                </form>
                                <x-defaultButton onclick="acceptPatch({{$ord->order->order_id}})">Accept</x-defaultButton>
                                <x-defaultButton onclick="cancelPatch({{$ord->order->order_id}})">Cancel</x-defaultButton>

                                <script>
                                    i = document.getElementById("patchInput");


                                    function acceptPatch(id)
                                    {
                                        f = document.getElementById("patchStatusForm"+id);
                                        i = document.getElementById("patchInput"+id);
                                        i.value = "accept";
                                        f.submit();
                                    }
                                    function cancelPatch(id)
                                    {
                                        f = document.getElementById("patchStatusForm"+id);
                                        i = document.getElementById("patchInput"+id);
                                        i.value = "cancel";
                                        f.submit();
                                    }
                                </script>
                            </div>
                        </div> 
                    @endforeach
                </div>
            @endcan
        @endcan <!-- be profile owner -->   
        

        {{-- any user can see what products this guy sells, of course if he is a seller --}}
        @can('be-seller', $userPageOwner->user_id)
            <div class="activity myActivity">
                <h1 style="color:white;">Sold products</h1>
                @foreach($user_exinfo['soldProds'] as $saleProd)
                    <a href="{{url('/product/'.$saleProd->product_id)}}">
                        <div class="activityItem">
                            <h2>{{$saleProd->name}}</h2>
                            <h2>{{$saleProd->price}} Kč</h2>
                        </div> 
                    </a>
                @endforeach
            </div>
        @endcan  

        @can('be-moder')   
            <div class="activity suggestedDesigns">

            </div> 
        @endcan     

        @can('be-admin') 
            <div class="activity moders">

            </div>
        @endcan
        
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