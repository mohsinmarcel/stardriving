<table class="table dt-responsive nowrap w-100 table-sm">
    <thead>
    <tr>
        <th>Question</th>
        <th>Answer</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($exam->exam_questions as $question)
    <tr>
        <td>
            {{'Question No: '.$question->question_no}}
            <input type="hidden" name="questions_no[]" value="{{$question->question_no}}">
        </td>
        <td>
            <div class="form-group mb-0">
                <select name="answers[]" id="" class="form-control">
                    <option value>--Select Answer--</option>
                    @foreach ($exam_options as $item)
                        <option value="{{$item->option}}">{{$item->option}}</option>
                    @endforeach
                </select>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>