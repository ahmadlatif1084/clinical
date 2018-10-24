@extends('layouts.master')

@section('content')
    <div class="text-center">
        <a href="{{ url('patient') }}" class="btn btn-info btn-lg">Back to Patient List</a>
    </div>
    <!-- Content Here -->

    <div class="editpatientdiv">
    <form class="form-horizontal" action="{{ url('patient/'.$patient->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$patient->name}}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Age:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="age" placeholder="Enter age" name="age" value="{{$patient->age}}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Gender:</label>
            <div class="col-sm-10">
                <select name="gender" value="{{$patient->gender}}" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" value="{{$patient->address}}" placeholder="Enter address" name="address" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Phone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" value="{{$patient->phone}}" placeholder="Enter phone" name="phone" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Mobile:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mobile" value="{{$patient->mobile}}" placeholder="Enter mobile" name="mobile" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Paid Amount:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="paidamount" value="{{$patient->paidamount}}" placeholder="Enter paid amount" name="paidamount" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Remaining Amount:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="remainingamount" value="{{$patient->remainingamount}}" placeholder="Enter remaining amount" name="remainingamount" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Patient Picture:</label>
            <div class="col-sm-10">
                <input type="file" class="" id="filebutton-normal" value="{{$patient->image_url}}" name="filebutton-normal" >
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