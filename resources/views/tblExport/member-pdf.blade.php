<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Report</title>
    <style>
          body {
        font-family: Arial, sans-serif;
        margin: 5px;
        transform: scale(0.95);
        transform-origin: top left;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        word-wrap: break-word;
    }

    th, td {
        border: 1px solid black;
        padding: 4px;
        font-size: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    @page {
        size: A4 landscape;
        margin: 10mm;
    }

    tr {
        page-break-inside: avoid;
    }
    </style>
</head>

<body>
    <h4>Branch Report</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Application Code</th>
                <th>Member Code</th>
                <th>Branch</th>
                <th>Full Name</th>
                <th>Aadhaar Number</th>
                <th>PAN Number</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Occupation</th>
                <th>Address</th>
                <th>Joining Date</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $member->application_number ?? 'N/A' }}</td>
                <td>{{ $member->member_code ?? 'N/A' }}</td>
                <td>{{ $member->branch->branch_name ?? 'N/A' }}</td>
                <td>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                <td>{{ $member->aadhaar_number }}</td>
                <td>{{ $member->pan_number }}</td>
                <td>{{ $member->email }}</td>
                <td>+91 {{ $member->mobile_number }}</td>
                <td>{{ $member->occupation }}</td>
                <td>{{ $member->correspondence_address_line1 }}, {{ $member->area }} , {{ $member->city }} , {{ $member->pincode }}</td>
                <td>{{ \Carbon\Carbon::parse($member->enrollment_date)->format('d-m-Y') }}</td>
              
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>