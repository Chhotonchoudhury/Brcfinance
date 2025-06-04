<!DOCTYPE html>
<html>

<head>
    <title>Welcome to BRCFinance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        .header {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .header img {
            max-width: 50px;
            border-radius: 5px;
        }

        .header h2 {
            flex-grow: 1;
            margin: 0;
            font-size: 20px;
            text-align: center;
        }

        /* Content */
        .content {
            padding: 20px;
            text-align: center;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 5px 0;
        }

        /* Button Styling */
        .button-container {
            margin-top: 20px;
            text-align: center;
        }

        .button {
            background-color: #28a745;
            color: #fff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            transition: background 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button:hover {
            background-color: #218838;
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

            .button {
                padding: 12px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Professional Header -->
        <div class="header">
            <img src="<?php echo e(asset($companyLogo)); ?>" alt="BRCFinance Logo">
            <h2><?php echo e($company->name); ?></h2>
        </div>

        <!-- Email Content -->
        <div class="content">
            <h3>Congratulations, <?php echo e($member->first_name); ?> <?php echo e($member->middle_name ?? ''); ?> <?php echo e($member->last_name); ?>!
            </h3>
            <p>Your membership account has been successfully created in <strong><?php echo e($company->name); ?></strong>.</p>
            <p><strong>Membership Code :</strong> <?php echo e($member->member_code); ?></p>
            <p><strong>Branch :</strong> <?php echo e($member->branch->branch_name ?? 'N/A'); ?></p>
            <p>We are excited to have you as a part of our financial family.</p>
            <!-- New Button Design -->
            <div class="button-container">
                <a href="https://brcfinance.in/" class="button">Visit Our Site</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> BRCFinance. All rights reserved.</p>
            <p>Email: <?php echo e($company->email); ?> | Contact: <?php echo e($company->phone); ?></p>
        </div>
    </div>
</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/emails/member_welcome.blade.php ENDPATH**/ ?>