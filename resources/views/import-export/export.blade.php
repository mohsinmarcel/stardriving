<table>
    <thead>
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Phone No 1</th>
        <th>Phone No 2</th>
        <th>Address</th>
        <th>Postal Code</th>
        <th>City</th>
        <th>Province</th>
        <th>Status In Canada</th>
        <th>Is Medical Condition</th>
        <th>Certificate Number</th>
        <th>License Number</th>
        <th>License Issue Date</th>
        <th>License Expire Date</th>
        <th>Is New Student</th>
        <th>Student Condition</th>
        <th>Theoretical Class Hours</th>
        <th>Practical Class Hours</th>
        <th>Total Hours</th>
        <th>Theoretical Credit Hours Rates</th>
        <th>Practical Credit Hours Rates</th>
        <th>Sub Total</th>
        <th>GST Tax</th>
        <th>QST Tax</th>
        <th>Is discount In Percent</th>
        <th>Discount Amount</th>
        <th>Total Amount</th>
        <th>Remaining Amount</th>
        <th>Beginning of Contract</th>
        <th>End of Contract</th>
        <th>Creation Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ @$student->roll_no }}</td>
            <td>{{ @$student->first_name }}</td>
            <td>{{ @$student->last_name }}</td>
            <td>{{ @$student->email }}</td>
            <td>{{ @$student->gender }}</td>
            <td>{{ @$student->dob }}</td>
            <td>{{ @$student->phone_number_1 }}</td>
            <td>{{ @$student->phone_number_2 }}</td>
            <td>{{ @$student->address }}</td>
            <td>{{ @$student->postal_code }}</td>
            <td>{{ @$student->city }}</td>
            <td>{{ @$student->province }}</td>
            <td>{{ @$student->status_in_canada }}</td>
            <td>{{ @$student->is_medical_condition }}</td>
            <td>{{ @$student->certificate_number }}</td>
            <td>{{ @$student->license_number }}</td>
            <td>{{ @$student->license_issuing_date }}</td>
            <td>{{ @$student->license_expiry_date }}</td>
            <td>{{ @$student->student_type }}</td>
            <td>{{ @$student->student_condition }}</td>
            <td>{{ @$student->theoretical_credit_hours }}</td>
            <td>{{ @$student->practical_credit_hours }}</td>
            <td>{{ @$student->total_hours }}</td>
            <td>{{ @$student->practical_credit_hours_rates }}</td>
            <td>{{ @$student->theoretical_credit_hours_rates }}</td>
            <td>{{ @$student->sub_total }}</td>
            <td>{{ @$student->gst_tax }}</td>
            <td>{{ @$student->qst_tax }}</td>
            <td>{{ @$student->discount_type }}</td>
            <td>{{ @$student->discount }}</td>
            <td>{{ @$student->total_amount }}</td>
            <td>{{ @$student->remaining_amount }}</td>
            <td>{{ @$student->beginning_of_contract }}</td>
            <td>{{ @$student->end_of_contract }}</td>
            <td>{{ @$student->created_at == null? null : date('Y-m-d',strtotime($student->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
