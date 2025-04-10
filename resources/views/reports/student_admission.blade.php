<!DOCTYPE html>
<html>
<head>
    <title>Student Admission Report</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        td { padding: 8px; vertical-align: top; }
        .photo { width: 120px; height: 140px; border: 1px solid #000; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PARASHMONI LABORATORY SCHOOL</h2>
        <p>Student Admission Information</p>
    </div>

    <table>
        <tr>
            <td><strong>Name:</strong> {{ $student->name }}</td>
            <td><strong>Roll:</strong> {{ $student->roll }}</td>
        </tr>
        <tr>
            <td><strong>Gender:</strong> {{ $student->gender }}</td>
            <td><strong>Date of Birth:</strong> {{ $student->dob }}</td>
        </tr>
        <tr>
            <td><strong>Mobile:</strong> {{ $student->mobile }}</td>
            <td><strong>Email:</strong> {{ $student->email }}</td>
        </tr>
        <tr>
            <td><strong>Class:</strong> {{ $student->rel_to_class->name ?? 'N/A' }}</td>
            <td><strong>Section:</strong> {{ $student->rel_to_section->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Group:</strong> {{ $student->rel_to_group->name ?? 'N/A' }}</td>
            <td><strong>Campus:</strong> {{ $student->rel_to_campus->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Religion:</strong> {{ $student->rel_to_religion->name ?? 'N/A' }}</td>
            <td><strong>Academic Year:</strong> {{ $student->academic_year }}</td>
        </tr>
        <tr>
            <td><strong>Present Address:</strong> {{ $student->present_address }}</td>
            <td><strong>Permanent Address:</strong> {{ $student->permanent_address }}</td>
        </tr>
        <tr>
            <td><strong>Previous School:</strong> {{ $student->prev_school }}</td>
            <td><strong>Remarks:</strong> {{ $student->remarks }}</td>
        </tr>
        <tr>
            <td class="photo">Student Photo</td>
            <td class="photo">Father's Photo</td>
        </tr>
    </table>
</body>
</html>
