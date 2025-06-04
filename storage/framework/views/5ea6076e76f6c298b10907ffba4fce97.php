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
                <th>Application Code</th>
                <th>Member Code</th>
                <th>Branch</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Occupation</th>
                <th>Aadhaar No</th>
                <th>Landmark</th>
                <th>Pincode</th>
                <th>Joining Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($member->application_number ?? 'N/A'); ?></td>
                <td><?php echo e($member->member_code ?? 'N/A'); ?></td>
                <td><?php echo e($member->branch->branch_name ?? 'N/A'); ?></td>
                <td><?php echo e($member->first_name); ?></td>
                <td><?php echo e($member->last_name); ?></td>
                <td><?php echo e($member->email); ?></td>
                <td><?php echo e($member->mobile_number); ?></td>
                <td><?php echo e($member->occupation); ?></td>
                <td><?php echo e($member->aadhaar_number); ?></td>
                <td><?php echo e($member->landmark); ?></td>
                <td><?php echo e($member->pincode); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($member->enrollment_date)->format('d-m-Y')); ?></td>
                <td>
                    <?php if($member->status): ?>
                    <span class="badge bg-success">Active</span>
                    <?php else: ?>
                    <span class="badge bg-danger">Deactivated</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html><?php /**PATH C:\xampp\htdocs\NidhiBank\resources\views/tblExport/member-pdf.blade.php ENDPATH**/ ?>