@props(['product'])


<div class="catalogCard">
    
    <div class="cardInfo">
        
        <a href="{{ url('/product/'.$product->product_id) }}"><img width=200 height=150 src="{{asset('/images/products/' . $product->product_id . '.jpg')}} " style="border-radius: 10%;"></a>
       
        <div>
            <h1 style="margin-bottom: 5%;">{{$product->name}}</h1>
            <h2>{{$product->price}} KČ</h2>
        </div>
    </div>


    <div class="cardInteractivePanel">

    </div>

</div>