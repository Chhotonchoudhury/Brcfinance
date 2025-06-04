<?php
use Spatie\Permission\Models\Permission;
$allPermissions = Permission::all()->pluck('name'); // Fetch all available permissions
?>



<?php $__env->startSection('title'); ?> Roles & Permissions <?php $__env->stopSection(); ?>

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
        font-size: 0.9rem;
        color: #333;
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

    .badge-rounded {
        border-radius: 15px !important;
        padding: 0.3em 0.55em;
        font-size: 0.55rem;
    }

    .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row gutters">
    <div class="col-xl-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center bg-light w-100 px-2" style="height: 40px;">
                <h6 class="m-0">Roles & Permissions</h6>
                <a href="<?php echo e(route('roles.create')); ?>" onclick="showLoadingEffect(event)"
                    class="btn btn-sm btn-outline-primary">
                    <i class="icon-plus1 me-1"></i> New Role
                    <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                        role="status"></span>
                </a>
            </div>

            <div class="card-body">
                <!-- Search Form -->
                <form method="GET" action="<?php echo e(route('roles.index')); ?>" class="d-flex align-items-center mb-3">
                    <input type="text" name="search" class="form-control form-control-sm"
                        value="<?php echo e(request('search')); ?>" placeholder="Search roles or permissions..."
                        style="width: 300px; min-height: 30px;">
                    <button type="submit" class="btn btn-outline-primary btn-sm ms-2">
                        <i class="icon-search1 me-1"></i> Search
                    </button>
                </form>

                <!-- Roles Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover m-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($roles->firstItem() + $index); ?></td>
                                <td>
                                    <span class="badge bg-info fs-8"><?php echo e($role->name); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php $__currentLoopData = $allPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($role->permissions->pluck('name')->contains($perm)): ?>
                                        <span class="badge rounded-pill fs-8 px-2 py-1"
                                            style="background-color: #cce5d4; color: #2e7d32;">
                                            <?php echo e($perm); ?>

                                        </span>
                                        <?php else: ?>
                                        <span class="badge rounded-pill fs-8 px-2 py-1"
                                            style="background-color: #e8eaf6; color: #c05c5c;">
                                            <?php echo e($perm); ?>

                                        </span>
                                        <?php endif; ?>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('roles.create', $role->id)); ?>" onclick="showLoadingEffects(event)"
                                        class="btn btn-sm btn-outline-info loading-btn">
                                        <i class="icon-pencil me-1"></i> Edit
                                        <span class="spinner-border spinner-border-sm spinner d-none"
                                            role="status"></span>
                                    </a>

                                    <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this role?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="icon-trash me-1"></i> Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center">No roles found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="footer-info">Total Records: <?php echo e($roles->total()); ?></div>
                <div><?php echo e($roles->links('vendor.pagination.custom-pagination')); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function showLoadingEffects(event) {
        event.preventDefault(); // Prevent immediate navigation

        const button = event.currentTarget;
        const spinner = button.querySelector('.spinner');

        if (spinner) {
            spinner.classList.remove('d-none'); // Show spinner
        }

        // Navigate after short delay or immediately
        window.location.href = button.href;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/roles/index.blade.php ENDPATH**/ ?>