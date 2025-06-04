

<?php $__env->startSection('title'); ?>
<?php echo e(isset($rdInterestSlab) ? 'Update Interest Slab' : 'Create Interest Slab'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row gutters mb-2">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('rd-interest-slab.index')); ?>">Interest Slabs</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(isset($rdInterestSlab) ? 'Edit' : 'Create'); ?>

                </li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 text-end">

        <a href="<?php echo e(route('rd-interest-slab.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
            onclick="showLoadingEffect(event)">
            <span class="icon-arrow-left"></span> Back
            <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
            </span>

        </a>
    </div>
</div>

<div class="card">
    <form action="<?php echo e(route('rd-interest-slab.save', $rdInterestSlab->id ?? '')); ?>" method="POST" id="marketCodeForm">
        <?php echo csrf_field(); ?>

        <div class="card-body">
            <div class="form-section-header">
                <?php echo e(isset($rdInterestSlab) ? 'Update' : 'Create'); ?> RD Interest Slab
            </div>

            <div class="row gutters">
                <!-- Minimum Days -->
                <div class="col-md-2">
                    <div class="field-wrapper">
                        <input type="number" name="min_days"
                            class="form-control <?php $__errorArgs = ['min_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('min_days', $rdInterestSlab->min_days ?? '')); ?>" required>
                        <div class="field-placeholder">Minimum Days <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['min_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Maximum Days -->
                <div class="col-md-2">
                    <div class="field-wrapper">
                        <input type="number" name="max_days"
                            class="form-control <?php $__errorArgs = ['max_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('max_days', $rdInterestSlab->max_days ?? '')); ?>" required>
                        <div class="field-placeholder">Maximum Days <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['max_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>


                <!-- Interest Percentage -->
                <div class="col-md-3">
                    <div class="field-wrapper">
                        <input type="number" name="percentage"
                            class="form-control <?php $__errorArgs = ['percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('percentage', $rdInterestSlab->percentage ?? '')); ?>" required step="0.01">
                        <div class="field-placeholder">Interest Percentage % <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Remarks -->
                <div class="col-md-3">
                    <div class="field-wrapper">
                        <select name="remarks" class="form-control <?php $__errorArgs = ['remarks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Remarks</option>
                            <?php $selectedRemarks = old('remarks', $rdInterestSlab->remarks ?? '') ?>

                            <option value="Free Maturity" <?php echo e($selectedRemarks=='Free Maturity' ? 'selected' : ''); ?>>Free
                                Maturity</option>
                            <option value="Pre Maturity" <?php echo e($selectedRemarks=='Pre Maturity' ? 'selected' : ''); ?>>Pre
                                Maturity</option>
                            <option value="Full Maturity" <?php echo e($selectedRemarks=='Full Maturity' ? 'selected' : ''); ?>>Full
                                Maturity</option>

                        </select>
                        <div class="field-placeholder">Remarks <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['remarks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <div class="field-wrapper">
                        <select name="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="1" <?php echo e(old('status', $rdInterestSlab->status ?? 1) == 1 ? 'selected' : ''); ?>>Active</option>
                            <option value="0" <?php echo e(old('status', $rdInterestSlab->status ?? 1) == 0 ? 'selected' : ''); ?>>Inactive</option>
                        </select>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="SVsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="SVbuttonText"><?php if(isset($rdInterestSlab->id)): ?> Update <?php else: ?> Submit <?php endif; ?> </span>
                <span id="SVloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
                    <span class="visually-hidden">Submitting...</span>
                </span>
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    new FormSubmitHandler('marketCodeForm', 'SVsubmitButton', 'SVbuttonText', 'SVloadingSpinner');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/RdInterestSlab/form.blade.php ENDPATH**/ ?>