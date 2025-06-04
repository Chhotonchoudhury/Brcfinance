<?php $__env->startSection('title'); ?> Branch Storeing <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Company</a></li>
                <li class="breadcrumb-item active" aria-current="page">Branch</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('company.branch')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="<?php echo e(route('company.branch.form', $branch->id ?? '')); ?>" id="store" method="POST"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">Create a New Branch</div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <!-- Branch Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['branch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="branch_name" value="<?php echo e(old('branch_name', $branch->branch_name ?? '')); ?>" required>
                            <span class="input-group-text">
                                <i class="icon-domain"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Branch Name <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['branch_name'];
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
                <!-- Branch Code -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['branch_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="branch_code" value="<?php echo e(old('branch_code', $branch->branch_code ?? '')); ?>"
                                required>
                            <span class="input-group-text">
                                <i class="icon-hash"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Branch Code <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['branch_code'];
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
                <!-- Opening Date -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['opening_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="opening_date" value="<?php echo e(old('opening_date', $branch->opening_date ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Opening Date</div>
                        <?php $__errorArgs = ['opening_date'];
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
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- IFSC Code -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['ifsc_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="ifsc_code" value="<?php echo e(old('ifsc_code', $branch->ifsc_code ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-hash"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">IFSC Code <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['ifsc_code'];
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
                <!-- Contact Email -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email"
                                name="contact_email" value="<?php echo e(old('contact_email', $branch->contact_email ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-email"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Contact Email <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['contact_email'];
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
                <!-- Contact Number -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['contact_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="contact_no" value="<?php echo e(old('contact_no', $branch->contact_no ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-phone1"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Contact Number <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['contact_no'];
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
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Address 1 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['address1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="address1" value="<?php echo e(old('address1', $branch->address1 ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-map-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Address Line 1 <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['address1'];
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
                <!-- Address 2 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['address2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="address2" value="<?php echo e(old('address2', $branch->address2 ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-map-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Address Line 2</div>
                        <?php $__errorArgs = ['address2'];
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
                <!-- City -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="city"
                                value="<?php echo e(old('city', $branch->city ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-location"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">City <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['city'];
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
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- State -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="state"
                                value="<?php echo e(old('state', $branch->state ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-location-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">State <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['state'];
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
                <!-- Pincode -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="pincode" value="<?php echo e(old('pincode', $branch->pincode ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-number"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Pincode <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['pincode'];
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
                <!-- Country -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="country" value="<?php echo e(old('country', $branch->country ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-globe"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Country <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['country'];
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
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Notes -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="notes"><?php echo e(old('notes', $branch->notes ?? '')); ?></textarea>
                        <div class="field-placeholder">Remarks</div>
                        <?php $__errorArgs = ['notes'];
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
                <!-- Payment Service -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select <?php $__errorArgs = ['payment_service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="payment_service">
                                <option value="1" <?php echo e(old('payment_service', $branch->payment_service ?? null) == 1
                                    ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e(old('payment_service', $branch->payment_service ?? null) == 0
                                    ? 'selected' : ''); ?>>Deactivated</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Payment Service (Recharge) <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['payment_service'];
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
                <!-- Transfer Service -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select <?php $__errorArgs = ['transfer_service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="transfer_service">
                                <option value="1" <?php echo e(old('transfer_service', $branch->transfer_service ?? null) ==
                                    1 ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e(old('transfer_service', $branch->transfer_service ?? null) ==
                                    0 ? 'selected' : ''); ?>>Deactivated</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Transfer Service (NEFT/IMPS) <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['transfer_service'];
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
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Status -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="radio"
                                    name="status" value="1" <?php echo e(old('status', $branch->status ?? null) == 1 ?
                                'checked' : ''); ?>>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="radio"
                                    name="status" value="0" <?php echo e(old('status', $branch->status ?? null) == 0 ?
                                'checked' : ''); ?>>
                                <label class="form-check-label">Deactivated</label>
                            </div>
                        </div>
                        <div class="field-placeholder">Status</div>
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
            <!-- Row end -->

            <hr>

            <!-- Submit Button -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button class="btn btn-sm btn-primary py-1 px-2" type="submit">Submit</button>
                </div>
            </div>
        </div>





    </form>

</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    new FormSubmitHandler('store', 'submitButton', 'buttonText', 'loadingSpinner');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/company/branchStore.blade.php ENDPATH**/ ?>