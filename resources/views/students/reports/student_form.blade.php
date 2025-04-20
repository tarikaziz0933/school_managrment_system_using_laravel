<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .container {
            width: 100%;
            padding-top: 5px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;

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
        .info-table, .parent-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .info-table td, .parent-table td {
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
                                <img src="{{ public_path($student->image->url ?? 'images/blank-profile-pic.png') }}"
                                alt="{{ $student->name }}"
                                style="width: 100px; height: 100px; border: 1px solid #ccc; object-fit: cover;">

                            </td>
                            <td>
                                <h1>{{ $student->name }}</h1>
                                <p>ID: {{ $student->id_number }} | Roll: {{ $student->roll }}</p>
                                <p>Class: {{ $student->studentClass->name ?? '-' }} | Section: {{ $student->section->name ?? '-' }}</p>
                                <p>Campus: {{ $student->campus->name ?? '-' }}</p>
                                <p>Date of Birth: {{ optional($student->dob)->format('d M, Y') }}</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>



    </table>

    {{-- Contact Information --}}
    <div class="section-title">Contact Information</div>
    <table class="info-table">
        <tr>
            <td class="bold">Mobile:</td>
            <td>{{ $student->mobile }}</td>
            <td class="bold">Email:</td>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <td class="bold">Present Address:</td>
            <td colspan="3">{{ $student->present_address }}</td>
        </tr>
        <tr>
            <td class="bold">Permanent Address:</td>
            <td colspan="3">{{ $student->permanent_address }}</td>
        </tr>
    </table>

    {{-- Academic Information --}}
    <div class="section-title">Academic Information</div>
    <table class="info-table">
        <tr>
            <td class="bold">Admitted:</td>
            <td>{{ optional($student->admitted_at)->format('d M, Y') }}</td>
            <td class="bold">Academic Year:</td>
            <td>{{ $student->academic_year }}</td>
        </tr>
        <tr>
            <td class="bold">Group:</td>
            <td>{{ $student->group->name ?? '-' }}</td>
            <td class="bold">Status:</td>
            <td>
                @if ($student->status === 1)
                    <span style="color: green;">Active</span>
                @else
                    <span style="color: red;">Inactive</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="bold">Marks:</td>
            <td>{{ $student->marks }}</td>
        </tr>
    </table>

    {{-- Parents --}}
    <div class="section-title">Parents</div>

    <table class="info-table">

        <tr>
            <td>

                <table>

                    <tr>
                        <td>
                            <img src="{{ public_path($student->father->image->url ?? 'images/blank_male.png') }}"
                 alt="Father"
                 style="width: 72px; height: 72px; border: 1px solid #ccc; object-fit: cover;">

                        </td>
                        <td>
                            <p><span class="bold">Father:</span> {{ $student->father->name ?? '-' }}</p>
                            <p><span class="bold">Occupation:</span> {{ $student->father->occupation->name ?? '-' }}</p>
                            <p><span class="bold">Mobile:</span> {{ $student->father->mobile ?? '-' }}</p>
                        </td>
                    </tr>
                </table>

            </td>
            <td>
                <table>



                    <tr>
                        <td>
                            <img src="{{ public_path($student->mother->image->url ?? 'images/blank_female.png') }}"
                            alt="Mother"
                            style="width: 72px; height: 72px; border: 1px solid #ccc; object-fit: cover;">

                        </td>
                        <td>
                            <p><span class="bold">Mother:</span> {{ $student->mother->name ?? '-' }}</p>
                            <p><span class="bold">Occupation:</span> {{ $student->mother->occupation->name ?? '-' }}</p>
                            <p><span class="bold">Mobile:</span> {{ $student->mother->mobile ?? '-' }}</p>
                        </td>
                    </tr>

                </table>
            </td>

        </tr>
    </table>

    {{-- Characteristics --}}
    @if ($student->characteristics && $student->characteristics->count())
        <div class="section-title">Characteristics</div>
        <div>
            @foreach ($student->characteristics as $characteristic)
                <span class="badge">{{ $characteristic->name }}</span>
            @endforeach
        </div>
    @endif

</div>

</body>
</html>
