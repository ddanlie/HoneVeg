<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        if(!$user)
            return redirect()->route("home.index");

        $exinfo = [
            'earned' => 0, 
            'rating' => 0, 
            'ratedProducts' => [],
            'events' => [],
            'orders' => []
        ];
         
        //earned
        $earned = DB::table('products')
        ->join('order_product_lists', 'products.product_id', '=', 'order_product_lists.product_id')
        ->join('orders', 'order_product_lists.order_id', '=', 'orders.order_id')
        ->join('seller_orders', 'orders.order_id', '=', 'seller_orders.order_id')
        ->where([['products.seller_user_id', $user_id], ['orders.status', 'delivered']]);
        if($earned)
        {
            $earned = $earned->select(DB::raw('SUM(products.price * order_product_lists.product_amount) as total_earnings'))
                   ->value('total_earnings');
                   
            $exinfo['earned'] = $earned; 
        }
        
        
        //rating
        $count = $user->saleProducts()->count();
        if($count > 0)
        {
            $ratingSum = $user->saleProducts()->select(DB::raw('SUM(products.total_rating) as rating_sum'))->value('rating_sum');
            $exinfo['rating'] = $ratingSum / $count;
        }
        
        //rated products
        $rated = $user->ratings()->join('products', 'ratings.product_id', '=', 'products.product_id')->get();
        if($rated)
            $exinfo['ratedProducts'] = $rated;

        //events
        $events = $user->events()->get();
        if($events)
            $exinfo['events'] = $events;

        //orders
        $orders = $user->createdOrders()->get();
        if($orders)
            $exinfo['orders'] = $orders;

        return view('profile.profile', [
            'userPageOwner' => $user,
            'user_exinfo' => $exinfo
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
                && (($user->sellerOrders() ? $user->sellerOrders()->where('status', 'in process')->count() : 0) == 0)
                && $user->events()->count() == 0)       
                {
                    $user = $user->roles()->where('role', 'seller')->delete();
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
