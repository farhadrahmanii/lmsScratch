<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishListController extends Controller
{
    public function addToWishList($course_id)
    {
        if (Auth::check()) {
            $exist = Wishlist::where('user_id', Auth::id())->where('course_id', $course_id)->first();

            if (!$exist) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'course_id' => $course_id,
                    'created_at' => now()
                ]);
                return response()->json(['success' => 'Course Successfully Added to Wishlist']);
            } else {
                return response()->json(['error' => 'This Course is already in your Wishlist']);
            }
        } else {
            return response()->json(['error' => 'Please log in first']);
        }
    } //end Method
    public function UserWishlist()
    {
        return view('frontend.wishlist.all_wishlist');
    } //end Method
    public function GetWishlist()
    {
        try {
            $wishlist = Wishlist::with('course')->where('user_id', Auth::id())->latest()->get();

            Log::info('Wishlist fetched successfully', ['wishlist' => $wishlist]);

            $wishQty = Wishlist::count();

            return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
        } catch (\Exception $e) {
            Log::error('Error fetching wishlist', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Unable to fetch wishlist'], 500);
        }
    } //end Method
    public function RemoveWishlist($id)
    {
        try {
            Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();

            return response()->json(['success' => 'Course is deleted successfully from Wishlist']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete wishlist', 'message' => $e->getMessage()], 500);
        }
    } //end Method
}
