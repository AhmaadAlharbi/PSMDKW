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
    <div class="row">
        <h2>التقارير</h2>
        <!-- Blog entries-->
        <div class="col-lg-12">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">

                @foreach($blogs as $blog)

                <div class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="small text-muted">Date: {{$blog->report_date}}</div>
                            <h6 class="card-title  ">Station :{{$blog->ssname}}</h6>
                            <h6 class="card-title">Engineer : {{$blog->eng_name}}</h6>
                            <p class="card-text text-danger">Nature of fault : {{$blog->problem}}</p>
                            <p class="card-text text-success">Action take: {{$blog->action_take}} {{$blog->reason}}
                            </p>
                            <a class="btn btn-primary" href="{{route('blogs.details',['id'=>$blog->id_task])}}">Read
                                more →</a>
                        </div>
                    </div>
                </div>
                @endforeach



                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        {{ $blogs->links() }}
                    </ul>
                </nav>
            </div>


        </div>
    </div>
    @include('blogs.BlogsFooter')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('js/scripts.js')}}"></script>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="">Select an Engineer's name:-</label>
                        <input list="engineers" name="engineer" id="engineer" onchange="getEngineerName()">
                        <input type="hidden" id="hiddenName">
                        <datalist id="engineers">
                            @foreach($engineers as $engineer)
                            <option value="{{$engineer->name}}">

                                @endforeach
                        </datalist>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="name-link" class="btn btn-primary" href=''>search</a>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <!-- Modal2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="">Select an S/S name:-</label>
                        <input list="stations" name="station" id="station" onchange="getStationName()">
                        <input type="hidden" id="hiddenStation">
                        <datalist id="stations">
                            @foreach($stations as $station)
                            <option value="{{$station->SSNAME}}">

                                @endforeach
                        </datalist>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="station-link" class="btn btn-primary" href=''>search</a>
                </div>
            </div>
        </div>
    </div>
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