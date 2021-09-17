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
            <h4 class="content-title mb-0 my-auto">المهمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تعديل مهمة</span>
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


                <form action="{{route('task.update',['id' => $tasks->id])}}" enctype="multipart/form-data"
                    method="post">
                    {{ csrf_field() }} {{-- 1 --}}
                    <div class="row m-3">
                        <div class="col-lg-4">
                            <label for="inputName" class="control-label">رقم التقرير</label>
                            <input type="text" class="refNum form-control" id="inputName" name="refNum" title=""
                                required value="{{$tasks->refNum}}" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="ssname">يرجى اختيار اسم المحطة</label>
                            <input list="ssnames" class="form-control" name="station_code" id="ssname"
                                onchange="getStationFullName()" value="{{$tasks->station->SSNAME}}">


                            <datalist id="ssnames">
                                @foreach($stations as $station)
                                <option value="{{$station->SSNAME}}">
                                    @endforeach
                            </datalist>
                            <input type="hidden" id="ssname2" name="ssname">
                            <input id="staion_full_name" name="staion_full_name"
                                class="text-center d-none p-3 form-control" readonly>
                            <input id="control_name" name="control_name" class="text-center d-none  p-3 form-control"
                                readonly value="{{$tasks->control}}">
                        </div>
                        <input type="hidden" id="color" name="color">

                        <div class=" col-lg-4">
                            <label>تاريخ ارسال المهمة</label>
                            <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{$tasks->task_Date}}" readonly>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-6">
                            <label for="main-alarm" class="control-label m-3">Main Alarm</label>
                            <select name="main_alarm" id="main_alarm" class="form-control">
                                <!--placeholder-->
                                <option value="{{$tasks->main_alarm}}">{{$tasks->main_alarm}}</option>
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
                                @if(!$tasks->main_alarm == "Transformer Clearance" || "Shunt Reactor Clearance")
                                <option value="{{$tasks->Voltage_level}}">{{$tasks->Voltage_level}}</option>
                                @endif
                                <option value="400KV">400KV</option>
                                <option value="300KV">300KV</option>
                                <option value="132KV">132KV</option>
                                <option value="33KV">33KV</option>
                                <option value="11KV">11KV</option>

                            </select>
                            <select id="transformerVoltage" class="d-none form-control">
                                <!--placeholder-->
                                @if($tasks->main_alarm == "Transformer Clearance")
                                <option value="{{$tasks->Voltage_level}}">{{$tasks->Voltage_level}}</option>
                                @endif
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
                                <!--Placeholder-->
                                @if($tasks->main_alarm == "Shunt Reactor Clearance")
                                <option value="{{$tasks->Voltage_level}}">{{$tasks->Voltage_level}}</option>
                                @endif
                                <option value="250MVAR">250MVAR</option>
                                <option value="125MVAR">125MVAR</option>
                                <option value="50MVAR">50MVAR</option>
                                <option value="45MVAR">45MVAR</option>
                                <option value="30MVAR">30MVAR</option>
                            </select>

                            <select id="dist" class="d-none form-control">
                                <!--placeholder-->
                                <option value="400KV">400KV</option>
                                <option value="300KV">300KV</option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3">

                        <div class="col-lg-6">
                            <label for="equip" class="control-label m-1">Bay Unit</label>
                            <input type="text" name="equip" class="form-control SlectBox" value="{{$tasks->equip}}">

                        </div>

                        <div class="col-lg-6">
                            <label for="problem" class="control-label m-1"> Nature of Fault</label>
                            <input list="problems" class="form-control" name="problem" id="problem"
                                value="{{$tasks->problem}}">

                            <datalist id="problems">

                            </datalist>
                        </div>
                    </div>




                    {{-- 2 --}}
                    <div class="row m-3">
                        <div class="col border border-warning p-3 flex-wrap">
                            <h6 class="text-warning">Work Type</h6>
                            <select id="Work_type" class="form-control">
                                <!--Placeholder-->
                                <option value="{{$tasks->Work_type}}">{{$tasks->Work_type}}</option>
                                <option value="Inspection">Inspection</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Troubleshooting">Troubleshooting</option>
                                <option value="outage">Installation</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>

                    {{-- 3 --}}

                    <div class="row m-3">
                        <div class="col-lg-3">
                            <label for="area" class="control-label">area</label>
                            <select name="area" id="areaSelect" class="form-control areaSelect"
                                onchange="getEngineer()">

                                <!-- placeholder-->
                                <option id="areaSelctUpdated" value=""> </option>

                                <!-- <option value="1"> المنطقة الشمالية</option>
                        <option value="2"> المنطقة الجنوبية</option> -->


                            </select>
                        </div>


                        <div class="col-lg-3">
                            <label for="shift" class="control-label">shif</label>
                            <select name="shift" id="shiftSelect" class="form-control " onchange="shiftEngineer()">
                                <!--placeholder-->
                                <option id="shiftSelctUpdated" value=""></option>
                                <!-- <option value="1"> صباحاً </option>
                                <option value="2"> مساءً </option> -->
                            </select>


                        </div>

                        <div class="col">
                            <button id="changeEngineerButton" class="btn btn-outline-info btn-sm ml-2">تغيير اسم
                                المهندس</button>
                            <label for="inputName" class="control-label">اسم المهندس</label>
                            <select id="eng_name" name="eng_name" class="form-control engineerSelect"
                                onchange="getEmail()" onload="getEmail()">
                                <option value="{{$tasks->engineers->id}}">{{$tasks->engineers->name}}</option>
                            </select>
                        </div>
                        <div class="col email">
                            <label for="inputName" class="control-label"> Email</label>
                            <select id="eng_name_email" name="eng_name_email" class="form-control">
                            </select>
                        </div>


                    </div>



                    {{-- 6 --}}
                    <div class="row m-3">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="notes"
                                rows="3">{{$tasks->notes}}</textarea>
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
const shiftSelctUpdated = document.getElementById('shiftSelctUpdated');
const areaSelctUpdated = document.getElementById('areaSelctUpdated');

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
        areaSelectValue.value = data[i].id;
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
        shiftSelectValue.value = data[i].id;
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
//this function to call engineer's email from db
const getEmail2 = async () => {
    let engineerId = engineerSelect.value;
    const response = await fetch("{{ URL::to('engineersEmail') }}/" + engineerId);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();

    let emailEngineerSelectValue = document.createElement('option');
    let shiftSelectValue = document.createElement('option');
    let shiftSecondChoise = document.createElement('option');
    let areaSecondChoise = document.createElement('option');

    emailEngineerSelectValue.value = data[0].email;
    emailEngineerSelectValue.innerHTML = data[0].email;
    areaSelctUpdated.value = data[0].area_id;
    shiftSelctUpdated.value = data[0].shift_id;
    if (data[0].area_id == 1) {
        areaSelctUpdated.text = 'المنطقة الشمالية';

    } else {
        areaSecondChoise.value = 2;
        areaSelctUpdated.text = 'المنطقة الجنوبية';
        // areaSecondChoise.value = 1;
        // areaSecondChoise.text = 'المنطقة الشمالية'
        // areaSelect.appendChild(areaSecondChoise)

    }
    if (data[0].shift_id == 1) {
        shiftSelctUpdated.textContent = 'صباحا';
        shiftSecondChoise.value = 2;
        shiftSecondChoise.text = 'مساء'
        shiftSelect.appendChild(shiftSecondChoise)
    } else {
        shiftSelctUpdated.textContent = 'مساء';
        shiftSecondChoise.value = 1;
        shiftSecondChoise.text = 'صباحا'
        shiftSelect.appendChild(shiftSecondChoise)

    }
    eng_name_email.appendChild(emailEngineerSelectValue);
    return data;
}
//get station full name
const ssname = document.getElementById('ssname');
const staion_full_name = document.getElementById('staion_full_name');
const color = document.getElementById('color');
const control_name = document.getElementById('control_name');
const ssname2 = document.getElementById('ssname2');
const getStationFullName = async () => {
    let staionId = ssname.value
    const response = await fetch("{{ URL::to('stationFullName') }}/" + staionId);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    staion_full_name.classList.remove('d-none')
    staion_full_name.value = data.fullName;
    ssname2.value = data.id;
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
const getStationFullName2 = async () => {
    let staionId = ssname.value
    const response = await fetch("{{ URL::to('stationFullName') }}/" + staionId);
    if (response.status !== 200) {
        throw new Error('can not fetch the data');
    }
    const data = await response.json();
    staion_full_name.classList.remove('d-none')
    staion_full_name.value = data.fullName;
    ssname2.value = data.id;

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

    }
    return data;
}
</script>
<script>
//to show hidden input text main alarm 
const MainAlarmSelect = document.querySelector('#main_alarm');
const other_alarm = document.getElementById('other_alarm');
const transformorVoltage = document.getElementById('transformerVoltage');
const voltageLevel = document.getElementById('voltageLevel');
const shuntVoltage = document.getElementById('shuntVoltage');
const dist = document.getElementById('dist');

other_alarm.value = MainAlarmSelect.value;
MainAlarmSelect.addEventListener('change', (event) => {
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
// getEmail().then(data => console.log(data)).catch(err => console.log(err.message));


getEmail2();
getStationFullName2();
//to change engineer
document.querySelector("#changeEngineerButton").addEventListener('click', e => {
    e.preventDefault();
    shiftEngineer();
})
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
</script>
<script>
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
</script>
@endsection