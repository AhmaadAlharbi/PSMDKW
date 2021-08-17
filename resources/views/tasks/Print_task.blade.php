@extends('layouts.master')
@section('css')
<style>
    .mew-logo {
        width: 250px;
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
<div class="row row-sm" id="print">
    <div class="col-md-12 col-xl-12">
        <div class=" main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">

                        <div class="billed-from">
                            <img class=" rounded float-right" src="https://www.mew.gov.kw/images/logo2@2x.png" alt="mew logo">
                        </div><!-- billed-from -->

                        <div class="billed-from">
                            <img class="mew-logo rounded float-right" src="https://www.mew.gov.kw/images/logo@2x.png" alt="mew logo">
                        </div><!-- billed-from -->
                    </div><!-- invoice-header -->


                    <div class="container">
                        <h2 class="text-center mb-5">إدارة صيانة محطات التحويل الرئيسية</h2>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-hover table-invoice table-striped table-border text-md-nowrap mb-0">
                                <tr>
                                    <th class="border-bottom-0">تاريخ ارسال التقرير</th>
                                    <td colspan="4">{{$task_details->report_date}}</td>
                                </tr>
                                <tr>
                                    <th class="border-bottom-0">رقم المهمة</th>
                                    <td colspan="4">{{$task_details->refNum}}</td>

                                </tr>

                                <tr>
                                    <th class="border-bottom-0">اسم المحطة </th>
                                    <td colspan="4">{{$task_details->ssname}}</td>
                                </tr>

                                <tr>
                                    <th class="border-bottom-0">Main Alarm</th>
                                    <td colspan="4">{{$task->main_alarm}}</td>

                                </tr>
                                <tr>
                                    <th class="border-bottom-0">Voltage Level OR capacity </th>
                                    <td colspan="4">{{$task->Voltage_level}}</td>
                                </tr>
                                <tr>
                                    <th class="border-bottom-0">Work Type</th>
                                    <td colspan="4">{{$task->Work_type}}</td>

                                </tr>
                                <tr>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <td colspan="4">{{$task->notes}}</td>

                                </tr>
                                <tr>
                                    <th class="border-bottom-0">Equip./Unit Affected </th>
                                    <td colspan="4">{{$task_details->equip}}</td>


                                </tr>
                                <tr>
                                    <th class="border-bottom-0">Nature of Fault</th>
                                    <td colspan="4">{{$task_details->problem}}</td>
                                </tr>

                                <tr>
                                    <th>إضافات</th>
                                    <td colspan="4">{{$task_details->add_more}}</td>
                                </tr>
                                <tr>
                                    <th class="border-bottom-0 wd-40p">المهندس</th>
                                    <td colspan="3">{{$task_details->eng_name}}</td>


                                </tr>

                            </table>
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