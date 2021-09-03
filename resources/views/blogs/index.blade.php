@extends('layoutsUser.master')
@section('title')
المهمات
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كل
                المهمات

            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
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
                        <li class="mt-0 mb-0"> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i>
                            <!-- <p class=" badge badge-success ">{{$task_detail->status}}</p> -->
                            <p class="text-right text-muted"> {{$task_detail->created_at}}</p>
                            <p class="  p-3 mb-2 bg-dark text-white text-cente">Engineer : {{$task_detail->eng_name}}</p>
                            <p class="  bg-white text-dark text-center  "><ins>Station : {{$task_detail->ssname}}</ins></p>
                            <p class=" bg-white text-secondary font-weight-bold text-center">Nature of fault : {{$task_detail->problem}}</p>
                            <p class="p-3 mb-2 bg-light text-dark text-center">Action Take : {{$task_detail->action_take}}</p>
                            <a class="btn btn-secondary mt-2 text-center" href="/Print_task/{{$task_detail->id_task}}">Read more</a>

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
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>