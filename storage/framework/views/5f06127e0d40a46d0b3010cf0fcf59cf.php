
<?php $__env->startSection('title'); ?> Dashboard <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Row start -->
<div class="row gutters">
    <!-- Total Branches -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-building"></i> <!-- Branch Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalBranches); ?></h2>
                <p>Total Branches</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine1"></div>
            </div>
        </div>
    </div>

    <!-- Total Members -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-users"></i> <!-- Members Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalMembers); ?></h2>
                <p>Total Members</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine2"></div>
            </div>
        </div>
    </div>

    <!-- Total Savings Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-piggy-bank"></i> <!-- Savings Account Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalSavingsAccounts); ?></h2>
                <p>Savings Accounts</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine3"></div>
            </div>
        </div>
    </div>

    <!-- Total RD Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-hand-holding-usd"></i> <!-- RD Account Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalRDAccounts); ?></h2>
                <p>Recurring Deposit Accounts</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine4"></div>
            </div>
        </div>
    </div>

    <!-- Total FD Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-coins"></i> <!-- FD Account Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalFDAccounts); ?></h2>
                <p>Fixed Deposit Accounts</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine5"></div>
            </div>
        </div>
    </div>

    <!-- Total Loan Against Deposit Accounts -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-handshake"></i> <!-- Loan Against Deposit Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalLoanAgainstDepositaccounts); ?></h2>
                <p>Loan Against Deposit</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine6"></div>
            </div>
        </div>
    </div>

    <!-- Total Employees -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-user-tie"></i> <!-- Employees Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalEmployees); ?></h2>
                <p>Total Employees</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine7"></div>
            </div>
        </div>
    </div>

    <!-- Total Agents -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="stats-tile">
            <div class="sale-icon">
                <i class="fas fa-user-secret"></i> <!-- Agents Icon -->
            </div>
            <div class="sale-details">
                <h2><?php echo e($totalAgents); ?></h2>
                <p>Total Agents</p>
            </div>
            <div class="sale-graph">
                <div id="sparklineLine8"></div>
            </div>
        </div>
    </div>
</div>

<!-- Row end -->



<!-- Row start -->

<!-- Row end -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/dashboard/index.blade.php ENDPATH**/ ?>