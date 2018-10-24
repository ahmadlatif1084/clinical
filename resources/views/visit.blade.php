@extends('layouts.master')
@section('extra_css')
@endsection
@section('content')
    <div class="text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addvisit">Add Visit</button>
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
            <th>Patient Name</th>
            <th>Visit Date</th>
            <th>Next Visit Date</th>
            <th>Visit Details</th>
            <th>Diagnosis List</th>
            <th>Medication List</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
        @foreach($visit as $visit)
        <tr>
            <td>{{ $count }}</td>
            <td>{{ getPatientbyid($visit->patient_id) }}</td>
            <td>{{ $visit->visit_date }}</td>
            <td>{{ $visit->	next_visit_date }}</td>
            <td>{{ $visit->visit_details }}</td>
            <td><?php
                $cntmedication=count($visit->medication);
                for ($i=0;$i<$cntmedication;$i++){
                  echo $visit->medication[$i]->name . "<br>";
                }
            ?></td>
            <td><?php
                $cntdiagnose=count($visit->diagnose);
                for ($i=0;$i<$cntdiagnose;$i++){
                    echo $visit->diagnose[$i]->name . "<br>";
                }
                ?></td>
            <td>
                <a class="btn btn-success " style="color: white;"  href="{{ URL::to('visit/' . $visit->id ) }}">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-warning" style="color: white;"  href="{{ URL::to('visit/' . $visit->id . '/edit') }}">
                    <i class="fa fa-pencil-square"></i>
                </a>
                <a class="btn btn-danger" onclick="deletebrand({{ $visit->id }})" style="color: white;">
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
            <th>Visit Date</th>
            <th>Next Visit Date</th>
            <th>Visit Details</th>
            <th>Diagnosis List</th>
            <th>Medication List</th>
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
                text: "Once deleted, you will not be able to recover this Visit!",
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
                        url: 'visit/'+id,
                        // datatType : 'json',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success:function(response) {
                            swal("Poof! Your Visit has been deleted!", {
                                icon: "success",
                            });
                            window.location.reload();
                        }
                    });

                } else {
                    swal("Your Visit is safe!");
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
