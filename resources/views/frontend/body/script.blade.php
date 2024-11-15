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