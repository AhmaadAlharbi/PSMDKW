@extends('layouts.master')
@section('css')
<style>
    .mew-logo {
        width: 250px;
    }

    .kuwait {
        visibility: hidden;
    }
</style>
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }
</style>
@endsection
@section('page-header')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                report</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="test row row-sm" id="print">
    <div class="col-md-12 col-xl-12">
        <div class=" main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">

                        <div class="billed-from">
                            <img class=" kuwait rounded " src="https://www.mew.gov.kw/images/logo2@2x.png" alt="mew logo">
                        </div><!-- billed-from -->

                        <div class="billed-from">
                            <img class="mew-logo rounded " src="https://www.mew.gov.kw/images/logo@2x.png" alt="mew logo">
                        </div><!-- billed-from -->
                    </div><!-- invoice-header -->


                    <div class="container">
                        <h2 class="text-center mb-5">Primary substation maintenance department</h2>
                        <div class="table-responsive mg-t-40 text-left">

                            <div table-responsive mg-t-40 text-left>
                                <h5 class="text-muted">Report Date</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task_details->report_date}}</p>
                                <h5 class="text-muted">Station</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task_details->ssname}}</p>
                                <h5 class="text-muted">Main Alarm</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task->main_alarm}}</p>
                                <h5 class="text-muted">Voltage Level OR capacity</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task->Voltage_level}}</p>
                                <h5 class="text-muted">Work Type</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task->Work_type}}</p>
                                <h5 class="text-muted">Equip./Unit Affected</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task_details->equip}}</p>
                                <h5 class="text-muted">Nature of Fault</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task_details->problem}}</p>
                                <h5 class="text-muted">Action Take</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task_details->action_take}}</p>
                                <h5 class="text-muted">Engineer</h5>
                                <p class="p-3 mb-2 bg-light text-dark">{{$task_details->eng_name}}</p>

                            </div>
                        </div>
                    </div>

                    <hr class=" mg-b-40">

                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i class="mdi mdi-printer ml-1"></i>طباعة</button>

                </div>
            </div>
        </div>
    </div><!-- COL-END -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endsection