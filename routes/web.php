<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\instructorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\userController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [userController::class, 'home'])->name('home');



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [userController::class, 'UserDashboard'])->name('dashboard');
    Route::get('/user/profile', [userController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [userController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/change/password', [userController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/passwordUpdating', [userController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/user/profile/logout', [userController::class, 'UserLogout'])->name('user.logout');

    // User Wishlist all Routes
    Route::controller(WishListController::class)->group(function () {
        Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-course', 'GetWishlist');
        Route::get('/wishlist-remove/{id}', 'RemoveWishlist');
    });

    // User My Course all Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/user/my-course', 'MyCourse')->name('my.course');
        Route::get('/course/view/{course_id}', 'CourseView')->name('course.view');
    });
});

require __DIR__ . '/auth.php';

Route::get('/check-email', function (Request $request) {
    $email = $request->query("email");

    if (!$email) {
        return response()->json(['status' => 'error', 'message' => 'No email provided'], 400);
    }

    $user = User::where('email', $email)->first();

    if ($user) {
        return response()->json(['status' => 'failed', 'message' => 'Email already exists']);
    } else {
        return response()->json(['status' => 'success', 'message' => 'Email is available']);
    }
})->name("checkEmail");
// Admin Dashboard
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [adminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [adminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [adminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [adminController::class, 'Store'])->name('admin.profile.store');
    Route::get('/admin/profile/AdminChangePassword', [adminController::class, 'AdminChangePassword'])->name('admin.profile.ChangePassword');
    Route::post('/admin/profile/AdminpasswordUpdate', [adminController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    // category all Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'index')->name('all.category');
        Route::get('/category/create', 'create')->name('add.category');
        Route::post('/category/store', 'store')->name('store.category');
        Route::get('/category/edit/{id}', 'edit')->name('edit.category');
        Route::patch('/category/update/{id}', 'update')->name('update.category');
        Route::get('/delete/category/{id}', 'destroy')->name('delete.category');
    });

    // SubCategory all Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/subcategory/create', 'CreateSubCategory')->name('add.subcategory');
        Route::post('/subcategory/store', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/subcategory/edit/{id}', 'editSubCategory')->name('edit.subcategory');
        Route::patch('/subcategory/update/{id}', 'updateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'destroySubCategory')->name('delete.subcategory');
    });
    //Instructor all Routes
    Route::controller(adminController::class)->group(function () {
        Route::get('/all/instructor', 'AllInstructor')->name('all.instructor');
        Route::post('/user/StatusUpdate', 'UpdateUserStatus')->name('update.user.status');
        Route::get('/instructor/create', 'CreateInstructor')->name('add.instructor');
    });
    // Admin get access all courses
    Route::controller(adminController::class)->group(function () {
        Route::get('/admin/all/course', 'AllCourses')->name('admin.all.course');
        Route::post('/update/course/status', 'UpdateCourseStatus')->name('update.course.status');
        Route::get('/admin/course/detail/{id}', 'AdminCourseDetail')->name('admin.course.detail');
    });
    // All Coupons Routes 
    Route::controller(CouponController::class)->group(function () {
        Route::get('/admin/all/coupon', 'AllAdminCoupons')->name('admin.all.coupon');
        Route::get('/admin/coupon/create', 'CreateAdminCoupon')->name('add.admin.coupon');
        Route::post('/admin/coupon/store', 'StoreAdminCoupon')->name('store.admin.coupon');
        Route::get('/admin/coupon/edit/{id}', 'EditAdminCoupon')->name('edit.admin.coupon');
        Route::post('/admin/coupon/update', 'UpdateAdminCoupon')->name('update.admin.coupon');
        Route::get('/admin/coupon/delete/{id}', 'DeleteAdminCoupon')->name('delete.admin.coupon');
    });


    // SMTP Setting all Routes
    Route::controller(SettingController::class)->group(function () {
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/smtp/update', 'SmtpUpdate')->name('update.smtp');
    });

    // all Admin Orders Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending/orders', 'PendingOrders')->name('admin.pending.order');
        Route::get('/confirm-order/{id}', 'PendingToConfirm')->name('admin-confirm-order');
        Route::get('/admin/order/details/{id}', 'AdminOrderDetials')->name('admin.order.detail');
        Route::get('/admin/confirm-order/list', 'AdminConfirmOrderList')->name('admin-confirm-order-list');
    });
    // Permission All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
        Route::get('/import/permissions', 'ImportPermissions')->name('import.permission');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import');

    });
    // Role Controller 
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/role', 'AddRole')->name('add.role');
        Route::post('/store/role', 'StoreRole')->name('store.role');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/update/role', 'UpdateRole')->name('update.role');
        Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role');






        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/roles/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permissions', 'AllRolePermission')->name('all.roles.permission');
        Route::get('/edit/role/permission/{id}', 'AdminEditRolePermission')->name('edit.rolepermission');
        Route::post('/update/role/permission/{id}', 'AdminUpdateRolePermission')->name('update.rolepermission');
        Route::get('/delete/role/permission/{id}', 'AdminDeleteRolePermission')->name('delete.rolepermission');
    });








    // all Admin Orders Routes
    Route::controller(adminController::class)->group(function () {
        Route::get('/all/admin', 'AllAdmin')->name('all.admins');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
    });

    // all Admin Orders Routes
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/users', 'AllUser')->name('all.user');
        Route::get('/all/instructor', 'AllInstructor')->name('all.instructor');

    });






}); //End Admin Routes








