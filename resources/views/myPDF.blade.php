<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Document</title>
    <style>
    .mew-logo {
        width: 250px;
    }
    </style>

</head>

<body>

    <div class="container">
        <div class="text-center">
            <img class="mew-logo rounded " src="https://www.mew.gov.kw/images/logo@2x.png" alt="mew logo">
        </div>
        <div>
            <h4 class="text-center mb-3">Primary Substation Maintenance Department</h4>
            <h6 class="text-center">Ref.No : {{$task->refNum}}</h6>
        </div>

        <div class="table-responsive mg-t-40">
            <table class="table table-hover table-invoice table-striped table-border text-md-nowrap mb-0">
                <tr>
                    <th class="border-bottom-0"> Report Date</th>
                    <td colspan="4">{{$task_details->report_date}}</td>
                </tr>
                <tr>
                    <th class="border-bottom-0">Ref.No</th>
                    <td colspan="4">{{$task_details->refNum}}</td>

                </tr>

                <tr>
                    <th class="border-bottom-0">Station</th>
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
                    <th class="border-bottom-0">Notes</th>
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
                    <th class="border-bottom-0">Action Take </th>
                    <td colspan="4">{{$task_details->action_take}}</td>
                </tr>
                <tr>
                    <th></th>
                    <td colspan="4">{{$task_details->add_more}}</td>
                </tr>
                <tr>
                    <th class="border-bottom-0 wd-40p">Engineer</th>
                    <td colspan="3">{{$task_details->eng_name}}</td>


                </tr>

            </table>
        </div>
    </div>
</body>

</html>