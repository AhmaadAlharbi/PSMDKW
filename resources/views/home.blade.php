@extends('layouts.master')
@section('title')
لوحة التحكم
@stop

@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">لوحة تحكم إدارة مهمات قسم الوقاية</h2>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<a class="btn btn btn-warning btn-lg" href="{{route('blogs.blogs')}}">صفحة التقارير</a>
<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{ url('/' . $page='All_tasks') }}">عرض كافة
                            المهمات</a>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::count()}}


                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 text-white"><a class="text-white"
                            href="{{ url('/' . $page='task_uncompleted') }}">المهمات الغير
                            منجزة</a></h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','pending')->count()}}
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات غير منجزة</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white tx-16 op-7">
                                @if(\App\Models\Task::count()!==0){
                                {{round((\App\Models\Task::where('status','pending')->count()/\App\Models\Task::count())*100)}}%

                                }
                                @endif

                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{ url('/' . $page='task_completed') }}">المهمات
                            المنجزة</a> </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','completed')->count()}}
                            </h4>
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات منجزة</p>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white tx-18 op-7">
                                @if(\App\Models\Task::count()!==0){
                                {{round((\App\Models\Task::where('status','completed')->count()/\App\Models\Task::count())*100)}}%
                                @endif
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>

</div>
<!-- row closed -->


<!-- row closed -->

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-6 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header pb-1">
                <h3 class="card-title mb-2">آخر المهمات</h3>
                <p class="tx-12 mb-0 text-muted"></p>
            </div>
            @foreach($tasks as $task)
            <div class="card-body p-0 customers mt-1">
                <div class="list-group list-lg-group list-group-flush">
                    <div class="list-group-item list-group-item-action" href="#">
                        <div class="media mt-0">
                            <img class="avatar-lg rounded-circle ml-3 my-auto" src="image/electricIcon.svg"
                                alt="Image description">
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <div class="mt-0">
                                        <h5 class="mb-1 tx-15"><a
                                                href="/taskDetails/{{$task->id}}">{{$task->eng_name}}</a></a>
                                        </h5>
                                        <p class="mb-0 tx-13 text-muted">ssname: {{$task->ssname}}
                                            @if($task->status == 'pending')

                                            <span class="text-danger ml-2">
                                                {{$task->status}}</span>

                                            @else
                                            <span class="text-success ml-2">
                                                {{$task->status}}</span>
                                            @endif
                                        </p>
                                        <!-- <a href="" class=" m-2 btn btn-outline-light btn-sm">Reminder</a> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-xl-6 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header pb-1">
                <h3 class="card-title mb-2"> آخر التقارير</h3>

            </div>
            @foreach($task_details as $task_detail)
            <div class="product-timeline card-body pt-2 mt-1">
                <ul class="timeline-1 mb-0">
                    <li class="mt-0 mb-0"> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                        <span class="font-weight-semibold mb-4 tx-14 "><a
                                href="/Print_task/{{$task_detail->id_task}}">{{$task_detail->eng_name}}</a></span>
                        <p class="mb-0 text-muted tx-12">{{$task_detail->ssname}}</p>
                        <a href="#" class="float-right tx-11 text-success">{{$task_detail->status}}</a>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>

</div>
<!-- row close -->

<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection