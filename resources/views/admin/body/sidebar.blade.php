<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
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
        <li class="menu-label">Courses</li>

        @if (Auth::user()->can('category.menu'))

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage Category</div>
                </a>
                <ul>
                    <li> <a href="{{route('all.category')}}"><i class='bx bx-radio-circle'></i>All Category</a>
                    <li> <a href="{{route('all.subcategory')}}"><i class='bx bx-radio-circle'></i>Sub Category</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('Print Data'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Manage Instructor</div>
                </a>
                <ul>
                    <li> <a href="{{route('all.instructor')}}"><i class='bx bx-radio-circle'></i>All instructor</a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Courses</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.all.course')}}"><i class='bx bx-radio-circle'></i>All instructor</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Active User</div>
            </a>
            <ul>
                <li> <a href="{{route('all.user')}}"><i class='bx bx-radio-circle'></i>All Users</a>
                </li>
                <li> <a href="{{route('all.instructor')}}"><i class='bx bx-radio-circle'></i>All Instructor</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Coupons</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.all.coupon')}}"><i class='bx bx-radio-circle'></i>All Coupons</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage SMTP</div>
            </a>
            <ul>
                <li> <a href="{{route('smtp.setting')}}"><i class='bx bx-radio-circle'></i>SMTP Setting</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.pending.order')}}"><i class='bx bx-radio-circle'></i>Pending Orders</a>
                </li>
                <li> <a href="{{route('admin-confirm-order-list')}}"><i class='bx bx-radio-circle'></i>Confirm
                        Orders</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Role And Permission</div>
            </a>
            <ul>
                <li> <a href="{{route('all.permission')}}"><i class='bx bx-radio-circle'></i>All Permission</a>
                </li>
                <li> <a href="{{route('all.roles')}}"><i class='bx bx-radio-circle'></i>All Roles</a>
                </li>
                <li> <a href="{{route('all.roles.permission')}}"><i class='bx bx-radio-circle'></i>All Roles In
                        Permission</a>
                </li>
                <li> <a href="{{route('add.roles.permission')}}"><i class='bx bx-radio-circle'></i>Roles In
                        Permission</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manager Admin</div>
            </a>
            <ul>
                <li> <a href="{{route('all.admins')}}"><i class='bx bx-radio-circle'></i>All Admins</a>
                </li>
            </ul>
        </li>
        @if (Auth::user()->can('Print Data'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Print</div>
                </a>
                <ul>
                    <li> <a href="{{route('all.admins')}}"><i class='bx bx-radio-circle'></i>Print</a>
                    </li>
                </ul>
            </li>
        @endif





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