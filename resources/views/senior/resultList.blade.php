@foreach($results as $result)
    <tr>
        <td>{{ $result->subjects->subject_name }}</td>
        <td>{{ $result->classes->class_name }} - {{ $result->classes->class_name_num }}</td>
        <td> {{ $result->students->student_name }}</td>
        <td> {{ $result->test_score }}</td>
        <td> {{ $result->exam_score }}</td>
        <td> {{ $result->total }}</td>
        <td> {{ $result->grade }}</td>
        <td> {{ $result->remarks }}</td>
        <td>Action</td>
    </tr>

@endforeach