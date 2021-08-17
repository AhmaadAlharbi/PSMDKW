@include('blogs.BlogsHeader')


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
        <h2>Reports</h2>

        <!-- Blog entries-->
        <div class="col-lg-12">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @if ($stationTasks->count() == 0 )
                <h2 class="text-danger text-center">There is No data </h2>
                @endif
                @foreach($stationTasks as $station)

                <div class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="small text-muted">Date: {{$station->report_date}}</div>
                            <h6 class="card-title  ">Station :{{$station->ssname}}</h6>
                            <h6 class="card-title">Engineer : {{$station->eng_name}}</h6>
                            <p class="card-text text-danger">Nature of fault : {{$station->problem}}</p>
                            <p class="card-text text-success">Action take: {{$station->action_take}}
                                {{$station->reason}}</p>
                            <a class="btn btn-primary" href="{{route('blogs.details',['id'=>$station->id_task])}}">Read
                                more →</a>
                        </div>
                    </div>
                </div>
                @endforeach



                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        {{ $stationTasks->links() }}
                    </ul>
                </nav>
            </div>


        </div>
    </div>
    <!-- Footer-->
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
    </body>

    </html>