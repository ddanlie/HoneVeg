@props(['product', 'product_exinfo'])

<x-default>
    <x-header></x-header>
    <div class="productErrMsg">
        @php $style = "font-size: 16px; color:red; text-align:center;" @endphp
        @if(!$errors->any())
            <h2 style="{{$style}}  visibility:hidden;">fantom error message</h2>
        @else
            @foreach($errors->all() as $message)
                <h2 style="{{$style}}">{{$message}}</h2>     
            @endforeach
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
                    <img width=350 height=500 src="{{asset($avatarPath)}}" style="border-radius: 5%;">
                @else
                    <img width=350 height=500 style="border-radius: 5%;">
                @endif
                @can('sell-product', $product->product_id)
                    <form id="loadimgform" method="POST" action={{url('/profile/'.$userPageOwner->user_id)}} enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <input type="file" name="image">    
                    </form>
                    <h2 style="font-size:16px;">Image size: 350x500</h2>
                    <x-defaultButton form="loadimgform" type="submit" name="edit_profile" value="change_avatar">Load image</x-defaultButton>    
                @endcan   
            </div>
        </div>

        <div class="productBaseRight">

        </div>
    </div>
</x-default>