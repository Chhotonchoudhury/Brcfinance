

<?php $__env->startSection('title'); ?> All Transactions <?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .footer-info {
        font-size: 0.900rem;
        color: #333333;
        background-color: #f0f0f0;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #d1d1d1;
    }

    .pagination {
        margin-bottom: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center bg-light w-100 " style="height: 40px;">
                <div class="ms-2">
                    <h6 class="m-0">All Transactions</h6>
                </div>
                
                
            </div>

            <div class="card-body">
                <div class="table-responsive mb-0">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Date Range Picker -->
                        <form method="GET" id="search-form" action="<?php echo e(route('transaction.index')); ?>"
                            class="d-flex align-items-center">
                            <div class="field-wrapper mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control custom-daterange"
                                        placeholder="Select Date Range" name="date_range"
                                        value="<?php echo e(request()->input('date_range')); ?>">
                                    <span class="input-group-text">
                                        <i class="icon-calendar1"></i>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2" id="search-btn">
                                <i class="icon icon-search1 me-1"></i> <span id="btn-text">Search</span>
                                <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </form>
                        <!-- Search Bar -->

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            <!-- Print Button -->
                            <?php if(hasRolePermission('transaction-data-export')): ?>
                            <button id="export-print" class="btn btn-sm btn-outline-success ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" title="Print">
                                <i class="icon-printer"></i> Print
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <table id="account-table" class="table table-bordered table-striped table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Account Type</th>
                                <th>Member Name/Number</th>
                                <th>Account Number</th>
                                <th>produced by</th>
                                <th>Transaction Date</th>
                                <th>debited / credited</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalDebit = 0;
                            $totalCredit = 0;
                            ?>
                            <?php if($transactions->isEmpty()): ?>
                            <tr>
                                <td colspan="10" class="text-center">No Records Found</td>
                            </tr>
                            <?php else: ?>

                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="<?php if($transaction->status == 'pending'): ?> table-warning <?php elseif($transaction->status
                                == 'rejected'): ?> table-danger <?php else: ?> '' <?php endif; ?>">
                                <td><?php echo e($key + 1); ?></td>
                                <td> <?php if($transaction->transaction): ?>
                                    <?php echo e($transaction->transaction->branch->branch_name ?? 'N/A'); ?>

                                    <?php else: ?>
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($transaction->account_type); ?></td>
                                <td>
                                    <?php if($transaction->transaction && $transaction->transaction->member): ?>
                                    <?php echo e($transaction->transaction->member->first_name ?? 'N/A'); ?>

                                    <?php echo e($transaction->transaction->member->middle_name ? ' ' .
                                    $transaction->transaction->member->middle_name : ''); ?>

                                    <?php echo e($transaction->transaction->member->last_name ?? 'N/A'); ?>

                                    <?php else: ?>
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($transaction->transaction): ?>
                                    <?php echo e($transaction->transaction->account_number ?? 'N/A'); ?>

                                    <?php else: ?>
                                    N/A
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($transaction->producedBy->name); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($transaction->transaction_date)->format(' F j, Y h:i A')); ?></td>

                                <td>
                                    <?php if($transaction->action_type == 'withdrawal'): ?>
                                    <span class="text-danger"><?php echo e($transaction->action_type); ?></span>
                                    <?php if($transaction->status != 'rejected'): ?>
                                    <?php $totalDebit += $transaction->amount; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <span class="text-success"><?php echo e($transaction->action_type); ?></span>
                                    <?php if($transaction->status != 'rejected'): ?>
                                    <?php $totalCredit += $transaction->amount; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($transaction->action_type == 'withdrawal'): ?>
                                    <span class="text-danger">- <?php echo e(number_format($transaction->amount, 2)); ?></span>
                                    <?php else: ?>
                                    <span class="text-success">+ <?php echo e(number_format($transaction->amount, 2)); ?></span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php
                                    $statusClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-success text-white',
                                    'rejected' => 'bg-danger text-white'
                                    ];
                                    ?>
                                    <span
                                        class="badge <?php echo e($statusClasses[$transaction->status] ?? 'bg-secondary'); ?>  rounded-pill shadow-sm">
                                        <?php echo e(ucfirst($transaction->status)); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endif; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="8" style="text-align: right;">Total :</td>
                                <td style="font-weight: bold;">
                                    Debit: <span class="text-danger"><?php echo e(number_format($totalDebit, 2)); ?></span>
                                </td>

                            </tr>

                            <tr>
                                <td colspan="8" style="text-align: right;">Total :</td>
                                <td style="font-weight: bold;">
                                    Credit: <span class="text-success"><?php echo e(number_format($totalCredit, 2)); ?></span>
                                </td>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <div class="footer-info">
                    Total Records: <?php if($transactions->isEmpty()): ?> 0 <?php else: ?> <?php echo e($transactions->count()); ?> <?php endif; ?>

                </div>


                <!-- Pagination -->
                <div class="pagination-container">
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    // For printing the Savings Account table content
    setupPrintButton('export-print', 'account-table');

    document.getElementById('search-form').addEventListener('submit', function() {
        let searchBtn = document.getElementById('search-btn');
        let btnText = document.getElementById('btn-text');
        let loadingSpinner = document.getElementById('loading-spinner');

        // Disable the button
        searchBtn.disabled = true;
        
        // Hide text and show spinner
        btnText.style.display = 'none';
        loadingSpinner.classList.remove('d-none');
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accounts/Transaction.blade.php ENDPATH**/ ?>