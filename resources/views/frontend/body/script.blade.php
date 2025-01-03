<!-- Started WishList Script -->


<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    function addToWishList(course_id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/" + course_id,

            success: function (data) {
                // Start Message 

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message  
            }
        })
    }

</script>
<script>
    function wishlist() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-course",
            success: function (response) {
                $('#wishQty').text(response.wishQty);
                var rows = ""
                $.each(response.wishlist, function (key, value) {

                    rows += `
                    <div class="col-lg-4 responsive-column-half">
            <div class="card card-item">
                <div class="card-image">
                    <a href="/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block">
                        <img class="card-img-top" src="/${value.course.course_image}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Bestseller</div>
                ${value.course.bestseller == 1 ? `` : ``}
                        <div class="course-badge blue">-39%</div>
                    </div>
                </div><!-- end card-image -->
                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                    <h5 class="card-title"><a href="/course/details/${value.course.id}/${value.course.course_name_slug}">${value.course.course_name}</a></h5>
                    <div class="d-flex justify-content-between align-items-center">
                ${value.course.discount_price == null
                            ? `<p class="card-price text-black font-weight-bold">${value.course.selling_price}</p>`
                            : ` <p class="card-price text-black font-weight-bold">${value.course.discount_price} <span
                                class="before-price font-weight-medium">${value.course.selling_price}</span></p>`
                        }
                       
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-toggle="tooltip"
                            data-placement="top" id="${value.id}" onclick="wishlistRemove(this.id)" title="Remove from Wishlist"><i class="la la-heart"></i></div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-4 -->
`
                });
                $('#wishlist').html(rows);

            }

        })
    }
    wishlist()


    // Start wishlist Remove


    function wishlistRemove(id) {
        $.ajax({
            method: "GET",
            dataType: "json",
            url: "/wishlist-remove/" + id,
            success: function (data) {
                // Start Message 
                wishlist(); // Refresh the wishlist
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message  
            }
        })
    }

    // End wishlist Remove
</script>
<!-- End WishList Script -->

<!--  Start Add to Cart Process -->
<script>
    function addToCart(courseId, courseName, instrcutorId, slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                course_name: courseName,
                course_name_slug: slug,
                instructor: instrcutorId,
            },
            url: "/cart/data/store/" + courseId,
            success: function (data) {
                cart(); // Refresh the cart
                console.log("Success:", data);
                // Start Message 
                wishlist(); // Refresh the wishlist
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message 
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseJSON);
            }
        });
    }

</script>

<!--  Start Buy this course Process -->
<script>
    function buyThisCourse(courseId, courseName, instrcutorId, slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                course_name: courseName,
                course_name_slug: slug,
                instructor: instrcutorId,
            },
            url: "/buy/this/course/" + courseId,
            success: function (data) {
                cart(); // Refresh the cart
                console.log("Success:", data);
                // Start Message 
                wishlist(); // Refresh the wishlist
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                    window.location.href = '/checkout';

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message 
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseJSON);
            }
        });
    }

</script>
<!-- end Buy this course -->
<script>
    function cart() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/course/mini/cart",
            success: function (response) {
                $('span[id="cartSubTotal"]').text(response.cartTotal)
                $('#cartQty').text(response.cartQty)
                var rows = "";
                $.each(response.cart, function (key, value) {
                    rows += `<li class="media media-card">
                                <a href="shopping-cart.html" class="media-img">
                                    <img src="/${value.options.image}" alt="Cart image"></a>
                                <div class="media-body">
                                        <h5><a href="/course/details/${value.id}/${value.options.slug}">${value.name}</a></h5>
                                        <span class="py-1 d-block lh-18">Kamran Ahmed</span>
                                    <p class="text-black font-weight-semi-bold lh-18">$${value.price}</p>
                                 <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="la la-times"></i></a>
                                </div>
                            </li>`});
                $('#cart').html(rows);
            }

        })
    }

    cart()
    // Mini Cart Remove Start
    function miniCartRemove(rowId) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/minicart/course/remove/' + rowId,
            success: function (data) {
                cart(); // Refresh the cart
                // Start Message 
                wishlist(); // Refresh the wishlist
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message 
            }
        })
    }
    // End Mini Cart Remove Start
</script>
<script>
    function getCart() {
        $.ajax({
            type: 'GET',
            dataType: 'json', // Corrected data type declaration
            url: '/get-cart-course',
            success: function (response) {
                console.log("Response:", response); // Log the response for debugging
                $('#cartSubTotal').text(response.cartTotal);
                var rows = "";
                $.each(response.cart, function (key, value) {
                    rows += `<tr>
                    <th scope="row">
                        <div class="media media-card">
                            <a href="course-details.html" class="media-img mr-0">
                                <img src="/${value.options.image}" alt="Cart image">
                            </a>
                        </div>
                    </th>
                    <td>
                        <a href="/course/details/${value.id}/${value.options.slug}" class="text-black font-weight-semi-bold">${value.name}</a>
                    </td>
                    <td>
                        <ul class="generic-list-item font-weight-semi-bold">
                            <li class="text-black lh-18">$${value.price}</li>
                        </ul>
                    </td>
                    <td>
                        <button type="submit" id="${value.rowId}" onclick="CartRemove(this.id)" class="icon-element icon-element-xs shadow-sm border-0"
                            data-toggle="tooltip" data-placement="top" title="Remove Cart">
                            <i class="la la-times"></i>
                        </button>
                    </td>
                </tr>`;
                });
                $('#cartPage').html(rows);
            },
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText); // Log errors for debugging
            }
        });
    }
    getCart();
    function CartRemove(id) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/removeCart/' + id,
            success: function (data) {
                getCart(); // Refresh the cart
                cart()
                couponCalculation(); // Refresh the cart
                // Start Message
                wishlist(); // Refresh the wishlist
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message
            }
        })
    }
</script>
<!-- // End Add to Cart Process -->
<!-- ApplyCoupon -->
<script>
    function applyCoupon() {
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/coupon-apply",
            data: {
                coupon_name: coupon_name,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                couponCalculation()
                if (data.validaty == true) {
                    $('#CouponField').hide();
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }


    // Coupon Calculation
    function couponCalculation() {
        $.ajax({
            type: 'GET',
            url: "/coupon-calculation",
            dataType: 'json',

            success: function (data) {
                if (data.total) {
                    $('#couponCalField').html(`
                    <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Subtotal:</span><span > $${data.total}</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Total:</span><span >$${data.total} </span>
                    </li>
                </ul>`);
                } else {
                    $('#couponCalField').html(`
                    <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Subtotal:</span><span > $${data.subtotal}</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Coupon Name:</span><span > ${data.coupon_name} <button type="submit" onclick="CouponRemove(this.id)" class="icon-element icon-element-xs shadow-sm border-0" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove Cart">
                            <i class="la la-times"></i>
                        </button></span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Coupon Discount:</span><span >$${data.discount_amount} </span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Grand Total:</span><span >$${data.total_amount} </span>
                    </li>
                </ul>`)
                }
            }
        })
    }
    couponCalculation()
</script>
<script>
    function CouponRemove() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/coupon-remove',
            success: function (data) {
                couponCalculation(); // Refresh the cart
                $('#CouponField').show();
                cart()
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message
            }
        })
    }
</script>
<!-- End ApplyCoupon -->