<!DOCTYPE html>
<html lang="en">

<head>

    <title>Troubleshooting Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <style>
    .mew-logo {
        width: 250px;
    }

    body {
        font-family: 'Cairo', sans-serif;
    }
    </style>
</head>

<body>





    <!-- row -->
    <div class="row">
        @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{route('blogs.userEditReport',['id'=>$tasks->id])}}" enctype="multipart/form-data"
                        method="post" autocomplete="off"> @csrf

                        {{-- 1 --}}
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class=" main-content-body-invoice">
                                    <div class="card card-invoice">
                                        <div class="card-body">
                                            <div class="invoice-header">
                                                <div class="billed-from">
                                                    <img class=" rounded float-left"
                                                        src="https://www.mew.gov.kw/images/logo2@2x.png" alt="mew logo">
                                                </div><!-- billed-from -->

                                                <div class="billed-from">
                                                    <img class="mew-logo rounded float-right"
                                                        src="https://www.mew.gov.kw/images/logo@2x.png" alt="mew logo">
                                                </div><!-- billed-from -->
                                            </div><!-- invoice-header -->
                                            <div class="container">
                                                <div class="table-responsive mg-t-40">
                                                    <h2 class="text-center m-2 text-primary">?????????? ?????????? ?????????? ??????????????
                                                        ????????????????</h2>
                                                    <a href="{{route('blogs.blogs')}}" class="btn btn-secondary">????????????
                                                        ????????????????</a>
                                                    <table
                                                        class="table table-hover table-invoice table-striped table-border text-md-nowrap mb-0">
                                                        <tr>
                                                            <th class="border-bottom-0">Ref Num</th>
                                                            <td colspan="4">{{$tasks->refNum}}</td>
                                                        </tr>
                                                        <input type="hidden" name="refNum" value="{{$tasks->refNum}}">
                                                        <tr>
                                                            <th class="border-bottom-0"> Main Alaram</th>
                                                            <td>{{$tasks->main_alarm}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0">Station</th>
                                                            <td colspan="4">{{$tasks->station->SSNAME}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0">Station </th>
                                                            <td colspan="4">{{$tasks->station->fullName}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0">Make </th>
                                                            @if($tasks->station->COMPANY_MAKE)
                                                            <td colspan="4">{{$tasks->station->COMPANY_MAKE}}</td>
                                                            @else
                                                            <td colspan="4">{{$tasks->make}}</td>
                                                            @endif

                                                        </tr>

                                                        <tr>
                                                            <th class="border-bottom-0">Last P.M </th>
                                                            <td colspan="4">{{$tasks->pm}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0">Control</th>
                                                            @switch($tasks->station->control)
                                                            @case("JAHRA CONTROL CENTER")
                                                            <td colspan="4" class="table-warning">
                                                                {{$tasks->station->control}}
                                                            </td>
                                                            @break
                                                            @case("JABRIYA CONTROL CENTER")
                                                            <td colspan="4" class="table-info">
                                                                {{$tasks->station->control}}
                                                            </td>
                                                            @break
                                                            @case("TOWN CONTROL CENTER")
                                                            <td colspan="4" class="table-danger">
                                                                {{$tasks->station->control}}
                                                            </td>
                                                            @break
                                                            @case("SHUAIBA CONTROL CENTER")
                                                            <td colspan="4" class="table-success">
                                                                {{$tasks->station->control}}
                                                            </td>
                                                            @break
                                                            @default
                                                            <td colspan="4" class="table-light">
                                                                {{$tasks->station->control}}
                                                            </td>
                                                            @endswitch

                                                        </tr>

                                                        <input type="hidden" name="ssname"
                                                            value="{{$tasks->station->id}}">
                                                        <tr>
                                                            <th class="border-bottom-0">Date</th>
                                                            <td>{{$tasks->task_Date}}</td>
                                                        </tr>
                                                        <input type="hidden" name="task_date"
                                                            value="{{$tasks->task_date}}">

                                                        <tr>
                                                            @if($tasks->main_alarm == "Transformer Clearance" ||
                                                            $tasks->main_alarm =="Shunt Reactor Clearance" )
                                                            <th class="border-bottom-0">Capacity</th>
                                                            @else
                                                            <th class="border-bottom-0">Voltage Level</th>
                                                            @endif
                                                            <td>{{$tasks->Voltage_level}}</td>

                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0">Bay Unity</th>
                                                            <td colspan="4">{{$tasks->equip}}</td>

                                                        </tr>
                                                        <input type="hidden" name="equip" value="{{$tasks->equip}}">

                                                        <tr>
                                                            <th class="border-bottom-0">Nature of Fault</th>
                                                            <td colspan="4">{{$tasks->problem}}</td>
                                                        </tr>
                                                        <input type="hidden" name="problem" value="{{$tasks->problem}}">

                                                        <tr>
                                                            <th>??????????????</th>
                                                            <td colspan="4">{{$tasks->notes}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="border-bottom-0 wd-40p">Engineer</th>
                                                            <td colspan="3">{{$tasks->engineers->name}}</td>
                                                        </tr>
                                                        <input type="hidden" name="eng_id"
                                                            value="{{$tasks->engineers->id}}">
                                                        <input class="form-control fc-datepicker" name="report_Date"
                                                            placeholder="YYYY-MM-DD" type="hidden"
                                                            value="{{ date('Y-m-d') }}" readonly required>
                                                    </table>
                                                </div>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    ???? ?????? ????????????????
                                                </button>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="exampleTextarea">Action Take</label>
                                                        <textarea class="form-control" id="exampleTextarea"
                                                            name="action_take"
                                                            rows="3">{{$tasks_details->action_take}}</textarea>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title">????????????????</h5>

                                                        <div class="col-sm-12 col-md-12">
                                                            <input type="file" name="pic" class="dropify form-control"
                                                                accept=".pdf,.jpg, .png, image/jpeg, image/png" />
                                                            <p class="text-danger">* ???????? ???????????? pdf, jpeg ,.jpg , png
                                                            </p>

                                                        </div><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary">?????? ????????????????</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">???????? ?????? ?????????????? </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <form action="/fill_pending_task/{{$tasks->id}}" method="post">
                                {{ csrf_field() }}
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">?????????? ??????????</label>
                                <select name="reason" class="form-control" id="exampleFormControlSelect1">
                                    <option value="?????????????? ?????? ????????">?????????????? ?????? ????????</option>
                                    <option value="?????? ??????????????">?????? ??????????????</option>
                                    <option value="?????? ???????? ?????? ???????????? ">???????? ???????? ?????? ???????????? </option>
                                    <option value="?????????????? ??????????????"> ?????????????? ??????????????</option>
                                    <option value="?????????? ???????????? ???????????? ??????">?????????? ???????????? ???????????? ?????? </option>
                                    <option value="????????"> ????????</option>
                                </select>
                                <!--Take all these hidden value to the form-->
                                <input type="hidden" class="form-control" id="inputName" name="refNum"
                                    value="{{$tasks->refNum}}" readonly>
                                <input type="hidden" class="form-control" readonly name="ssname" id="ssname"
                                    value="{{$tasks->ssname}}">
                                <input class="form-control fc-datepicker" name="task_Date" placeholder="YYYY-MM-DD"
                                    type="hidden" value="{{ $tasks->task_Date}}" readonly required>
                                <input type="hidden" class="form-control" readonly name="equip" id="equip"
                                    value="{{$tasks->equip}}">
                                <input type="hidden" class="form-control" readonly value="{{$tasks->problem}}"
                                    name="problem" id="problem">
                                <input class="form-control fc-datepicker" name="report_Date" placeholder="YYYY-MM-DD"
                                    type="hidden" value="{{ date('Y-m-d') }}" readonly required>
                                <input type="hidden" class="form-control" name="eng_name" readonly
                                    value="{{$tasks->eng_name}}">
                                <textarea type="hidden" style="display:none;" class="form-control" id="exampleTextarea"
                                    name="notes" readonly rows="3">{{$tasks->notes}}</textarea>
                                <!--END Taking all these hidden value to the form-->

                                <label for="exampleTextarea">??????????????</label>
                                <textarea class="form-control" id="exampleTextarea" name="add_more"
                                    rows="3">{{$tasks_details->action_take}}</textarea>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">??????????</button>
                            <button type="submit" class="btn btn-danger">??????????</button>
                        </div>

                    </div>

                    <!-- row closed -->
                </div>
                <!-- Container closed -->
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>