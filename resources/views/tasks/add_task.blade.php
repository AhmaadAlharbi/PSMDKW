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
اضافة مهمة
@stop
<style>
.email {
    visibility: hidden;
}

.visible {
    visibility: visible;
}

.visible {
    visibility: hidden;
}

/** LOADING */

.loader {
    color: #ffb300;
    font-size: 90px;
    text-indent: -9999em;
    overflow: hidden;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    margin: 72px auto;
    position: relative;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
    animation: load6 1.7s infinite ease, round 1.7s infinite ease;
}

@-webkit-keyframes load6 {
    0% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    5%,
    95% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    10%,
    59% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
    }

    20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
    }

    38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
    }

    100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }
}

@keyframes load6 {
    0% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    5%,
    95% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }

    10%,
    59% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
    }

    20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
    }

    38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
    }

    100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
    }
}

@-webkit-keyframes round {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes round {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
</style>
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                اضافة مهمة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

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
        <div class="card border border-primary">
            <div class="card-body">
                <form action="{{route('task.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" class="refNum form-control" id="inputName" name="refNum" title=""
                                required value="{{ date('y-m') }}/" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input list="ssnames" class="form-control" name="ssname" id="ssname"
                                onchange="getStationFullName()">

                            <datalist id="ssnames">
                                @foreach($stations as $station)
                                <option value="{{$station->SSNAME}}">
                                    @endforeach
                            </datalist>
                            <input id="staion_full_name" name="staion_full_name"
                                class="text-center d-none p-3 form-control" readonly>
                            <input id="control_name" name="control_name" class="text-center d-none  p-3 form-control"
                                readonly>
                        </div>
                        <input type="hidden" id="color" name="color">

                        <div class=" col-lg-4">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="" class="control-label">Make</label>
                            <input type="text" class="form-control" name="make">
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="control-label">Last P.M</label>
                            <input type="text" class="form-control" name="pm">
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="main-alarm" class="control-label m-3">Main Alarm</label>
                            <select name="main_alarm" id="main_alarm" class="form-control">
                                <!--placeholder-->
                                <option value="">Select an alarm</option>
                                <option value="Auto reclosure">Auto reclosure</option>
                                <option value="Auto reclosure">Flag Relay Replacement </option>
                                <option value="Protection Clearance feeder">Protection Clearance feeder</option>
                                <option value="Transformer Clearance">Transformer Clearance</option>
                                <option value="Dist Prot Main Alaram">Dist Prot Main Alaram</option>
                                <option value="Dist.Prot.Main B Alarm">Dist.Prot.Main B Alarm</option>
                                <option value="Pilot Cable Fault Alarm">Pilot Cable Fault Alarm</option>
                                <option value="Pilot cable Superv.Supply Fail Alarm">Pilot cable Superv.Supply Fail
                                    Alarm</option>
                                <option value="Transformer out of step Alarm">Transformer out of step Alarm</option>
                                <option value="DC Supply 1 & 2 Fail Alarm">DC Supply 1 & 2 Fail Alarm</option>
                                <option value="Communication Fail Alarm">Communication Fail Alarm</option>
                                <option value="General Alarm 300KV">General Alarm 300KV</option>
                                <option value="General Alarm 132KV">General Alarm 132KV</option>
                                <option value="General Alarm 33KV">General Alarm 33KV</option>
                                <option value="General Alarm 11KV">General Alarm 11KV</option>
                                <option value="B/Bar Protection Fail Alarm">B/Bar Protection Fail Alarm</option>
                                <option value="Shunt Reactor Restricted Earth Earth Fault Realy">Shunt Reactor
                                    Restricted Earth Earth Fault Realy</option>
                                <option value="Shunt Reactor Over Current">Shunt Reactor Over Current</option>
                                <option value="Shunt Reactor Clearance">Shunt Reactor Clearance</option>

                                <option value="Shunt Reactor Earth Fault">Shunt Reactor Earth Fault</option>
                                <option value="Breaker Open / close undefined">Breaker Open / close undefined
                                </option>
                                <option value="B/Bar Isolator open / close D.S">B/Bar Isolator open / close D.S
                                </option>
                                <option value="B/Bar Isolator open / close D.S">Line Isolator Open / close D.S
                                </option>
                                <option value="other">other</option>
                            </select>
                            <input id="other_alarm" name="main_alarm" placeholder="write other main alarm" type="text"
                                class=" invisible form-control" onfocus=this.value=''>
                        </div>
                        <div class="col-lg-6">
                            <label id="voltage" for="Voltage-Level" class=" control-label m-3">Voltage Level</label>
                            <select name="Voltage_Level" id="voltageLevel" class="form-control">
                                <!--placeholder-->
                                <optgroup>
                                    <option value="400KV">400KV</option>
                                    <option value="300KV">300KV</option>
                                    <option value="132KV">132KV</option>
                                    <option value="33KV">33KV</option>
                                    <option value="11KV">11KV</option>
                                </optgroup>
                                <optgroup label="General Check">
                                    <option value="132/11KV">132/11KV</option>
                                    <option value="33/11KV">33/11KV</option>
                                    <option value="400/132/11KV">400/132/11KV</option>
                                    <option value="300/132/11KV">300/132/11KV</option>
                                </optgroup>

                            </select>
                            <select id="transformerVoltage" class="d-none form-control">
                                <!--placeholder-->
                                <option value="750MVA">750MVA</option>
                                <option value="300MVA">300MVA</option>
                                <option value="75MVA">75MVA</option>
                                <option value="45MVA">45MVA</option>
                                <option value="30MVA">30MVA</option>
                                <option value="20MVA">20MVA</option>
                                <option value="15MVA">15MVA</option>
                                <option value="10MVA">10MVA</option>
                                <option value="7.5MVA">7.5MVA</option>
                                <option value="5MVA">5MVA</option>

                            </select>
                            <select id="shuntVoltage" class="d-none form-control">
                                <!--placeholder-->
                                <option value="250MVAR">250MVAR</option>
                                <option value="125MVAR">125MVAR</option>
                                <option value="50MVAR">50MVAR</option>
                                <option value="45MVAR">45MVAR</option>
                                <option value="30MVAR">30MVAR</option>
                            </select>
                            <select id="dist" class="d-none form-control">
                                <!--placeholder-->
                                <option value=""></option>
                                <option value="400KV">400KV</option>
                                <option value="300KV">300KV</option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3">

                        <div class="col-lg-6">
                            <label for="equip" class="control-label m-1">Bay Unit</label>
                            <input id="equip" type="text" name="equip" class="form-control SlectBox">
                        </div>

                        <div class="col-lg-6">
                            <label for="problem" class="control-label m-1"> Nature of Fault</label>
                            <input list="problems" class="form-control" name="problem" id="problem">

                            <datalist id="problems">

                            </datalist>
                        </div>
                    </div>




                    {{-- 2 --}}
                    <div class="row m-3">
                        <div class="col border border-warning p-3 flex-wrap">
                            <h6 class="text-warning">Work Type</h6>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="work_type" id="inlineRadio1"
                                    value="Inspection">
                                <label class="form-check-label  m-2" for="inlineRadio1">Inspection</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="work_type" id="inlineRadio2"
                                    value="Maintenance">
                                <label class="form-check-label m-2" for="inlineRadio2">Maintenance</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="work_type" id="inlineRadio3"
                                    value="Troubleshooting">
                                <label class="form-check-label m-2" for="inlineRadio3">Troubleshooting</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="work_type" id="inlineRadio4"
                                    value="outage">
                                <label class="form-check-label m-2" for="inlineRadio4">outage</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="work_type" id="inlineRadio5"
                                    value="Installation">
                                <label class="form-check-label m-2" for="inlineRadio5">Installation</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="work_type" id="inlineRadio6"
                                    value="Other">
                                <label class="form-check-label m-2" for="inlineRadio6">other</label>
                            </div>
                        </div>
                    </div>

                    {{-- 3 --}}

                    <div class="row m-3">
                        <div class="col-lg-3">
                            <label for="inputName" class="control-label">area</label>
                            <select name="area" id="areaSelect" class="form-control areaSelect"
                                onchange="getEngineer()">
                                <!--placeholder-->
                                <!-- <option value="1"> المنطقة الشمالية</option>
                                <option value="2"> المنطقة الجنوبية</option> -->

                            </select>
                        </div>

                        <div class="col-lg-3">
                            <label for="inputName" class="control-label">shif</label>
                            <select name="shift" id="shiftSelect" class="form-control SlectBox"
                                onchange="shiftEngineer()">
                                <!--placeholder-->
                                <option value="1"> صباحاً </option>
                                <option value="2"> مساءً </option>
                            </select>

                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">اسم المهندس</label>
                            <select id="eng_name" name="eng_name" class="form-control engineerSelect"
                                onchange="getEmail()">
                            </select>
                        </div>
                        <div class="col email">
                            <label for="inputName" class="control-label"> Email</label>
                            <select id="eng_name_email" readonly name="eng_name_email" class="form-control">
                            </select>
                        </div>

                    </div>



                    {{-- 6 --}}
                    <div class="row m-3">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="notes" rows="3"></textarea>
                        </div>
                    </div><br>

                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                    <h5 class="card-title">المرفقات</h5>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />
                    </div><br>

                    <div class="col-sm-12 col-md-12">
                        <input type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                            data-height="70" />

                    </div><br>
                     <div class="text-center mb-3">
                        <button id="showAttachment" class="btn btn-outline-info">اضغط لإضافة المزيد من
                            المرفقات</button>
                        <button id="hideAttachment" class="btn d-none btn-outline-info">اضغط  لإخفاء المزيد من
                            المرفقات</button>

                    </div>
                    <div id="attachmentFile" class="d-none">
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>
                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic[]" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">ارسال البيانات</button>
                    </div>




                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>

</div>
<!-- Loading Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">جاري إرسال الإيميل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center mt-2 text-warning">Loading...Please wait</h5>
                <div class="loader">

                </div>
            </div>

        </div>
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
const areaSelect = document.getElementById('areaSelect');
const engineerSelect = document.querySelector(".engineerSelect");
const eng_name_email = document.getElementById('eng_name_email');
const shiftSelect = document.getElementById('shiftSelect');
const engineerId = engineerSelect.value;
const voltage = document.getElementById('voltage'); //voltage label
//to get Engineer names
const getEngineer = async () => {
    //to reset the  select value
    engineerSelect.options.length = 0;
    eng_name_email.options.length = 0;
    let areaId = areaSelect.value;
    let shiftId = shiftSelect.value;
    const response = await fetch("{{ URL::to('engineersArea') }}/" + areaId + "/" + shiftId);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        let areaSelectValue = document.createElement('option');
        let engineerSelectValue = document.createElement('option');
        areaSelectValue.value = data[i].name;
        areaSelectValue.innerHTML = data[i].name;
        engineerSelectValue.value = data[i].email;
        engineerSelectValue.innerHTML = data[i].email;
        engineerSelect.appendChild(areaSelectValue);
        eng_name_email.appendChild(engineerSelectValue);
        // console.log(data[i].id, data[i].name)

    }

    return data;
}

//to get the engineer based on shift
const shiftEngineer = async () => {
    engineerSelect.options.length = 0;
    eng_name_email.options.length = 0;
    let areaId = areaSelect.value;
    let shiftId = shiftSelect.value;
    const response = await fetch("{{ URL::to('engineersShift') }}/" + areaId + "/" + shiftId)
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    for (let i = 0; i < data.length; i++) {
        let shiftSelectValue = document.createElement('option');
        let engineerSelectValue = document.createElement('option');
        shiftSelectValue.value = data[i].name;
        shiftSelectValue.innerHTML = data[i].name;
        engineerSelectValue.value = data[i].email;
        engineerSelectValue.innerHTML = data[i].email;
        engineerSelect.appendChild(shiftSelectValue);
        eng_name_email.appendChild(engineerSelectValue);
    }
    return data;

}
</script>
<script>
//get Email based on engieer selected
const getEmail = async () => {
    let engineerId = engineerSelect.value;
    const response = await fetch("{{ URL::to('engineersEmail') }}/" + engineerId);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    // let engineerEmailValue = 
    eng_name_email.value = data[0].email;
    return data;
}

//get station full name
const ssname = document.getElementById('ssname');
const staion_full_name = document.getElementById('staion_full_name');
const color = document.getElementById('color');
const control_name = document.getElementById('control_name');
const getStationFullName = async () => {
    let staionId = ssname.value
    const response = await fetch("{{ URL::to('stationFullName') }}/" + staionId);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    staion_full_name.classList.remove('d-none')
    staion_full_name.value = data.fullName;
    control_name.classList.remove('d-none')

    control_name.value = data.control;
    if (data.control === 'SHUAIBA CONTROL CENTER') {
        control_name.classList.remove('bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-white',
            'text-light', 'text-dark');
        control_name.classList.add('bg-success');
        control_name.classList.add('text-light');
        color.value = "success";
        // areaSelect.removeChild(areaSelect.options[1])
        // areaSelect.removeChild(areaSelect.options[0])
        // if (areaSelect[0]) {
        //     areaSelect.removeChild(areaSelect.options[0])
        // }
        // if (areaSelect[1]) {
        //     areaSelect.removeChild(areaSelect.options[1])
        // }
        if (areaSelect[0]) {
            // areaSelect.removeChild(areaSelect.options[0])
            // areaSelect[0].remove();
            areaSelect.firstElementChild.remove();
            if (areaSelect.lastElementChild) {
                areaSelect.lastElementChild.remove();

            }
        }
        let option = document.createElement('option');
        option.value = "2";
        option.text = 'المنطقة الجنوبية'
        areaSelect.appendChild(option)
        getEngineer();

    } else if (data.control === 'JABRIYA CONTROL CENTER') {
        control_name.classList.remove('bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-white',
            'text-light', 'text-dark');
        control_name.classList.add('bg-info');
        control_name.classList.add('text-light');
        color.value = "info";
        if (areaSelect[0]) {
            // areaSelect.removeChild(areaSelect.options[0])
            // areaSelect[0].remove();
            areaSelect.firstElementChild.remove();
            if (areaSelect.lastElementChild) {
                areaSelect.lastElementChild.remove();

            }
        }
        let option = document.createElement('option');
        option.value = "2";
        option.text = 'المنطقة الجنوبية'
        areaSelect.appendChild(option);
        getEngineer();
    } else if (data.control === 'JAHRA CONTROL CENTER') {
        control_name.classList.remove('bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-white',
            'text-light', 'text-dark');
        control_name.classList.add('bg-warning');
        control_name.classList.add('text-dark');
        color.value = "warning";
        // areaSelect.removeChild(areaSelect.options[0])
        if (areaSelect[0]) {
            // areaSelect.removeChild(areaSelect.options[0])
            // areaSelect[0].remove();
            areaSelect.firstElementChild.remove();
            if (areaSelect[0]) {
                // areaSelect.removeChild(areaSelect.options[0])
                // areaSelect[0].remove();
                areaSelect.firstElementChild.remove();
                if (areaSelect.lastElementChild) {
                    areaSelect.lastElementChild.remove();

                }
            }
        }
        let option = document.createElement('option');
        option.value = "1";
        option.text = 'المنطقة الشمالية'
        areaSelect.appendChild(option)
        getEngineer();
    } else if (data.control === 'TOWN CONTROL CENTER') {
        control_name.classList.remove('bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-white',
            'text-light', 'text-dark');
        control_name.classList.add('bg-danger');
        control_name.classList.add('text-light');
        color.value = "danger";
        if (areaSelect[0]) {
            // areaSelect.removeChild(areaSelect.options[0])
            // areaSelect[0].remove();
            areaSelect.firstElementChild.remove();
            if (areaSelect.lastElementChild) {

                areaSelect.lastElementChild.remove();
            }
        }
        let option = document.createElement('option');
        option.value = "1";
        option.text = 'المنطقة الشمالية'
        areaSelect.appendChild(option)
        getEngineer();
    } else if (data.control === 'NATIONAL CONTROL CENTER') {

        control_name.classList.remove('bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-white',
            'text-light', 'text-dark');
        control_name.classList.add('bg-white');
        control_name.classList.add('text-black');
        color.value = "white";
        if (areaSelect[0]) {
            areaSelect.removeChild(areaSelect.options[0])
        }
        let option1 = document.createElement('option');
        option1.value = "1";
        option1.text = 'المنطقة الشمالية'
        let option2 = document.createElement('option');
        option2.value = "2";
        option2.text = 'المنطقة الجنوبية'
        areaSelect.appendChild(option1);
        areaSelect.appendChild(option2);
        getEngineer();

    }
    return data;
}
</script>
<script>
//generate random number
const refNum = document.querySelector(".refNum");
let randomNumber = Math.floor(Math.random() * 900);
refNum.value += randomNumber + 1;
//to show hidden input text main alarm 
const MainAlarmSelect = document.querySelector('#main_alarm');
const other_alarm = document.getElementById('other_alarm');
const transformorVoltage = document.getElementById('transformerVoltage');
const voltageLevel = document.getElementById('voltageLevel');
const shuntVoltage = document.getElementById('shuntVoltage');
const dist = document.getElementById('dist');
const equip = document.getElementById('equip');
other_alarm.value = MainAlarmSelect.value;
MainAlarmSelect.addEventListener('change', (event) => {
    equip.value = "";
    if (MainAlarmSelect.value == 'other') {
        transformorVoltage.classList.add('d-none');
        shuntVoltage.classList.add('d-none')
        voltageLevel.classList.remove('d-none');
        dist.classList.add('d-none')
        transformorVoltage.removeAttribute('name');
        shuntVoltage.removeAttribute('name');
        dist.removeAttribute('name');
        other_alarm.classList.toggle('invisible');
        other_alarm.value = ""
    } else if (MainAlarmSelect.value == 'Transformer Clearance') {
        transformorVoltage.classList.remove('d-none')
        transformorVoltage.setAttribute("name", "Voltage_Level");
        voltageLevel.classList.add('d-none');
        dist.classList.add('d-none')
        shuntVoltage.classList.add('d-none');
        shuntVoltage.removeAttribute('name');
        ditst.removeAttribute('name');
        voltage.innerHTML = 'Capacity'
    } else if (MainAlarmSelect.value == 'Shunt Reactor Clearance') {
        shuntVoltage.classList.remove('d-none');
        shuntVoltage.setAttribute("name", "Voltage_Level");
        voltageLevel.classList.add('d-none');
        dist.classList.add('d-none')
        transformorVoltage.classList.add('d-none')
        transformorVoltage.removeAttribute('name');
        dist.removeAttribute('name');
        voltage.innerHTML = 'Capacity'
    } else if (MainAlarmSelect.value == "Dist Prot Main Alaram" ||
        MainAlarmSelect.value == "Dist.Prot.Main B Alarm") {
        dist.classList.remove('d-none')
        dist.setAttribute("name", "Voltage_Level");
        voltageLevel.classList.add('d-none');
        shuntVoltage.classList.add('d-none');
        transformorVoltage.classList.add('d-none')
        shuntVoltage.removeAttribute('name');
        transformorVoltage.removeAttribute('name');
        voltage.innerHTML = 'Voltage'
    } else {
        transformorVoltage.classList.add('d-none');
        shuntVoltage.classList.add('d-none')
        dist.classList.add('d-none')
        voltageLevel.classList.remove('d-none');
        transformorVoltage.removeAttribute('name');
        shuntVoltage.removeAttribute('name');
        dist.removeAttribute('name');
        voltage.innerHTML = 'Voltage';
    }

    other_alarm.value = MainAlarmSelect.value;
})
voltageLevel.addEventListener('change', (event) => {
    switch (voltageLevel.value) {
        case '400KV':
            equip.value = "";
            equip.value = "(xx)C"
            break;
        case '300KV':
            equip.value = "";
            equip.value = "(xx)D";
            break;
        case '132KV':
            equip.value = "";
            equip.value = "(xx)E";
            break;
        case '33KV':
            equip.value = "";
            equip.value = "(xx)H";
            break;
        case '11KV':
            equip.value = "";
            equip.value = "(xx)K";
            break;
    }
})
dist.addEventListener('change', (event) => {
    switch (dist.value) {
        case '400KV':
            equip.value = "";
            equip.value = "(xx)C"
            break;
        case '300KV':
            equip.value = "";
            equip.value = "(xx)D";
            break;
    }
})

//to toggle files atthachmant
const showAttachment = document.getElementById('showAttachment');
const hideAttachment = document.getElementById('hideAttachment');
const attachmentFile = document.getElementById('attachmentFile');
showAttachment.addEventListener('click', e => {
    e.preventDefault();
    hideAttachment.classList.toggle('d-none');
    showAttachment.classList.toggle('d-none');
    attachmentFile.classList.toggle('d-none');
})
hideAttachment.addEventListener('click', e => {
    e.preventDefault();
    hideAttachment.classList.toggle('d-none');
    showAttachment.classList.toggle('d-none');
    attachmentFile.classList.toggle('d-none');
})
</script>
@endsection