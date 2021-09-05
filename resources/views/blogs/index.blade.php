@extends('layoutsUser.master')
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

@if (session()->has('delete_invoice'))
<script>
window.onload = function() {
    notif({
        msg: "تم حذف المهمة بنجاح",
        type: "success"
    })
}
</script>
@endif


@if (session()->has('Status_Update'))
<script>
window.onload = function() {
    notif({
        msg: "تم تحديث حالة الدفع بنجاح",
        type: "success"
    })
}
</script>
@endif
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white" href="{{ url('/' . $page='All_tasks') }}"> مهماتي
                        </a>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::whereMonth('created_at', date('m'))->count()}}


                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
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
                                @if(\App\Models\Task::count()!==0)
                                {{round((\App\Models\Task::where('status','pending')->count()/\App\Models\Task::count())*100)}}%

                                @endif

                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                <div class="">
                    <h6 class="mb-3 tx-16 "><a class="text-white"
                            href="{{ url('/' . $page='task_completed') }}"> تقاريري
                        </a> </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','completed')->whereMonth('created_at', date('m'))->count()}}
                            </h4>
                            </h4>
                            <p class="mb-0 tx-14 text-white op-7">مهمات منجزة</p>

                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white tx-18 op-7">
                                @if(\App\Models\Task::count()!==0)
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
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-16 text-white">
                        <a class="text-white" href="{{route('archive')}}">ارشيف التقارير</a>
                    </h6>
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{\App\Models\Task::where('status','completed')->count()}}
                            </h4>
                            <p class="mb-0 tx-12 text-white op-7">
                                تقرير
                            </p>
                        </div>
                        <!-- <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white op-7"> -152.3</span>
                        </span> -->
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>


    <div class="container">
        <div class="row row-sm">

            <div class="col-xl-12 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header pb-1">
                        <h3 class="card-title mb-2"> تقارير شهر {{$monthName}}</h3>

                    </div>
                    @foreach($task_details as $task_detail)
                    <div class="product-timeline card-body pt-2 mt-1 text-center">
                        <ul class="timeline-1 mb-0">
                            <li class="mt-0 mb-0"> <i
                                    class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                                <!-- <p class=" badge badge-success ">{{$task_detail->status}}</p> -->
                                <p class="text-right text-muted"> {{$task_detail->created_at}}</p>
                                <p class="  p-3 mb-2 bg-dark text-white text-cente">Engineer :
                                    {{$task_detail->eng_name}}
                                </p>
                                <p class="  bg-white text-dark text-center  "><ins>Station :
                                        {{$task_detail->ssname}}</ins>
                                </p>
                                <p class=" bg-white text-secondary font-weight-bold text-center">Nature of fault :
                                    {{$task_detail->problem}}</p>
                                <p class="p-3 mb-2 bg-light text-dark text-center">Action Take :
                                    {{$task_detail->action_take}}</p>
                                <a class="btn btn-secondary mt-2 text-center"
                                    href="/Print_task/{{$task_detail->id_task}}">Read more</a>

                            </li>
                        </ul>

                    </div>
                    <hr class="my-4   bg-secondary  ">
                    @endforeach
                    <ul class="pagination justify-content-center my-4">
                        {{$task_details->links()}}
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- row closed -->
    @include('blogs.BlogsFooter')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('js/scripts.js')}}"></script>


    @endsection
    <script>
    const engineer = document.getElementById('engineer');
    const station = document.getElementById('station');
    const engineerHidden = document.getElementById('hiddenName');
    const stationHidden = document.getElementById('hiddenStation');
    const link = document.getElementById('name-link');
    const stationLink = document.getElementById('station-link');
    let engineerValue = engineer;

    const getEngineerName = () => {
        engineerHidden.value = engineer.value
        let url = '{{route("blogs.searchByEngineer",":id")}}'
        url = url.replace(':id', engineerHidden.value);
        link.setAttribute('href', url);
    }
    const getStationName = () => {
        stationHidden.value = station.value
        let url = '{{route("blogs.searchByStation",":id")}}'
        url = url.replace(':id', stationHidden.value);
        stationLink.setAttribute('href', url);
    }
    </script>
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