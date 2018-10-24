@extends('layouts.master')
@section('extra_css')
    <style>
        .nosamepass {
            display: none;
            text-align: center;
            color: red;
        }
    </style>
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- Content Here -->
    {{--{{ dd($user[0]->id) }}--}}
    <form class="form-horizontal" action="{{ url('setting/update/'.$user[0]->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="name" value="{{$user[0]->name}}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{$user[0]->email}}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control"  id="pass1" name="pass1"  required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Confirm New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pass2" name="pass2"  required>
            </div>
        </div>
        <div class="nosamepass">Passwords Don't Match</div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>

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

        $("#pass2").keyup(function() {
            if ($("#pass1").val() != $("#pass2").val()) {
                $(".nosamepass").fadeIn('slow');
                $("#choosepass > input").css("border", "5px solid #ff0033");
            } else {
                $(".nosamepass").fadeOut('slow');
                $("#choosepass > input").css("border", "5px solid #232323");
            }
        });
    </script>
 @endsection
