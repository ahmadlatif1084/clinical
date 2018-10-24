@extends('layouts.master')
@section('extra_css')
@endsection
@section('content')
    <div class="text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addpatient">Add Patient</button>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- Content Here -->
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Seq.</th>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Mobile Number</th>
            <th>Total Visits</th>
            <th>Paid Amount</th>
            <th>Remaining Amount</th>
            <th>Actions</th>
            <th>Apointments/Reservations</th>
        </tr>
        </thead>
        <tbody>
        <?php $count=1;?>
        <tr>
            <td>{{ $count }}</td>
            <td style="width: 10%;"><img style="width: 40%;" src="public/uploads/{{$patient->image_url}}"></td>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->age }}</td>
            <td>{{ $patient->gender }}</td>
            <td>{{ $patient->mobile }}</td>
            <td>{{ $visits }}</td>
            <td>{{ $patient->paidamount }}</td>
            <td>{{ $patient->remainingamount }}</td>
            <td>
                <a class="btn btn-success " style="color: white;"  href="{{ URL::to('search/' . $patient->id ) }}">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-warning" style="color: white;"  href="{{ URL::to('patient/' . $patient->id . '/edit') }}">
                    <i class="fa fa-pencil-square"></i>
                </a>
                <a class="btn btn-danger" onclick="deletebrand({{ $patient->id }})" style="color: white;">
                    <i class="fa fa-times"></i>
                </a>
            </td>
            <td><button type="button" onclick="addReservation('<?php echo $patient->id;?>','<?php echo $patient->name; ?>')" class="btn btn-info btn-md" data-toggle="modal" data-target="#addappointment">Appointment/Reservation</button></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>Seq.</th>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Mobile Number</th>
            <th>Total Visits</th>
            <th>Paid Amount</th>
            <th>Remaining Amount</th>
            <th>Actions</th>
            <th>Apointments/Reservations</th>
        </tr>
        </tfoot>
    </table>

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
                text: "Once deleted, you will not be able to recover this Patient!",
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
                        url: 'patient/'+id,
                        // datatType : 'json',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success:function(response) {
                            swal("Poof! Your Patient has been deleted!", {
                                icon: "success",
                            });
                            window.location.reload();
                        }
                    });

                } else {
                    swal("Your Patient is safe!");
                }
            });
        }
    </script>
    <script type="text/javascript">
        function addReservation(id,name) {
            $( ".appointment_content" ).append( name);
            $(".input_patient").val(id);
        }
    </script>
 @endsection
