<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // Check if the course is already in the cart
        $CartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id == $id;
        });

        if ($CartItem->isNotEmpty()) {
            return response()->json(['error' => 'The Course is already in your Cart']);
        }

        $price = $course->discount_price ?? $course->selling_price;

        Cart::add([
            'id' => $id,
            'name' => $request->course_name,
            'qty' => 1,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'image' => $course->course_image,
                'slug' => $course->course_name_slug,
                'instructor' => $course->instructor,
            ]
        ]);

        return response()->json(['success' => 'Added To Cart']);
    }
    // End of Method
    public function CartData()
    {
        $cart = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'cart' => $cart,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }
    // End of Method
    public function AddMiniCart()
    {
        $cart = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'cart' => $cart,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }
    // End of Method
    public function RemoveMiniCart($id)
    {
        Cart::remove($id);

        return response()->json(['success' => 'Course Removed from Cart']);

    }
    // End of Method
    public function MyCart()
    {
        return view('frontend.mycart.view_mycart');
    }
    // End of Method
    public function GetCartCourse()
    {
        $cart = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'cart' => $cart,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }
    // End of Method
    public function RemoveCart($id)
    {
        Cart::remove($id);

        return response()->json(['success' => 'Course Removed from Cart']);

    }    // End of Method
}
