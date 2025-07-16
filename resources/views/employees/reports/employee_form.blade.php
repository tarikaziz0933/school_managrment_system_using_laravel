<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Profile PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .info-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .bold {
            font-weight: bold;
        }
        .badge {
            display: inline-block;
            background-color: #eee;
            padding: 3px 8px;
            border-radius: 10px;
            margin: 3px;
            font-size: 11px;
        }
        .edu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .edu-table th, .edu-table td {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
        }
        .edu-table th {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>

<div class="container">

    {{-- Header --}}
    <table class="info-table">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <img src="{{ public_path($employee->image->url ?? 'images/blank-profile-pic.png') }}"
                                 alt="{{ $employee->name }}"
                                 style="width: 100px; height: 100px; border: 1px solid #ccc; object-fit: cover;">
                        </td>
                        <td>
                            <h1>{{ $employee->name }}</h1>
                            <p>ID: {{ $employee->id_number }} | Designation: {{ $employee->designation->name ?? '-' }}</p>
                            <p>Campus: {{ $employee->campus->name ?? '-' }} | Type: {{ ucfirst($employee->type) }}</p>
                            <p>Joining Date: {{ optional($employee->joined_at)->format('d M, Y') }}</p>
                            {{-- <p>Salary: {{ number_format($employee->salary, 2) }}</p> --}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Basic Information --}}
    <div class="section-title">Basic Information</div>
    <table class="info-table">
        <tr>
            <td class="bold">Date of Birth:</td>
            <td>{{ optional($employee->dob)->format('d M, Y') }} (Age: {{ $employee->dob?->age }} years)</td>
            <td class="bold">Gender:</td>
            <td>{{ ucfirst($employee->gender) }}</td>
        </tr>
        <tr>
            <td class="bold">Marital Status:</td>
            <td>{{ ucfirst(str_replace('_', ' ', $employee->marital_status)) }}</td>
            <td class="bold">Blood Group:</td>
            <td>{{ $employee->bloodGroup?->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">Religion:</td>
            <td>{{ $employee->religion->name ?? '-' }}</td>
            <td class="bold">Nationality:</td>
            <td>{{ $employee->nationality->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">NID_BRN No.:</td>
            <td>{{ $employee->NID_BRN_no ?? '-' }}</td>
            <td class="bold">Status:</td>
            <td>
                @if ($employee->status === 1)
                    <span style="color: green;">Active</span>
                @else
                    <span style="color: red;">Inactive</span>
                @endif
            </td>
        </tr>
    </table>

    {{-- Contact Information --}}
    <div class="section-title">Contact Information</div>
    <table class="info-table">
        <tr>
            <td class="bold">Mobile:</td>
            <td>{{ $employee->mobile }}</td>
            <td class="bold">Email:</td>
            <td>{{ $employee->email ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">Present Address:</td>
            <td colspan="3">{{ $employee->presentAddress?->street ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">Permanent Address:</td>
            <td colspan="3">{{ $employee->permanentAddress?->street ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">NTRCA_reg_number:</td>
            <td>{{ $employee->NTRCA_reg_number ?? '-' }}</td>
            <td class="bold">Experience:</td>
            <td>{{ $employee->experience ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">Computer Knowledge:</td>
            <td>{{ $employee->computer_knowledge ?? '-' }}</td>
            <td class="bold">Reference:</td>
            <td>{{ $employee->reference ?? '-' }}</td>
        </tr>
    </table>

    {{-- Family Information --}}
    <div class="section-title">Family Information</div>
    <table class="info-table">
        <tr>
            <td class="bold">Father's Name:</td>
            <td>{{ $employee->father_name ?? '-' }}</td>
            <td class="bold">Mother's Name:</td>
            <td>{{ $employee->mother_name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">Spouse Name:</td>
            <td>{{ $employee->spouse_name ?? '-' }}</td>
            <td class="bold">Spouse Phone:</td>
            <td>{{ $employee->spouse_mobile ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bold">No. of Children:</td>
            <td colspan="3">{{ $employee->no_of_child ?? '0' }}</td>
        </tr>
    </table>

    {{-- Educational Information --}}
    @if($employee->educations && count($employee->educations) > 0)
        <div class="section-title">Educational Information</div>
        <table class="edu-table">
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Group/Subject</th>
                    <th>Board/University</th>
                    <th>Passing Year</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee->educations as $education)
                    <tr>
                        <td>{{ $education->exam->name ?? '-' }}</td>
                        <td>{{ $education->group->name ?? '-' }}</td>
                        <td>{{ $education->education_board->name ?? '-' }}</td>
                        <td>{{ $education->passing_year ?? '-' }}</td>
                        <td>{{ $education->result ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

</body>
</html>
