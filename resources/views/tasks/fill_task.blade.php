@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
تعديل فاتورة
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تعديل فاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="/TaskCompleted/{{$tasks->id}}" enctype="multipart/form-data" method="post"
                    autocomplete="off">
                    @csrf
                    {{-- 1 --}}

                    <div class=" row">
                        <div class="col">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" class="form-control" id="inputName" name="refNum" readonly
                                value="{{$tasks->refNum}}">
                        </div>
                        <div class="col">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input class="form-control" readonly name="ssname" id="ssname" value="{{$tasks->ssname}}">

                        </div>
                        <div class="col">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ $tasks->task_Date}}" readonly required>
                        </div>



                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="equip"> Equip./Unit Affected</label>
                            <input list="equips" class="form-control" readonly name="equip" id="equip"
                                value="{{$tasks->equip}}">

                        </div>

                        <div class="col">
                            <label for="problem"> Nature of Fault</label>
                            <input list="problems" class="form-control" readonly value="{{$tasks->problem}}"
                                name="problem" id="problem">
                        </div>

                        <div class="col">
                            <label>تاريخ كتابة التقرير</label>
                            <input class="form-control fc-datepicker" name="report_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ date('Y-m-d') }}" readonly required>
                        </div>
                    </div>

                    {{-- 3 --}}

                    <div class="row">
                        <div class="col mt-2">
                            <label for="eng_name">اسم المهندس</label>
                            <input type="text" class="form-control" name="eng_name" readonly
                                value="{{$tasks->eng_name}}">
                        </div>
                    </div>





                    {{-- 6 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="notes" readonly
                                rows="3">{{$tasks->notes}}</textarea>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Action Take</label>
                            <textarea class="form-control" id="exampleTextarea" name="action_take" rows="3"></textarea>
                        </div>
                        <!-- Button trigger modal -->

                    </div>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                        لم يتم الإنجاز؟
                    </button>
                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">المرفقات</h5>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> سبب عدم الإنجاز </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="/fill_pending_task/{{$tasks->id}}" method="post">
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1"> اختر السبب</label>
                    <select name="reason" class="form-control" id="exampleFormControlSelect1">
                        <option value="مسؤولية جهة آخرى">مسؤولية جهة آخرى</option>
                        <option value="تحت الكفالة">تحت الكفالة</option>
                        <option value="قطع غيار غير متوفرة "> قطع غيار غير متوفرة </option>
                        <option value="بإنتظار إصلاحات"> بإنتظار إصلاحات</option>
                        <option value="تحويل المهمة لمهندس آخر">تحويل المهمة لمهندس آخر </option>
                        <option value="آخرى"> آخرى</option>
                    </select>
                    <!--Take all these hidden value to the form-->
                    <input type="hidden" class="form-control" id="inputName" name="refNum" value="{{$tasks->refNum}}"
                        readonly>
                    <input type="hidden" class="form-control" readonly name="ssname" id="ssname"
                        value="{{$tasks->ssname}}">
                    <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD" type="hidden"
                        value="{{ $tasks->task_Date}}" readonly required>
                    <input type="hidden" class="form-control" readonly name="equip" id="equip"
                        value="{{$tasks->equip}}">
                    <input type="hidden" class="form-control" readonly value="{{$tasks->problem}}" name="problem"
                        id="problem">
                    <input class="form-control fc-datepicker" name="report_Date" placeholder="YYYY-MM-DD" type="hidden"
                        value="{{ date('Y-m-d') }}" readonly required>
                    <input type="hidden" class="form-control" name="eng_name" readonly value="{{$tasks->eng_name}}">
                    <textarea type="hidden" style="display:none;" class="form-control" id="exampleTextarea" name="notes"
                        readonly rows="3">{{$tasks->notes}}</textarea>
                    <!--END Taking all these hidden value to the form-->

                    <label for="exampleTextarea">ملاحظات</label>
                    <textarea class="form-control" id="exampleTextarea" name="add_more" rows="3"></textarea>
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>

        </div>

        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
var date = $('.fc-datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
}).val();
</script>

<script>
$(document).ready(function() {
    $('select[name="Section"]').on('change', function() {
        var SectionId = $(this).val();
        if (SectionId) {
            $.ajax({
                url: "{{ URL::to('section') }}/" + SectionId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="product"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="product"]').append('<option value="' +
                            value + '">' + value + '</option>');
                    });
                },
            });
        } else {
            console.log('AJAX load did not work');
        }
    });
});
</script>


<script>
function myFunction() {
    var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
    var Discount = parseFloat(document.getElementById("Discount").value);
    var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
    var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
    var Amount_Commission2 = Amount_Commission - Discount;
    if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
        alert('يرجي ادخال مبلغ العمولة ');
    } else {
        var intResults = Amount_Commission2 * Rate_VAT / 100;
        var intResults2 = parseFloat(intResults + Amount_Commission2);
        sumq = parseFloat(intResults).toFixed(2);
        sumt = parseFloat(intResults2).toFixed(2);
        document.getElementById("Value_VAT").value = sumq;
        document.getElementById("Total").value = sumt;
    }
}
</script>


@endsection