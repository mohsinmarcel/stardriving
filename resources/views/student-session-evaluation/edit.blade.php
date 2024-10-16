@extends('layout.app')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Student Car Session Evaluation</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{route('student-session-evaluation.update',$student_evaluation->id)}}" method="POST" id="studentEvaluationForm">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="header-title">Edit Car Session Evaluation</div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="student" class="control-label" >Select Student:*</label>
                                        <select id="student" class="form-control @error('student') is-invalid @enderror" name="student">
                                            <option value>--Select Student--</option>
                                            @foreach ($students as $item)
                                                <option value="{{$item->id}}" {{$item->id == old('student',$student_evaluation->student_id)?'selected':''}}>{{$item->student_id}} / {{$item->first_name}} {{$item->last_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('student')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="teacher" class="control-label" >Select Teacher:*</label>
                                        <select id="teacher" class="form-control @error('teacher') is-invalid @enderror" name="teacher">
                                            <option value>--Select Teacher--</option>
                                            @foreach ($teachers as $item)
                                                <option value="{{$item->id}}" {{$item->id == old('teacher',$student_evaluation->teacher_id)?'selected':''}}>{{$item->license_number}} / {{$item->first_name}} {{$item->last_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="session" class="control-label" >Select Session:*</label>
                                        <select id="session" class="form-control @error('session') is-invalid @enderror" name="session">
                                            <option value>--Select Session--</option>
                                            @php
                                                $sessions = \App\Constants\DatabaseEnumConstants::EVALUATION_SESSIONS;
                                            @endphp
                                            @foreach ($sessions as $item)
                                            <option value="{{$item}}" {{$item == old('session',$student_evaluation->session)?'selected':''}}>{{Str::title($item)}}</option>
                                            @endforeach
                                        </select>
                                        @error('session')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                        <label for="date" class="control-label" >Date:*</label>
                                        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{old('date',$student_evaluation->date)}}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4>For Learner</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="text-center text-uppercase">Strengths</h5>
                                            <hr>
                                            <div>
                                                @foreach ($strengths as $key => $item)
                                                    <div class="custom-control custom-checkbox checkbox-primary mb-2">
                                                        <input class="custom-control-input learner-strengths" data-value="{{$key}}" id="learner_strengths{{$key}}" name="learner_strengths[]" type="checkbox" value="{{$item->name}}" {{in_array($item->name,old('learner_strengths',$leaner_strength))?'checked':''}}>
                                                        <label class="custom-control-label" for="learner_strengths{{$key}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="text-center text-uppercase">Weaknesses</h5>
                                            <hr>
                                            <div>
                                                @foreach ($weaknesses as $key => $item)
                                                    <div class="custom-control custom-checkbox checkbox-primary mb-2">
                                                        <input class="custom-control-input learner-weaknesses" data-value="{{$key}}" id="learner_weaknesses{{$key}}" name="learner_weaknesses[]" type="checkbox" value="{{$item->name}}" {{in_array($item->name,old('learner_weaknesses',$leaner_weakness))?'checked':''}}>
                                                        <label class="custom-control-label" for="learner_weaknesses{{$key}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="signatureDiv">
                                                <h5>
                                                    Draw your signature
                                                    <a class="text-right clear-button" href="#" id="clear">Clear</a>
                                                </h5>
                                                  <div class="wrapper" style="border: 1px solid black; width: 350px; height:200">
                                                    <canvas id="signature-pad" name="signature" class="signature-pad" width=350 height=200></canvas>
                                                  </div>
                                                @error('signature')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{$student_evaluation->file_path}}" alt="" style="height:100px" width="150px">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h4>For Instructor</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="text-center text-uppercase">Strengths</h5>
                                            <hr>
                                            <div>
                                                @foreach ($strengths as $key => $item)
                                                    <div class="custom-control custom-checkbox checkbox-primary mb-2">
                                                        <input class="custom-control-input instructor-strengths" data-value="{{$key}}" id="instructor_strengths{{$key}}" name="instructor_strengths[]" type="checkbox" value="{{$item->name}}" {{in_array($item->name,old('instructor_strengths',$instructor_strength))?'checked':''}}>
                                                        <label class="custom-control-label" for="instructor_strengths{{$key}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="text-center text-uppercase">Weaknesses</h5>
                                            <hr>
                                            <div>
                                                @foreach ($weaknesses as $key => $item)
                                                    <div class="custom-control custom-checkbox checkbox-primary mb-2">
                                                        <input class="custom-control-input instructor-weaknesses" data-value="{{$key}}" id="instructor_weaknesses{{$key}}" name="instructor_weaknesses[]" type="checkbox" value="{{$item->name}}" {{in_array($item->name,old('instructor_weaknesses',$instructor_weakness))?'checked':''}}>
                                                        <label class="custom-control-label" for="instructor_weaknesses{{$key}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{route('student-session-evaluation.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
                                    <button type="submit" class="btn btn-primary waves-effect">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{asset('assets/js/customs/session-evaluation-script.js')}}"></script>
<script>

$(document).ready(function () {

$('#studentEvaluationForm').submit(function(eventObj) {
    if(!signaturePad.isEmpty()){
        $(this).append('<input type="hidden" name="signature" value="'+signaturePad.toDataURL('image/png')+'" /> ');
        return true;
    }
});

var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
backgroundColor: 'rgba(255, 255, 255, 0)',
penColor: 'rgb(0, 0, 0)'
});
$('#clear').click(function (e) { 
  e.preventDefault();
  signaturePad.clear();

});

});
</script>    
@endpush