

<?php $__env->startSection('title'); ?> RD Account Plans <?php $__env->stopSection(); ?>

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
        /* Darker text color for better readability */
        background-color: #f0f0f0;
        /* Light grey background */
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #d1d1d1;
        /* Light border to give button-like appearance */
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
                    <h6 class="m-0">All RD Account Plans</h6>
                </div>
                <div class="me-2">
                    <?php if(hasRolePermission('rdPlans-create')): ?>
                    <a href="<?php echo e(route('rd.form')); ?>" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"> </i> New RD Plan
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
                        <form method="GET" action="<?php echo e(route('rd.index')); ?>" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm" value="<?php echo e($search); ?>"
                                placeholder="Search RD plans..."
                                style="width: auto; min-height:30px; max-width: 300px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <i class="icon icon-search1 me-1"></i> Search
                            </button>
                        </form>

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            <?php if(hasRolePermission('rdPlans-data-export')): ?>
                            <button id="export-print" class="btn btn-outline-success btn-sm ms-2" title="Print"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <span class="icon-printer"></span> Print
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <table id="plan-table" class="table table-bordered table-striped table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Plan Code</th>
                                <th>Plan Name</th>
                                <th>Min Amount</th>
                                <th>Lock-in Period</th>
                                <th>Annual Interest Rate</th>

                                <th>Tenure</th>
                                <th>Frequency</th>

                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $ddPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ddPlan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td>#<?php echo e($ddPlan->plan_code ?? 'N/A'); ?></td>
                                <td><?php echo e($ddPlan->plan_name); ?></td>
                                <td><?php echo e(number_format($ddPlan->minimum_amount, 2)); ?></td>
                                <td><?php echo e($ddPlan->lock_in_period); ?> <?php echo e($ddPlan->lock_in_period ? 'months' : ''); ?></td>
                                <td><?php echo e($ddPlan->annual_interest_rate); ?>%</td>
                                <td><?php echo e($ddPlan->tenure_value); ?> <?php echo e($ddPlan->tenure_type); ?></td>
                                <td><?php echo e(ucfirst($ddPlan->rd_dd_frequency)); ?></td>

                                <td>
                                    <?php if($ddPlan->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">Deactivated</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="td-actions">
                                        <!-- View Button (Eye Icon) -->
                                        <a href="#" class="icon blue" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="View" data-bs-original-title="View Row">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <?php if(hasRolePermission('rdPlans-edit')): ?>
                                        <!-- Edit Button (Pencil Icon) -->
                                        <a href="<?php echo e(route('rd.form', $ddPlan->id)); ?>" class="icon green"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                            data-bs-original-title="Edit Row">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="15" class="text-center">No RD plans found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer" style="padding: 1%">

                <!-- Total Records -->
                <div class="footer-info">
                    Total Records : <?php echo e($ddPlans->total()); ?>

                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <?php echo e($ddPlans->links('vendor.pagination.custom-pagination')); ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    // For printing the FD account plan table content
    setupPrintButton('export-print', 'plan-table');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accountPlan/Rdindex.blade.php ENDPATH**/ ?>