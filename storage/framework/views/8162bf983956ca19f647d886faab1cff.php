

<?php $__env->startSection('content'); ?>

<style>

</style>
<!-- Welcome Section -->
<div class="text-center mt-5 mb-3">
    <h5 class="fw-bold text-primary">Welcome to Your Account Dashboard</h5>
    <p class="text-muted fs-10">
        Manage your account details, balance, and transactions efficiently with our advanced tools.
    </p>
</div>
<!-- Account Search Section -->
<div class="container mb-1">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-semibold text-secondary mb-4 text-center">Account Search</h5>
                    <form id="account-search-form" method="GET" action="<?php echo e(url('/accounts')); ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" name="account_number" id="search-account"
                                placeholder="Enter Account Number" required>
                            <button class="btn btn-outline-primary" type="submit" id="account-search-btn">
                                <span id="search-text">Search</span>
                                <span id="search-loader" class="spinner-border spinner-border-sm d-none"></span>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Check for validation errors -->
<?php if(session('errors') && $errors->has('account_number')): ?>
<div class="alert alert-warning text-center mt-4" role="alert">
    <h4 class="alert-heading">Account not found</h4>
    <p><?php echo e($errors->first('account_number')); ?></p>
    <hr>
    <p class="mb-0">Please check your account number and try again.</p>
</div>
<?php endif; ?>

<?php if(isset($accountData) && $accountData): ?>
<!-- Account Details Tabs Section -->
<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg rounded-3 border-0">
                <div class="card-body">
                    <ul class="nav nav-tabs custom-nav-tabs" id="accountTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="account-details-tab" data-bs-toggle="tab"
                                href="#account-details" role="tab" aria-controls="account-details"
                                aria-selected="true">Account Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="balance-tab" data-bs-toggle="tab" href="#balance" role="tab"
                                aria-controls="balance" aria-selected="false">Balance</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="transactions-tab" data-bs-toggle="tab" href="#transactions"
                                role="tab" aria-controls="transactions" aria-selected="false">Transactions</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="accountTabsContent">
                        <!-- Account Details Tab -->
                        <div class="tab-pane fade show active" id="account-details" role="tabpanel"
                            aria-labelledby="account-details-tab">
                            <h5 class="fw-bold text-primary">Account Information</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Account Number</th>
                                            <td><?php echo e($accountData['account_number']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Account Holder Name</th>
                                            <td><?php echo e($accountData['account_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Account Type</th>
                                            <td><?php echo e($accountData['account_type']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php echo e($accountData['account_status']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Created On</th>
                                            <td><?php echo e($accountData['account_created']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Balance Tab -->
                        <div class="tab-pane fade" id="balance" role="tabpanel" aria-labelledby="balance-tab">
                            <h5 class="fw-bold text-primary">Account Balance</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-semibold text-success">₹ <?php echo e($accountData['account_balance']); ?></h4>
                                <button class="btn btn-outline-success rounded-pill shadow-sm"
                                    id="view-transactions-btn">View Transactions</button>
                            </div>
                            <p class="mt-3 text-muted">Your available balance for transactions and withdrawals.</p>
                        </div>

                        <!-- Transactions Tab -->
                        <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
                            <h5 class="fw-bold text-primary">Recent Transactions</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $runningBalance = 0; ?>
                                        <?php $__currentLoopData = $accountData['transactions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($transaction['transaction_date']); ?></td>
                                            <td><?php echo e(ucfirst($transaction['action_type'])); ?></td>
                                            <td>
                                                <?php if($transaction['action_type'] === 'deposit' ): ?>
                                                <span class="text-success">+ ₹ <?php echo e(number_format($transaction['amount'],
                                                    2)); ?></span>
                                                <?php else: ?>
                                                <span class="text-danger">- ₹ <?php echo e(number_format($transaction['amount'],
                                                    2)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <?php
                                            // Update running balance
                                            if ($transaction['action_type'] === 'deposit') {
                                            $runningBalance += $transaction['amount']; // Add deposit
                                            } elseif ($transaction['action_type'] === 'withdrawal') {
                                            $runningBalance -= $transaction['amount']; // Subtract withdrawal
                                            }
                                            ?>
                                            <td>₹ <?php echo e(number_format($runningBalance, 2)); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.getElementById('account-search-form').addEventListener('submit', function() {
        let searchBtn = document.getElementById('account-search-btn');
        let searchText = document.getElementById('search-text');
        let searchLoader = document.getElementById('search-loader');
      
        // Show loading effect and disable button
        searchText.classList.add('d-none');
        searchLoader.classList.remove('d-none');
       
        searchBtn.disabled = true;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/service.blade.php ENDPATH**/ ?>