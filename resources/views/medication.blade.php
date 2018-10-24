@extends('layouts.master')
@section('extra_css')
@endsection
@section('content')
    <div class="text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addmedication">Add Medication</button>
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
            <th>Medicine Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
        @foreach($medication as $medication)
        <tr>
            <td>{{ $count }}</td>
            <td>{{ $medication->name }}</td>
            <td>
                <a class="btn btn-success " style="color: white;"  href="{{ URL::to('medication/' . $medication->id ) }}">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-warning" style="color: white;"  href="{{ URL::to('medication/' . $medication->id . '/edit') }}">
                    <i class="fa fa-pencil-square"></i>
                </a>
                <a class="btn btn-danger" onclick="deletebrand({{ $medication->id }})" style="color: white;">
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
                text: "Once deleted, you will not be able to recover this Medicine!",
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
                        url: 'medication/'+id,
                        // datatType : 'json',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success:function(response) {
                            swal("Poof! Your Medicine has been deleted!", {
                                icon: "success",
                            });
                            window.location.reload();
                        }
                    });

                } else {
                    swal("Your Medicine is safe!");
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