Route::get('/admin/login', [adminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/become/instructor', [adminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/become/register', [adminController::class, 'StoreInstructor'])->name('store.instructor');


// Instructor Dashboard
Route::middleware(['auth', 'verified', 'instructor'])->group(function () {
    Route::get('/instructor/dashboard', [instructorController::class, 'InstructorDashboard'])->name('instructor');

    Route::get('/instructor/profile', [instructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::get('/instructor/profile/instructorChangePassword', [instructorController::class, 'InstructorChangePassword'])->name('instructor.profile.ChangePassword');
    Route::post('/instructor/profile/passwordUpdate', [instructorController::class, 'instructorPasswordUpdate'])->name('instructor.password.update');

    Route::get('/instructor/logout', [instructorController::class, 'InstructorlogOut'])->name('instructor.logout');
    Route::post('/instructor/profile/store', [instructorController::class, 'Store'])->name('instructor.profile.store');

    //Course all Routes
    Route::controller(CourseController::class)->group(function () {
        Route::get('/all/courses', 'AllCourse')->name('all.courses');
        Route::get('/add/course', 'AddCourse')->name('add.course');
        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
        Route::post('/add/course', 'StoreCourse')->name('store.course');
        Route::post('/update/course/image', 'UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video', 'UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal', 'UpdateCourseGoal')->name('update.course.goal');
        Route::get('/edit/course/{course}', 'EditCourse')->name('edit.course');
        Route::post('/update/course', 'UpdateCourse')->name('update.course');
        Route::get('/delete/course/{id}', 'Destory')->name('delete.course');
    });

    //Course Section and Lectures  all Routes
    Route::controller(CourseController::class)->group(function () {
        Route::get('/add/course/lecture/{id}', 'AddCourseLecture')->name('add.course.lecture');
        Route::post('/add/course/section', 'AddCourseSection')->name('add.course.section');
        Route::post('/save-lecture', 'SaveLecture');
        Route::get('/edit/lecture/{id}', 'EditLecture')->name('edit.lecture');
        Route::post('/add/course/lecture', 'UpdateourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}', 'DeleteLecture')->name('delete.lecture');
        // Delete Section
        Route::post('/delete/section/{id}', 'DeleteSection')->name('delete.section');

        Route::get('/all/courses', 'AllCourse')->name('all.courses');
        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
        Route::post('/add/course', 'StoreCourse')->name('store.course');
        Route::post('/update/course/image', 'UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video', 'UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal', 'UpdateCourseGoal')->name('update.course.goal');
        Route::get('/edit/course/{course}', 'EditCourse')->name('edit.course');
        Route::post('/update/course', 'UpdateCourse')->name('update.course');
        Route::get('/delete/course/{id}', 'Destory')->name('delete.course');
    });

    // Orders all Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/instructor/pending/orders', 'InstructorPendingOrders')->name('instructor.pending.order');
        Route::get('/instructor/order/details/{payment}', 'InstructorOrderDetails')->name('instructor.order.detail');
        Route::get('/instructor/order/pdf/{payment}', 'InstructorOrderInvoice')->name('instructor.order.invoice');
    });

}); // End of Instructor Dashboard

Route::get('/instructor/login', [instructorController::class, 'InstructorLogin'])->name('instructor.login');


// user or Student Dashboard
Route::middleware(['auth', 'user'])->group(function () {


});

// Route access for all 
Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails'])->name('course.details');
Route::get('/category/{id}/{slug}', [IndexController::class, 'CourseCategory']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'CourseSubCategory']);
Route::get('/instructor/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');
Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'addToWishList']);
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('/buy/this/course/{id}', [CartController::class, 'buyThisCourseNow']);
Route::get('/cart/data', [CartController::class, 'CartData']);
// get Data from mini cart
Route::get('/course/mini/cart', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/course/remove/{id}', [CartController::class, 'RemoveMiniCart']);
// Cart all Route
Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/get-cart-course', 'GetCartCourse');
    Route::get('/removeCart/{id}', 'RemoveCart');
});
// Coupon Apply
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout All Related Routes
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::post('/payment', [CartController::class, 'Payment'])->name('payment');