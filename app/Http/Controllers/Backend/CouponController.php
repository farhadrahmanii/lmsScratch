<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function AllAdminCoupons()
    {

        $allCoupons = Coupon::latest()->get();

        return view('admin.backend.coupons.all_coupons', compact('allCoupons'));

    }//End of Method

    public function CreateAdminCoupon()
    {
        return view('admin.backend.coupons.createadminCoupon');

    }//End of Method
    public function StoreAdminCoupon(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'validaty' => 'required|date|after_or_equal:today',
        ]);

        Coupon::create([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'validaty' => $request->validaty,
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);

    }//End of Method
    public function EditAdminCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.backend.coupons.editAdminCoupon', compact('coupon'));

    }//End of Method
    public function UpdateAdminCoupon(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'validaty' => 'required|date|after_or_equal:today',
        ]);

        Coupon::findOrFail($request->id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'validaty' => $request->validaty,
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);

    }//End of Method
    public function DeleteAdminCoupon($id)
    {
        $coupon = Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);

    }//End of Method
}
