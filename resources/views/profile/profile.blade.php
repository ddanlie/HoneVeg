@props(['user', 'user_earned'])

<x-default>
    <x-header></x-header>
    <div class="userBaseLeft">
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
        <div class="profileImageContent">
            @php 
                $avatarPath = 'images/users/'.$user->user_id.'.jpg';
                $checkPath = public_path($avatarPath) 
            @endphp
            @if(file_exists($checkPath))
                <img width=350 height=500 src="{{asset($avatarPath)}}">
            @else
                <img width=350 height=500 src="{{asset('/images/default/defaultAvatar.jpg')}}">
            @endif
            <form method="POST" action={{url('/profile/'.$user->user_id)}} enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <input type="file" name="image">
                <h2>Image size: 350x500</2>
                <x-defaultButton type="submit" name="edit_profile" value="change_avatar" >Load image</x-defaultButton>
            </form>
        </div>
        <div>
            <div>
                <h2>Status:</h2>
                <h2>
                    @can('be-admin')
                        Admin
                    @endcan
                </h2>
                <h2>
                    @can('be-moder')
                        Moder
                    @endcan
                </h2>
                <h2>
                    @can('be-seller')
                        Seller
                    @endcan
                </h2>
                <h2>User</h2> 
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
        <div>
            <h2>Earned {{$user_earned}}</h2>
        </div>
    </div>
</x-default>