<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProfileController extends Controller
{
    public function index($user_id)
    {
        $user = User::where('user_id', $user_id)->first();


        $ords = $user->sellerOrders();
        $earnings = 0;
        if($ords)
            $earnings = $ords->with('order_product_list')->with('products')->where('seller_id', $user_id);
        
        return view('profile.profile', [
            'user' => $user,
            'user_earned' => $earnings
        ]);
    }

    public function edit(Request $request, $user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        $redirection = redirect()->route("profile.index", ['user_id' => $user_id]);
        switch ($request->input('edit_profile')) {
            case 'stop_selling':
                //check if he deleted all events/products
                
                if($user->saleProducts()->count() == 0 
                && $user->sellerOrders()->where('status', 'in process')->count() == 0 
                && $user->events()->count() == 0)       
                {
                    $user = User::where('user_id', $user_id)->roles()->where('role', 'seller')->detach();
                }          
                else
                {
                    return $redirection->withErrors([
                            'edit_profile' => 'You have to delete active orders or existing products/events to stop selling'
                        ]);
                }
                break;
            case 'start_selling':
                if($user->roles->contains('role', 'seller'))
                    return $redirection->withErrors([
                        'edit_profile' => 'You are already selling'
                    ]);
                if(file_exists(public_path('/images/users/'.$user_id.'.jpg')))
                {
                    $roles = new Roles;
                    $roles->user_id = $user_id;
                    $roles->role = 'seller';
                    $roles->save();
                }
                else
                {
                    return $redirection->withErrors([
                            'edit_profile' => 'You have to set your avatar to become a seller. '
                        ]);
                }
                break;
            case 'change_avatar':
                
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,jpg,png|dimensions:max_width=350,min_width=350,max_height=500,min_height=500,',
                ]);
                request()->image->move(public_path('images/users/'), $user_id.'.jpg');  

                break;
        }
        return $redirection;
    }
    
}
