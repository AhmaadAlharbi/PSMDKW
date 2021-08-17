@include('blogs.BlogsHeader')
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Primary substation maintenance department</h1>
            <p class="lead mb-0">Protection Section</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                search by Engineer
            </button>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal2">
                search by Station
            </button>
        </div>
    </div>
</header>

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-12">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Blog post-->
                    <div class="table-responsive mg-t-40">
                        <table class="table table-hover table-invoice table-striped table-border text-md-nowrap mb-0">
                            <tr>
                                <th class="border-bottom-0">Report Date</th>
                                <td colspan="4">{{$blog_details->report_date}}</td>
                            </tr>
                            <tr>
                                <th class="border-bottom-0">Report.No</th>
                                <td colspan="4">{{$blog_details->refNum}}</td>

                            </tr>

                            <tr>
                                <th class="border-bottom-0">Station</th>
                                <td colspan="4">{{$blog_details->ssname}}</td>
                            </tr>

                            <tr>
                                <th class="border-bottom-0">Main Alarm</th>
                                <td colspan="4">{{$blog->main_alarm}}</td>

                            </tr>
                            <tr>
                                <th class="border-bottom-0">Voltage Level OR capacity </th>
                                <td colspan="4">{{$blog->Voltage_level}}</td>
                            </tr>
                            <tr>
                                <th class="border-bottom-0">Work Type</th>
                                <td colspan="4">{{$blog->Work_type}}</td>

                            </tr>
                            <tr>
                                <th class="border-bottom-0">Notes</th>
                                <td colspan="4">{{$blog->notes}}</td>

                            </tr>
                            <tr>
                                <th class="border-bottom-0">Equip./Unit Affected </th>
                                <td colspan="4">{{$blog_details->equip}}</td>


                            </tr>
                            <tr>
                                <th class="border-bottom-0">Nature of Fault</th>
                                <td colspan="4">{{$blog_details->problem}}</td>
                            </tr>

                            <tr>
                                <th>More information</th>
                                <td colspan="4">{{$blog_details->add_more}}</td>
                            </tr>
                            <tr>
                                <th>Action Take</th>
                                <td colspan="4">{{$blog_details->action_take}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="4">{{$blog_details->reason}}</td>
                            </tr>
                            <tr>
                                <th class="border-bottom-0 wd-40p">Engineer</th>
                                <td colspan="3">{{$blog_details->eng_name}}</td>


                            </tr>

                        </table>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
<!-- Footer-->
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
@include('blogs.BlogsFooter')

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('js/scripts.js')}}"></script>

</body>

</html>