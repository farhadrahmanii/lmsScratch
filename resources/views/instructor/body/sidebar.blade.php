@php
    $id = Auth::user()->id;
    $instructor = App\Models\User::findOrFail($id);
    $status = $instructor->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('instructor')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if ($status === '1')


            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Application</div>
                </a>
                <ul>
                    <li> <a href="app-emailbox.html"><i class='bx bx-radio-circle'></i>Email</a>
                    </li>

                </ul>
            </li>
            <li class="menu-label">Manage Courses</li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Courses</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('all.courses') }}"><i class='bx bx-radio-circle'></i>All Courses</a>
                    </li>
                    <li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Product
                            Details</a>
                    </li>
                    <li> <a href="ecommerce-add-new-products.html"><i class='bx bx-radio-circle'></i>Add New
                            Products</a>
                    </li>
                    <li> <a href="ecommerce-orders.html"><i class='bx bx-radio-circle'></i>Orders</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Orders</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('instructor.pending.order') }}"><i class='bx bx-radio-circle'></i>Pending
                            Orders</a>
                    </li>
                    <li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Confirmed Orders</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Components</div>
                </a>
                <ul>
                    <li> <a href="component-alerts.html"><i class='bx bx-radio-circle'></i>Alerts</a>
                    </li>

                </ul>
            </li>







            <li class="menu-label">Charts & Maps</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-line-chart"></i>
                    </div>
                    <div class="menu-title">Charts</div>
                </a>
                <ul>
                    <li> <a href="charts-apex-chart.html"><i class='bx bx-radio-circle'></i>Apex</a>
                    </li>
                    <li> <a href="charts-chartjs.html"><i class='bx bx-radio-circle'></i>Chartjs</a>
                    </li>
                    <li> <a href="charts-highcharts.html"><i class='bx bx-radio-circle'></i>Highcharts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-map-alt"></i>
                    </div>
                    <div class="menu-title">Maps</div>
                </a>
                <ul>
                    <li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
                    </li>
                    <li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a>
                    </li>
                </ul>
            </li>
        @else

        @endif
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>