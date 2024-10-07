@props(['product', 'product_exinfo'])

<x-default>


    <x-header></x-header>
    <div class="productErrMsg">
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


    <div class="productBase">
        <div class="productBaseLeft">
            <div class="productImageContent">
                @php 
                    $avatarPath = 'images/products/'.$product->product_id.'.jpg';
                    $checkPath = public_path($avatarPath) 
                @endphp
                @if(file_exists($checkPath))
                    <img width=300 height=300 src="{{asset($avatarPath)}}" style="border-radius: 5%;">
                @else
                    <img width=300 height=300 style="border-radius: 5%;">
                @endif
                {{-- @can('sell-product', $product->product_id)
                    <form id="loadimgform" method="POST" action={{url('/profile/'.$userPageOwner->user_id)}} enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <input type="file" name="image">    
                    </form>
                    <h2 style="font-size:16px;">Image size: 300x300</h2>
                    <x-defaultButton form="loadimgform" type="submit" name="edit_profile" value="change_avatar">Load image</x-defaultButton>    
                @endcan    --}}
                <h2>Available: {{$product->available_amount}}</h2>
                <div class="amountButtons">
                    <a onclick="minusOne();"><x-defaultButton>–</x-defaultButton></a>
                    <h1 id="chosenAmount">0</h1>
                    <a onclick="plusOne({{$product->available_amount}});"><x-defaultButton>+</x-defaultButton></a>
                </div>
                <form method="POST" action="{{url('product/'.$product->product_id)}}" onsubmit="javascript:setAmount();">
                    @csrf
                    <x-defaultButton type="submit" name="put_to_order" id="submitAmountButton">Buy</x-defaultButton>

                </form>
                

            </div>
        </div>

        <div class="productBaseRight">

        </div>
    </div>

    <script>
        
        function minusOne()
        {
            let amount = document.getElementById("chosenAmount");
            let x = parseInt(amount.textContent, 10) - 1;
            if(x < 0)
                x = 0;
            amount.textContent = x;
            return false;
        }

        function plusOne(available)
        {
       
            let amount = document.getElementById("chosenAmount");
            let x = parseInt(amount.textContent, 10) + 1;
            if(x > available)
                x = available;
            amount.textContent = x;
            return false;
        }

        function setAmount()
        {
            let amount = document.getElementById("chosenAmount");
            let submitter = document.getElementById("submitAmountButton");
            submitter.value = amount.textContent;
        }
    </script>


</x-default>