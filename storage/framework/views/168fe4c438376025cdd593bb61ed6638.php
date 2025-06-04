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
            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($branch->branch_code ?? 'N/A'); ?></td>
                <td><?php echo e($branch->ifsc_code ?? 'N/A'); ?></td>
                <td><?php echo e($branch->branch_name); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($branch->opening_date)->format('d-m-Y')); ?></td>
                <td><?php echo e($branch->contact_no); ?></td>
                <td><?php echo e($branch->contact_email); ?></td>
                <td><?php echo e($branch->city); ?></td>
                <td><?php echo e($branch->pincode); ?></td>
                <td>
                    <?php if($branch->status == 1): ?>
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

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/tblExport/branch-pdf.blade.php ENDPATH**/ ?>