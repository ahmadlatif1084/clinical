@extends('layouts.master')
@section('extra_css')
@endsection
@section('content')
    <div class="text-center">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adddiagnose">Add Diagnose</button>
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
            <th>Diagnose Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
        @foreach($diagnose as $diagnose)
        <tr>
            <td>{{ $count }}</td>
            <td>{{ $diagnose->name }}</td>
            <td>
                <a class="btn btn-success " style="color: white;"  href="{{ URL::to('diagnose/' . $diagnose->id ) }}">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-warning" style="color: white;"  href="{{ URL::to('diagnose/' . $diagnose->id . '/edit') }}">
                    <i class="fa fa-pencil-square"></i>
                </a>
                <a class="btn btn-danger" onclick="deletebrand({{ $diagnose->id }})" style="color: white;">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
         @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Seq.</th>
            <th>Diagnose Name</th>
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
                text: "Once deleted, you will not be able to recover this Diagnose!",
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
                        url: 'diagnose/'+id,
                        // datatType : 'json',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success:function(response) {
                            swal("Poof! Your Diagnose has been deleted!", {
                                icon: "success",
                            });
                            window.location.reload();
                        }
                    });

                } else {
                    swal("Your Diagnose is safe!");
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
