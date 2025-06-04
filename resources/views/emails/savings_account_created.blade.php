<!DOCTYPE html>
<html>

<head>
    <title>Savings Account Transaction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }

        .header img {
            max-width: 50px;
            margin-right: 25px;
            border-radius: 5px;
            /* Space between logo and company name */
        }

        .header h3 {
            margin: 0;
            font-size: 22px;
        }

        /* Content Styling */
        .content {
            padding: 20px;
            text-align: left;
            font-size: 16px;
        }

        .content h1 {
            font-size: 20px;
            color: #007bff;
        }

        .content p {
            margin: 10px 0;
            line-height: 1.6;
        }

        /* Account Details Table */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .details-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Button Styling */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            display: inline-block;
            transition: 0.3s;
        }

        .button:hover {
            background-color: #218838;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #777;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                text-align: center;
            }

            .header img {
                margin-bottom: 10px;
            }

            .header h2 {
                font-size: 18px;
            }

            .content h1 {
                font-size: 18px;
            }

            .button {
                padding: 10px 18px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset($companyLogo) }}" alt="Company Logo">
            <h3>{{ $company->name }}</h3>
        </div>

        <!-- Email Content -->
        <div class="content">
            <h1>Dear {{ $savingsAccount->member->first_name }} {{ $savingsAccount->member->middle_name ?? '' }} {{
                $savingsAccount->member->last_name }},</h1>

            <p>We are pleased to inform you that your <strong>savings account</strong> has been successfully created.
            </p>

            <!-- Account Details Table -->
            <table class="details-table">
                <tr>
                    <th>Account Number</th>
                    <td>{{ $savingsAccount->account_number }}</td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td>{{ $savingsAccount->branch->branch_name }}</td>
                </tr>
                <tr>
                    <th>Opening Date</th>
                    <td>{{ $savingsAccount->opeaning_date }}</td>
                </tr>
                <tr>
                    <th>Initial Deposit</th>
                    <td>₹{{ number_format($savingsAccount->balance, 2) }}</td>
                </tr>
                <tr>
                    <th>Account Status</th>
                    <td>{{ $savingsAccount->account_status }}</td>
                </tr>
            </table>

            <!-- Action Button -->
            <div class="button-container">
                <a href="https://brcfinance.in/accounts?account_number={{ $savingsAccount->account_number }}"
                    class="button">View Your Account</a>
            </div>

            <p><strong>Best Regards,</strong><br>
                {{ $company->name }}<br>
                {{ $savingsAccount->branch->branch_name }} | {{ $savingsAccount->branch->contact_no }} | <a
                    href="https://brcfinance.in/">{{ $company->name }}</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $company->name }}. All rights reserved.</p>
            <p>Email: {{ $company->email }} | Contact: {{ $company->phone }}</p>
        </div>
    </div>

</body>

</html>