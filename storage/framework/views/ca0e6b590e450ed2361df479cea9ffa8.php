<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Appointment Letter</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.0;
            font-size: 12px;
            margin: 0px;
            color: #000;
            padding: 10px 15px;
        }

        .header {
            margin-top: 0;
            padding-top: 0;
            text-align: center;
        }

        .section {
            margin: 15px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table td,
        .table th {
            border: 1px solid #444;
            padding: 8px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
            text-align: center;
        }

        .signature {
            margin-top: 70px;
            text-align: right;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-row p {
            margin: 0;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2><?php echo e($company['name']); ?></h2>
        <p><?php echo e($company['address']); ?></p>
        <p>Email: <?php echo e($company['email']); ?> | Phone: <?php echo e($company['phone']); ?></p>
        <hr>
    </div>

    <div class="info-row">
        <p>EMPLOYEE NO: <?php echo e($employee->employee_code); ?></p>
        <p>Date: <?php echo e(now()->format('d-m-Y')); ?></p>
    </div>


    <div class="title">APPOINTMENT LETTER</div>

    <p>To,<br>
        <?php echo e($employee->name); ?><br>
        <?php echo e($employee->address); ?><br>
        <?php echo e($employee->city); ?>, <?php echo e($employee->state); ?>

    </p>

    <p>Dear <?php echo e($employee->name); ?>,</p>

    <p>
        We are pleased to offer you the position of
        <strong><?php echo e($employee->job_title); ?></strong>
        (Designation: <strong><?php echo e($employee->job_position); ?></strong>)
        at <strong><?php echo e($company['name']); ?></strong>,
        <?php echo e($employee->branch->branch_name); ?> Branch, effective from
        <strong><?php echo e(\Carbon\Carbon::parse($employee->joining_date)->format('d M, Y')); ?></strong>.
    </p>


    <h4>Employment & Salary Details</h4>
    <table class="table">
        <tr>
            <th>Job Title</th>
            <td><?php echo e($employee->job_title); ?></td>
        </tr>
        <tr>
            <th>Job Position</th>
            <td><?php echo e($employee->job_position); ?></td>
        </tr>
        <tr>
            <th>Employment Type</th>
            <td><?php echo e($employee->employment_type); ?></td>
        </tr>
        <tr>
            <th>Joining Date</th>
            <td><?php echo e(\Carbon\Carbon::parse($employee->joining_date)->format('d M, Y')); ?></td>
        </tr>
        <tr>
            <th>Basic Salary</th>
            <td>₹<?php echo e(number_format($employee->base_salary, 2)); ?></td>
        </tr>

        <tr>
            <th>Gross Salary</th>
            <td>₹<?php echo e(number_format($employee->gross_salary, 2)); ?></td>
        </tr>

        <tr>
            <th>Net Salary</th>
            <td>₹<?php echo e(number_format($employee->salary, 2)); ?></td>
        </tr>
    </table>

    

    <h4>Terms & Conditions</h4>
    <ul>
        <li>Probation period: 6 months.</li>
        <li>Salary is subject to statutory deductions (PF, ESI, TDS, etc.).</li>
        <li>Transferable to any company branch as per business needs.</li>
        <li>Must comply with RBI, MCA, and Companies Act 2013 regulations applicable to Nidhi companies.</li>
        <li>Eligible for 12 Casual and 12 Earned Leaves annually, as per company policy.</li>
        <li>Maintain integrity and professionalism; violations may result in disciplinary action or termination.</li>
        <li>Confidential information must not be disclosed during or after employment unless legally required.</li>
        <li>Working hours: 10:00 AM to 6:00 PM, Monday to Saturday, extendable based on requirements.</li>
        <li>Termination requires one month's notice or salary in lieu; immediate dismissal for misconduct or breach.
        </li>
    </ul>


    <p>We welcome you to our organization and look forward to a long and fruitful association.</p>

    <p>Sincerely,</p>




    <?php if($signatureBase64): ?>
    <div style="float: left; margin-top: 5px;">
        <img src="<?php echo e($signatureBase64); ?>" alt="Signature" width="120">
        <p><strong><?php echo e($employee->name); ?></strong></p>
    </div>
    <?php endif; ?>

    <div class="signature">
        <p>Authorized Signatory</p>
        <p><strong><?php echo e($company['name']); ?></strong></p>
    </div>


</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/letters/appointment.blade.php ENDPATH**/ ?>