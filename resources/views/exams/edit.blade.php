@extends('layout.app')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Exams</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{route('exams.update',$exam->id)}}" method="POST" id="examForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="header-title">Add Exam</div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label" >Name:*</label>
                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$exam->name)}}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marks_per_question" class="control-label" >Marks Per Question:*</label>
                                        <input type="number" id="marks_per_question" class="form-control @error('marks_per_question') is-invalid @enderror" name="marks_per_question" value="{{old('marks_per_question',$exam->marks_per_question)}}">
                                        @error('marks_per_question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exam_type" class="control-label" >Select Exam Type:*</label>
                                        <select id="exam_type" class="form-control @error('exam_type') is-invalid @enderror" name="exam_type">
                                            <option value></option>
                                            @foreach ($examTypes as $item)
                                                <option value="{{$item->id}}" {{old('exam_type',$exam->exam_type_id) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('exam_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Is Active</label>
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox"  {{$exam->active == 1 ?'checked':''}} name="active" id="checkboxSuccess1">
                                            <label for="checkboxSuccess1">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{route('exams.index')}}" type="button" class="btn btn-secondary waves-effect">Close</a>
                                    <button href="{{route('exams.store')}}" type="submit" class="btn btn-primary waves-effect">Save</button>
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
<script>
</script>
@endpush