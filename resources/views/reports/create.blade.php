@extends('layout.app')
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Reports</h4>
        </div>
    </div>
</div>
<div class="row">
    @can('report-contract')
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h5 class="card-title text-center">STUDENT CONTRACT</h5>
                <form action="{{route('reports.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="student-contract">
                    <div class="form-group">
                        <label for="">Select Student</label>
                        <select class="form-control" name="student">
                            <option value>--Select Student--</option>
                            @foreach ($students as $item)
                                <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'student-contract')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                            @endforeach
                        </select>
                        @if (old('type') == 'student-contract')
                            @error('student')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <input type="submit" value="Generate Report" class="btn btn-primary">
                </form>
            </div> <!-- end card-body-->
        </div>
    </div>
    @endcan
    @can('report-medical')
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h5 class="card-title text-center">STUDENT MEDICAL REPORT</h5>
                <form action="{{route('reports.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="student-medical">
                    <div class="form-group">
                        <label for="">Select Student</label>
                        <select class="form-control" name="student">
                            <option value>--Select Student--</option>
                            @foreach ($students as $item)
                                <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'student-medical')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                            @endforeach
                        </select>
                        @if (old('type') == 'student-medical')
                            @error('student')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <input type="submit" value="Generate Report" class="btn btn-primary">
                </form>
            </div> <!-- end card-body-->
        </div>
    </div><!-- end col-->
    @endcan
    @can('report-exam')
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card d-block">
                <div class="card-body">
                    <h5 class="card-title text-center">STUDENT EXAM REPORT</h5>
                    <form action="{{route('reports.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="exam">
                        <div class="form-group">
                            <label for="">Select Student</label>
                            <select class="form-control" name="student" id="student-exam-declaration">
                                <option value>--Select Student--</option>
                                @foreach ($students as $item)
                                    <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'exam')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                                @endforeach
                            </select>
                            @if (old('type') == 'exam')
                                @error('student')
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Select Exam</label>
                            <select class="form-control" name="exam" id="exam-declaration">
                                <option value>--Select Exam--</option>
                            </select>
                            @if (old('type') == 'exam')
                                @error('exam')
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Select Report Type</label>
                            <select class="form-control" name="report_type">
                                <option value>--Select Report Type--</option>
                                <option value="exam-declaration">Exam Declaraton</option>
                                <option value="exam">Exam</option>
                            </select>
                            @if (old('type') == 'exam')
                                @error('report_type')
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                @enderror
                            @endif
                        </div>
                        <input type="submit" value="Generate Report" class="btn btn-primary">
                    </form>
                </div> <!-- end card-body-->
            </div>
        </div>
    @endcan
    @can('report-evaluation')
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h5 class="card-title text-center">STUDENT EVALUATION</h5>
                <form action="{{route('reports.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="evaluation">
                    <div class="form-group">
                        <label for="">Select Student</label>
                        <select class="form-control" name="student" id="student-session">
                            <option value>--Select Student--</option>
                            @foreach ($students as $item)
                                <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'evaluation')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                            @endforeach
                        </select>
                        @if (old('type') == 'evaluation')
                            @error('student')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Select Session</label>
                        <select class="form-control" name="session" id="session">
                            <option value>--Select Session--</option>
                        </select>
                        @if (old('type') == 'evaluation')
                            @error('session')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <input type="submit" value="Generate Report" class="btn btn-primary">
                </form>
            </div> <!-- end card-body-->
        </div>
    </div><!-- end col-->
    @endcan
    @can('report-attendance')
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h5 class="card-title text-center">STUDENT ATTENDANCE</h5>
                <form action="{{route('reports.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="attendance">
                    <div class="form-group">
                        <label for="">Select Student</label>
                        <select class="form-control" name="student">
                            <option value>--Select Student--</option>
                            @foreach ($students as $item)
                                <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'attendance')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                            @endforeach
                        </select>
                        @if (old('type') == 'attendance')
                            @error('student')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <input type="submit" value="Generate Report" class="btn btn-primary">
                </form>
            </div> <!-- end card-body-->
        </div>
    </div><!-- end col-->
    @endcan
    @can('report-phaseone-certificate')
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h5 class="card-title text-center">STUDENT PHASE ONE CERTIFICATE</h5>
                <form action="{{route('reports.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="phaseone-certificate">
                    <div class="form-group">
                        <label for="">Select Student</label>
                        <select class="form-control" name="student">
                            <option value>--Select Student--</option>
                            @foreach ($students as $item)
                                <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'phaseone-certificate')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                            @endforeach
                        </select>
                        @if (old('type') == 'phaseone-certificate')
                            @error('student')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <input type="submit" value="Generate Report" class="btn btn-primary">
                </form>
            </div> <!-- end card-body-->
        </div>
    </div><!-- end col-->
    @endcan
    @can('report-final-certificate')
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card d-block">
            <div class="card-body">
                <h5 class="card-title text-center">STUDENT FINAL CERTIFICATE</h5>
                <form action="{{route('reports.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="final-certificate">
                    <div class="form-group">
                        <label for="">Select Student</label>
                        <select class="form-control" name="student">
                            <option value>--Select Student--</option>
                            @foreach ($students as $item)
                                <option value="{{$item->id}}" {{(old('student') == $item->id && old('type') == 'final-certificate')?'selected':''}}>{{$item->student_id}} / {{$item->full_name}}</option>
                            @endforeach
                        </select>
                        @if (old('type') == 'final-certificate')
                            @error('student')
                                <p class="text-danger text-sm mt-1">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    <input type="submit" value="Generate Report" class="btn btn-primary">
                </form>
            </div> <!-- end card-body-->
        </div>
    </div>
    @endcan
    
    
    
    
    
</div>
@endsection
@push('scripts')
<script>
    var route = "{{Session::get('route')}}"
    // console.log(success);
    if(route != ''){
        let a= document.createElement('a');
        a.target= '_blank';
        a.href= route;
        a.click();
        // window.open(route, '_blank');
    }
    function getExams(id,defaultId = null){
        let url = '{{route("reports.get-student-exams",":id")}}'
        url = url.replace(':id',id);
        $.get(url,function(data){
            $('#exam-declaration').html(`<option value>-- Select Exam --</option>`);
            $.each(data.data,function(key,value){
                $('#exam-declaration').append(`<option value="${value.id}" ${defaultId == value.id?'selected':''}>${value.name}</option>`);
            })
        });
    }
    function getSessions(id,defaultId = null){
        let url = '{{route("reports.get-student-evaluation",":id")}}'
        url = url.replace(':id',id);
        $.get(url,function(data){
            $('#session').html(`<option value>-- Select Session --</option>`);
            $.each(data.data,function(key,value){
                $('#session').append(`<option value="${value.id}" ${defaultId == value.id?'selected':''}>${value.session}</option>`);
            })
        });
    }
    $(document).ready(function(){
        let studentId = $('#student-exam-declaration').val()
        let studentEvaluationId = $('#student-session').val()
        // console.log(studentId);
        if(studentId != null && studentId != ''){
            getExams(studentId,{{old('exam')}})
        }
        if(studentEvaluationId != null && studentEvaluationId != ''){
            getSessions(studentEvaluationId,{{old('session')}})
        }
    });

    $(document).on('change','#student-exam-declaration',function(){
        let val = $(this).val();
        getExams(val)
    })
    $(document).on('change','#student-session',function(){
        let val = $(this).val();
        getSessions(val)
    })
</script>
@endpush