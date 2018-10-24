@extends('layouts.master')

@section('content')
    <div class="text-center">
        <a href="{{ url('appointment') }}" class="btn btn-info btn-lg">Back to Appointment List</a>
    </div>
    <!-- Content Here -->

    <div class="editpatientdiv">
        <form class="form-horizontal" action="{{ url('appointment/'.$appointment->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <input type="text" class="hide" name="id" value="{{ $appointment->id }}">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Appointment Start Time/Date:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="datetimepicker" name="start_time" value="{{ $appointment->start_time }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Appointment End Time/Date:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="datetimepicker2" name="end_time" value="{{ $appointment->end_time }}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Content End -->



    <!-- Content-div end-->
    </div>


    <!-- Wrapper-div end-->
    </div>
@endsection

@section('script')

 @endsection