<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <img class="m-2 p-2" src="{{URL::asset('image/logo.png')}}" alt="logo">
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @if(Auth::user()->userImage )
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{URL::asset('image/userImage/'.Auth::user()->userImage)}}"><span
                        class="avatar-status profile-status bg-green"></span>

                    @else
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('image/user.svg')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                    @endif
                </div>

                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
                    <span class="mb-0 text-muted">{{Auth::user()->email}}</span>
                    <a class="btn btn-outline-success p-3 d-block"
                        href="{{route('blogs.blogs')}}">{{Auth::user()->name}}
                        page</a>

                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">قسم الوقاية</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . $page='home') }}"><svg xmlns="http://www.w3.org/2000/svg"
                        class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                    </svg><span class="side-menu__label">الرئيسية</span></a>
            </li>
            <li class="side-item side-item-category">متابعة الأعطال</li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                        <path
                            d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                    </svg><span class="side-menu__label">متابعة الأعطال</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='sendtask') }}">إصدار أمر العمل </a></li>
                    <li><a class="slide-item bg-info text-light" href="{{route('toBeAssigned')}}">task To Be
                            Assigned</a>

                    <li><a class="slide-item" href="{{ url('/' . $page='All_tasks') }}">  كافة المهمات </a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='task_completed') }}"> التقارير المنجزة</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='task_uncompleted') }}">التقارير الغير منجزة</a>

                        {{-- <li><a class="slide-item bg-warning text-dark" href="{{route('tasks.nightshift')}}">تعبئة
                        تقارير الخفارة</a>--}}
                    </li>
                </ul>
            </li>
            <li class="side-item side-item-category">المهندسين / الفنيين</li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                        <path
                            d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                    </svg><span class="side-menu__label">متابعة الموظفين</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{route('engineer.list')}}"> جدول المهندسين / اضافة مهندس</a></li>

            </li>
        </ul>
        </li>

        <li class="side-item side-item-category">المحطات</li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='') }}"><svg
                    xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                    <path
                        d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                </svg><span class="side-menu__label">المحطات</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{route('station.list')}}"> جدول المحطات / اضافة محطة</a></li>
        </li>
        </ul>
        </li>




        </ul>
    </div>
</aside>
<!-- main-sidebar -->