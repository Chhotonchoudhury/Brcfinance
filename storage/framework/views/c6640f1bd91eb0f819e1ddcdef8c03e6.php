

<?php $__env->startSection('title'); ?> Savings Account List <?php $__env->stopSection(); ?>

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
            <div class="d-flex justify-content-between align-items-center bg-light w-100" style="height: 40px;">
                <div class="ms-2">
                    <h6 class="m-0">All Savings Accounts</h6>
                </div>
                <div class="me-2">
                    <?php if(hasRolePermission('savingsAC-create')): ?>
                    <a href="<?php echo e(route('sa.create')); ?>" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"> </i> New Savings Account
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                            role="status"></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Left side: Search Form -->
                        <form method="GET" action="<?php echo e(route('sa.index')); ?>" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm" value="<?php echo e($search); ?>"
                                placeholder="Search savings accounts..."
                                style="width: auto; min-height:30px; max-width: 300px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <i class="icon icon-search1 me-1"></i> Search
                            </button>
                        </form>

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            <?php if(hasRolePermission('savingsAC-data-export')): ?>
                            <button id="export-print" class="btn btn-outline-success btn-sm ms-2" title="Print"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <span class="icon-printer"></span> Print
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <table id="account-table" class="table table-bordered table-striped table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Plan Name</th>
                                <th>Account Number</th>
                                <th>Member Name</th>
                                <th>Member Code</th>
                                <th>Avilable Balance</th>
                                <th>AC status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($account->branch->branch_name); ?></td>
                                <td><?php echo e($account->savingsPlan->plan_name); ?></td>
                                <td><a href="<?php echo e(route('sa.profile',$account->id)); ?>"><?php echo e($account->account_number); ?></a></td>
                                <td><?php echo e($account->member->first_name); ?> <?php echo e($account->member->last_name); ?></td>
                                <td><?php echo e($account->member->member_code); ?></td>
                                <td><?php echo e(number_format($account->balance, 2)); ?></td>

                                <td>
                                    <?php if($account->account_status === 'active'): ?>
                                    <span class="badge bg-success">Active</span>
                                    <?php elseif($account->account_status === 'inactive'): ?>
                                    <span class="badge bg-danger">Inactive</span>
                                    <?php elseif($account->account_status === 'on_hold'): ?>
                                    <span class="badge bg-warning">On Hold</span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <div class="td-actions">
                                        <?php if(hasRolePermission('savingsAC-profile-view')): ?>
                                        <!-- View Button (Eye Icon) -->
                                        <a href="<?php echo e(route('sa.profile',$account->id)); ?>" class="icon green"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <?php endif; ?>
                                        <!-- Edit Button (Pencil Icon) -->

                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center">No savings accounts found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <div class="footer-info">
                    Total Records: <?php echo e($accounts->total()); ?>

                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <?php echo e($accounts->links('vendor.pagination.custom-pagination')); ?>

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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accounts/SavingAccount.blade.php ENDPATH**/ ?>