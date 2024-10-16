@extends('layout.app')
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Exam Questions</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Exam Name: {{$exam->name}}</h4>
                <form action="{{route('exam-questions.store',$exam->id)}}" method="post" id="examQuestionForm">
                    @csrf
                    <table id="basic-datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Question No</th>
                                <th>Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (old('answers') != null && count(old('answers')) > 0)
                                @for ($i=1;$i<=$exam->total_questions;$i++)
                                    <tr>
                                        <td>
                                            {{'Question No: '.$i}}
                                            <input type="hidden" name="questions_no[]" value="{{$i}}">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="answers[]" id="" class="form-control @error('answers.'.($i-1)) is-invalid @enderror">
                                                    <option value>--Select Answer--</option>
                                                    @foreach ($exam_options as $item)
                                                        <option value="{{$item->option}}" {{old('answers.'.($i-1)) == $item->option?'selected':''}}>{{$item->option}}</option>
                                                    @endforeach
                                                </select>
                                                @error('answers.'.($i-1))
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            @else
                            @if ($exam_questions->count() > 0)
                            @foreach ($exam_questions as $key => $item)
                                <tr>
                                    <td>
                                        {{'Question No: '.($key+1)}}
                                        <input type="hidden" name="questions_no[]" value="{{($key+1)}}">
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="answers[]" id="" class="form-control">
                                                <option value>--Select Answer--</option>
                                                @foreach ($exam_options as $child)
                                                    <option value="{{$child->option}}" {{$child->option == $item->correct_answer ?'selected':''}}>{{$child->option}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                                @for ($i=1;$i<=$exam->total_questions;$i++)
                                    
                                @endfor
                            @else
                            @for ($i=1;$i<=$exam->total_questions;$i++)
                            <tr>
                                <td>
                                    {{'Question No: '.$i}}
                                    <input type="hidden" name="questions_no[]" value="{{$i}}">
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select name="answers[]" id="" class="form-control">
                                            <option value>--Select Answer--</option>
                                            @foreach ($exam_options as $item)
                                                <option value="{{$item->option}}">{{$item->option}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                            @endif
                                
                            @endif
                        </tbody>
                    </table>
                </form>
                
            </div> <!-- end card body-->
            <div class="card-footer text-right">
                <a href="{{route('exams.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
                <button type="submit" class="btn btn-primary waves-effect" form="examQuestionForm">Save</button>
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@include('partials.delete-alert-modal')
@endsection
@push('scripts')
@endpush