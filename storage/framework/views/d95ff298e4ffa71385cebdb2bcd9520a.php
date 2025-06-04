<!DOCTYPE html>
<html>

<head>
    <title>RD Account Deposit</title>
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

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

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

        /* Success and Danger Colors */
        .success {
            color: #28a745;
            font-weight: bold;
        }

        .danger {
            color: #dc3545;
            font-weight: bold;
        }

        .icon {
            font-size: 20px;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="<?php echo e(asset($companyLogo)); ?>" alt="Company Logo">
            <h3><?php echo e($company->name); ?></h3>
        </div>

        <div class="content">
            <h1><?php echo e($savingsAccount->member->first_name); ?> <?php echo e($savingsAccount->member->middle_name ?? ''); ?> <?php echo e($savingsAccount->member->last_name); ?></h1>

            <p>Your recent <strong>RD account <?php echo e($transaction->action_type == 'deposit' ? 'deposit' : 'withdrawal
                    '); ?></strong> transaction has been processed successfully. Below are the details :</p>

            <table class="details-table">
                <tr>
                    <th>Account Number</th>
                    <td><?php echo e($savingsAccount->account_number); ?></td>
                </tr>
                <tr>
                    <th>Transaction Type</th>
                    <td class="<?php echo e($transaction->action_type == 'deposit' ? 'success' : 'danger'); ?>">
                        <span class="icon">
                            <?php if($transaction->action_type == 'deposit'): ?>
                            &#43;
                            <?php else: ?>
                            &#45;
                            <?php endif; ?>
                        </span>
                        <?php echo e(ucfirst($transaction->action_type)); ?>

                    </td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td class="<?php echo e($transaction->action_type == 'deposit' ? 'success' : 'danger'); ?>">
                        <?php if($transaction->action_type == 'deposit'): ?>
                        &#43;
                        <?php else: ?>
                        &#45;
                        <?php endif; ?> ₹<?php echo e(number_format($transaction->amount,
                        2)); ?>

                    </td>
                </tr>
                <tr>
                    <th>Current Account Balance</th>
                    <td class="<?php echo e($savingsAccount->balance >= 0 ? 'success' : 'danger'); ?>">
                        ₹<?php echo e(number_format($savingsAccount->balance, 2)); ?>

                    </td>
                </tr>
                <tr>
                    <th>Payment Mode</th>
                    <td><?php echo e($transaction->payment_mode); ?></td>
                </tr>
                <tr>
                    <th>Transaction Date</th>
                    <td><?php echo e($transaction->transaction_date); ?></td>
                </tr>
            </table>

            <div class="button-container">
                <a href="https://brcfinance.in/accounts?account_number=<?php echo e($savingsAccount->account_number); ?>"
                    class="button">View Your
                    Account</a>
            </div>

            <p><strong>Best Regards,</strong><br>
                <?php echo e($company->name); ?><br>
                <?php echo e($savingsAccount->branch->branch_name); ?> | <?php echo e($savingsAccount->branch->contact_no); ?> | <a
                    href="https://brcfinance.in/"><?php echo e($company->name); ?></a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($company->name); ?>. All rights reserved.</p>
            <p>Email: <?php echo e($company->email); ?> | Contact: <?php echo e($company->phone); ?></p>
        </div>
    </div>

</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/emails/rd_account_deposit.blade.php ENDPATH**/ ?>