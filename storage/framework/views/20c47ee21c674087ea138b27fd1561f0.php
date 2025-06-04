

<?php $__env->startSection('title'); ?>
<?php echo e(isset($role) ? 'Edit Role' : 'Create Role'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Roles & Permissions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create / Update</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>

<div class="row">


    <div class="card shadow-sm border-light">
        <form id="SAstore" action="<?php echo e(isset($role) ? route('roles.update', $role->id) : route('roles.store')); ?>"
            method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($role)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>


            <div class="card-body">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="fw-semibold">Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control shadow-sm"
                                value="<?php echo e($role->name ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6"><br>
                        <div class="form-check d-flex align-items-center">
                            <input type="checkbox" class="form-check-input" id="selectAllPermissions">
                            <label class="form-check-label fw-bold ms-2" for="selectAllPermissions">
                                Select All Permissions
                            </label>
                        </div>
                    </div>
                </div>

                
                <?php
                $groupedPermissions = collect($permissions)->groupBy(function($permission) {
                return explode('-', $permission->name)[0];
                });
                ?>

                <?php $__currentLoopData = $groupedPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $groupPermissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="text-primary text-uppercase fw-bold mb-3"><?php echo e(ucfirst($group)); ?></h6>
                    <div class="row">
                        <?php $__currentLoopData = $groupPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>"
                                    class="form-check-input permission-checkbox rounded" id="perm_<?php echo e($permission->id); ?>"
                                    <?php echo e(isset($role) && $role->permissions->contains($permission->id) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="perm_<?php echo e($permission->id); ?>">
                                    <?php echo e($permission->name); ?>

                                </label>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="footer-left">
                    <p class="text-muted mb-0 small">Need help? Contact our <a href="#" class="text-primary">support
                            team</a>.</p>
                </div>
                <div class="footer-right">

                    <button class="btn btn-sm btn-outline-primary py-1 px-2" id="DDsubmitButton" type="submit">
                        <span class="icon-save2"></span>
                        <span id="DDbuttonText"> <?php echo e(isset($role) ? 'Update Role' : 'Create Role'); ?> </span>
                        <span id="DDloadingSpinner" class="spinner-border spinner-border-sm text-white d-none"
                            role="status">
                            <span class="visually-hidden"><?php echo e(isset($role) ? 'Updating..' : 'Creating..'); ?></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    document.getElementById('selectAllPermissions').addEventListener('change', function () {
        const checked = this.checked;
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = checked);
    });
</script>

<script>
    new FormSubmitHandler('SAstore', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/roles/create.blade.php ENDPATH**/ ?>