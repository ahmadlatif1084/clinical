@extends('layouts.master')

@section('content')
    <div class="text-center">
        <a href="{{ url('complaint') }}" class="btn btn-info btn-lg">Back to Complaint List</a>
    </div>
    <!-- Content Here -->

    <div class="editpatientdiv">
        <form class="form-horizontal" action="{{ url('complaint/'.$complaint->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Select Patient.</label>
                <div class="col-sm-10">
                    <select class="form-control" name="patient">
                        <option value="{{ $complaint->patient_id }}">{{ getPatientbyid($complaint->patient_id)  }}</option>
                        {{$patient=getPatient()}}
                        @foreach($patient as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Complaint Details.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $complaint->name }}" required>
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