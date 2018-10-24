@extends('layouts.master')
@section('extra_css')
    <style>
        .patient-ul{padding: 0;list-style-type: none;}
        .patient-a {color: black;padding: 12px 16px;text-decoration: none;display: block; }
        .patient-a:hover{background-color: #ddd}
        .patient-search{width: 100%;    background-image: url(public/images/searchicon.png);
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: 1px solid #ddd;;
            border-bottom: 1px solid #ddd;}
        .patient-li{border: 1px solid grey;}
    </style>
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- Content Here -->

    <div id="page-wrapper" style="min-height: 430px;">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $user }}</div>
                                <div>Total Users !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $patient }}</div>
                                <div>Total Patients !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $appointment }}</div>
                                <div>Total Appointments !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Patient Search
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <input type="text" placeholder="Search.." id="search" name="search" class="patient-search">
                             <div id="results">

                             </div>
                        </div>
                        <div class="col-lg-8">
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addpatient">Add Patient</button>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">

                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="chartContainer" style="height: 300px; width: 100%;">
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <!-- /.panel -->
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
            <!-- /.col-lg-4 -->
        </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Today Appointments
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Seq.</th>
                                <th>Patient Name</th>
                                <th>Patient Apointment Start Date</th>
                                <th>Patient Appointment End Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count=1; ?>
                            @foreach($appointmentsdetails as $appointmentlist)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $appointmentlist->patient->name}}</td>
                                    <td>{{ $appointmentlist->start_time }}</td>
                                    <td>{{ $appointmentlist->end_time }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Seq.</th>
                                <th>Patient Name</th>
                                <th>Patient Apointment Start Date</th>
                                <th>Patient Appointment End Date</th>
                            </tr>
                            </tfoot>
                        </table>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
            </div>
        <!-- /.row -->
    </div>


    <!-- Content End -->



    <!-- Content-div end-->
    </div>


    <!-- Wrapper-div end-->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function deletebrand(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Appointment!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: 'appointment/'+id,
                        // datatType : 'json',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success:function(response) {
                            swal("Poof! Your Appointment has been deleted!", {
                                icon: "success",
                            });
                            window.location.reload();
                        }
                    });

                } else {
                    swal("Your Appointment is safe!");
                }
            });
        }
    </script>
    <script type="text/javascript">
        window.onload = function () {
            var user = <?php echo $user ?>;
            var appointment = <?php echo $appointment ?>;
            var patient = <?php echo $patient ?>;
            var chart = new CanvasJS.Chart("chartContainer",
                {
                    title:{
                        text: "Patient ,Appointments and Users List"
                    },
                    data: [

                        {
                            dataPoints: [
                                { x: 1, y: patient, label: "Total Patients"},
                                { x: 2, y: appointment,  label: "Total Appointments" },
                                { x: 3, y: user,  label: "Total Users"}
                            ]
                        }
                    ]
                });

            chart.render();
        }
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

        $('#search').on('keyup',function(){

            $value=$(this).val();
            //console.log('value is',$value);

            $.ajax({

                type : 'get',

                url : '{{URL::to('search')}}',

                data:{'search':$value},

                success:function(data){
                    $("#results").html(data);
                }

            });



        })

    </script>

    <script type="text/javascript">

        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    </script>
 @endsection
