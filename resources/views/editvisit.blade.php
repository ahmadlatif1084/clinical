@extends('layouts.master')

@section('content')
    <div class="text-center">
        <a href="{{ url('visit') }}" class="btn btn-info btn-lg">Back to Visit List</a>
    </div>
    <!-- Content Here -->

    <div class="editpatientdiv">
        <form class="form-horizontal" action="{{ url('visit/'.$visit->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Select Patient.</label>
                <div class="col-sm-10">
                    <select class="form-control" name="patient">
                        <option value="{{ $visit->patient_id }}">{{ getPatientbyid($visit->patient_id)}}</option>
                        {{$patient=getPatient()}}
                        @foreach($patient as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Visit Time/Date:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$visit->visit_date}}" id="datetimepicker" name="visit_date" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Next Visit Time/Date:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$visit->next_visit_date}}" id="datetimepicker2" name="next_visit_date"  required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Visit Details</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$visit->visit_details}}" name="visit_details" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Choose Medications.</label>
                <div class="col-sm-10">
                    <select data-placeholder="Choose a medicine..." multiple class="standardSelectmedication" name="medication[]">
                        {{$medication=getMedication()}}
                        @foreach($medication as $medication)
                            <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Choose Diagnoses.</label>
                <div class="col-sm-10">
                    <select data-placeholder="Choose a diagnose..." multiple class="standardSelectdiagnose" name="diagnose[]">
                        <option value=""></option>
                        {{$diagnose=getDiagnose()}}
                        @foreach($diagnose as $diagnose)
                            <option value="{{ $diagnose->id }}">{{ $diagnose->name }}</option>
                        @endforeach
                    </select>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(".standardSelectmedication").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
            $(".standardSelectdiagnose").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });

            var id = <?php echo $visit->id ?>;
            var APP_URL = {!! json_encode(url('/')) !!};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: APP_URL+'/chosensearch/'+id,
                // datatType : 'json',
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success:function(response) {
                   var diagnose=[],medicine=[];
                    for (var i = 0; i < response.Diagnosevisit.length; i++) {
                        var Diagnosevisitarrayvalue=Object.values(response.Diagnosevisit[i]);
                        diagnose.push(Diagnosevisitarrayvalue[2]);
                    }
                    for (var i = 0; i < response.medicine.length; i++) {
                        var medicinevisitarrayvalue=Object.values(response.medicine[i]);
                        medicine.push(medicinevisitarrayvalue[2]);
                    }
                    $('.standardSelectmedication').val(medicine); // if you want it to be automatically selected
                    $('.standardSelectdiagnose').val(diagnose);
                    $('.standardSelectmedication,.standardSelectdiagnose').trigger("chosen:updated");

                }
            });

        });
    </script>
 @endsection