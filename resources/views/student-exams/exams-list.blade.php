<option value>-- Select Exam --</option>
@foreach ($exams as $item)
    <option value="{{$item->id}}">{{$item->name}}</option>
@endforeach