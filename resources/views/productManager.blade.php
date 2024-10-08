@props(['creationCategory', 'product', 'labeHeap', 'create']) 

<x-default>
    <x-header></x-header>   
    <div class="productEditErrMsg">
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
    <div class="productEditor">
        @if($create)
            <h1>Product create</h1>
        @else
            <h1>Product edit</h1>
        @endif
        <form id="prodeditform" method="POST" action="{{url('/product/create-in/'.$creationCategory->category_id)}}"  enctype="multipart/form-data">
            @csrf
            <label>
                <h2>Product image</h2>
                <h5>(size 300x300)</h5>
                <input type="file" name="image" style="margin: 2% 0 0 11%;"> 
            </label> 
            <label>
                <h2>Product name</h2>
                <input required type="text" name="pname" minlength=2 maxlength=64 value="{{ $create ? old('pname') : $product->name}}">
            </label>

            <label>
                <h2>Category</h2>
                <h5>(read only)</h5>
                <input type="text" readonly value="{{$creationCategory->name}}">
            </label>

            <label>
                <h2>Description</h2>
                <textarea maxlength=300 name="pdescr" rows="20" cols="50" value="{{$create ? old('pdescr') : $product->description}}">
                </textarea>
            </label>

            <label>
                <h2>Available amount</h2>
                <h5>(set 0 if you want this product to be in event only or if you dont want to start product sells immidiately. You can edit this field later)</h5>
                <input required type="number" name="pavail" min="0" max="10000" value="{{$create ? old('pavail') : $product->available_amount}}">
            </label>

            <label>
                <h2>Price (Kč)</h2>
                <h5>(price is set for "100 g" "1 kg" or "1 piece", choose price type below)</h5>
                <input required type="number" name="pprice" min="0" max="10000" value="{{$create ? old('pprice') : $product->price}}">
            </label>


                <h2>Categories data</h2>
                @if($create)
                    @foreach($labeHeap as $catLabels)
                        @foreach($catLabels as $index => $label)
                        <label>
                            <h4>{{$label->name}}</h4>
                            <input type="hidden" name="lblids[]" value="{{$label->label_id}}">
                            @switch($label->type)
                                @case("int")
                                    <input required type="number" min="0" name="cols[]" value="{{old('cols'.$index)}}">
                                    @break
                                @case("text")
                                    <input required type="text" maxlength=40 name="cols[]" value="{{old('cols'.$index)}}">
                                    @break
                                @default                            
                            @endswitch  
                        </label>                     
                        @endforeach
                    @endforeach
                @else
                    @foreach($labeHeap as $prodLabel)
                    <label>
                        <h4>{{$prodLabel->name}}</h4>
                        <input type="hidden" name="lblids[]" value="{{$label->label_id}}">
                        @switch($$prodLabel->type)
                            @case("int")
                                <textarea required type="number" min="0" name="cols[]" value="{{$prodLabel->label_value}}">
                                @break
                            @case("text")
                                <textarea required type="text" maxlength=40 name="cols[]" value="{{$prodLabel->label_value}}">
                                @break                    
                            @default                        
                            @endswitch
                    </label>
                    @endforeach           
                @endif

        </form>
        <x-defaultButton form="prodeditform" type="submit">Done</x-defaultButton>
    </div>
</x-default>