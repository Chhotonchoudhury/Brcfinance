<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5px;
        }

        table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            word-wrap: break-word;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        @page {
            size: A4;
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
                <th>Branch Code</th>
                <th>IFC Code</th>
                <th>Branch Name</th>
                <th>Opening Date</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>City</th>
                <th>Pin Code</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branches as $branch)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $branch->branch_code ?? 'N/A' }}</td>
                <td>{{ $branch->ifsc_code ?? 'N/A' }}</td>
                <td>{{ $branch->branch_name }}</td>
                <td>{{ \Carbon\Carbon::parse($branch->opening_date)->format('d-m-Y') }}</td>
                <td>{{ $branch->contact_no }}</td>
                <td>{{ $branch->contact_email }}</td>
                <td>{{ $branch->city }}</td>
                <td>{{ $branch->pincode }}</td>
                <td>
                    @if ($branch->status == 1)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Deactivated</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>