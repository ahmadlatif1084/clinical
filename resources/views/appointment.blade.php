@extends('layouts.master')
@section('extra_css')
@endsection
@section('content')
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
            <th>Patient Name</th>
            <th>Patient Apointment Start Date</th>
            <th>Patient Appointment End Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
        @foreach($appointment as $appointment)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $appointment->patient->name}}</td>
            <td>{{ $appointment->start_time }}</td>
            <td>{{ $appointment->end_time }}</td>
            <td>
                <a class="btn btn-warning" style="color: white;"  href="{{ URL::to('appointment/' . $appointment->id . '/edit') }}">
                    <i class="fa fa-pencil-square"></i>
                </a>
                <a class="btn btn-danger" onclick="deletebrand({{ $appointment->id }})" style="color: white;">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Seq.</th>
            <th>Patient Name</th>
            <th>Patient Apointment Start Date</th>
            <th>Patient Appointment End Date</th>
            <th>Actions</th>
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
 @endsection
