
<?php $__env->startSection('title'); ?> DD Account Plan Store <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">DD plan</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('dd.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="<?php echo e(route('dd.save', $plan->id ?? '')); ?>" id="DDstore" method="POST">
        <?php echo csrf_field(); ?>




        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($plan->id)): ?> Update <?php else: ?> Add <?php endif; ?> DD Plan Details</div>
            </div>

            <!-- Plan Code -->
            <div class="row gutters">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['plan_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="plan_code" value="<?php echo e(old('plan_code', $plan->plan_code ?? '')); ?>">
                            <span class="input-group-text"><i class="icon-hash"></i></span>
                        </div>
                        <div class="field-placeholder">Plan Code <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['plan_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Plan Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['plan_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="plan_name" value="<?php echo e(old('plan_name', $plan->plan_name ?? '')); ?>">
                            <span class="input-group-text"><i class="icon-domain"></i></span>
                        </div>
                        <div class="field-placeholder">Plan Name <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['plan_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Minimum Amount -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['minimum_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                name="minimum_amount" value="<?php echo e(old('minimum_amount', $plan->minimum_amount ?? '')); ?>">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Minimum Amount <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['minimum_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Lock-in Period & Interest Rates -->
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['lock_in_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="lock_in_period">
                                <option value="" disabled selected>Select Lock-in Period</option>
                                <option value="3" <?php echo e(old('lock_in_period', $plan->lock_in_period ?? '') == 3 ?
                                    'selected' : ''); ?>>3 Months</option>
                                <option value="6" <?php echo e(old('lock_in_period', $plan->lock_in_period ?? '') == 6 ?
                                    'selected' : ''); ?>>6 Months</option>
                                <option value="12" <?php echo e(old('lock_in_period', $plan->lock_in_period ?? '') == 12 ?
                                    'selected' : ''); ?>>12 Months</option>
                                <option value="24" <?php echo e(old('lock_in_period', $plan->lock_in_period ?? '') == 24 ?
                                    'selected' : ''); ?>>24 Months</option>
                                <option value="36" <?php echo e(old('lock_in_period', $plan->lock_in_period ?? '') == 36 ?
                                    'selected' : ''); ?>>36 Months</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Lock-in Period (Months) <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['lock_in_period'];
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

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['annual_interest_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" step="0.01" name="annual_interest_rate"
                                value="<?php echo e(old('annual_interest_rate', $plan->annual_interest_rate ?? '')); ?>">
                            <span class="input-group-text"><i class="icon-percent"></i></span>
                        </div>
                        <div class="field-placeholder">Annual Interest Rate (%) <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['annual_interest_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input
                                class="form-control <?php $__errorArgs = ['senior_citizen_annual_interest_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" step="0.01" name="senior_citizen_annual_interest_rate"
                                value="<?php echo e(old('senior_citizen_annual_interest_rate', $plan->senior_citizen_annual_interest_rate ?? '')); ?>">
                            <span class="input-group-text"><i class="icon-percent"></i></span>
                        </div>
                        <div class="field-placeholder">Senior Citizen Interest Rate (%)</div>
                        <?php $__errorArgs = ['senior_citizen_annual_interest_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Ladies Annual Interest Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['ladies_annual_interest_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" step="0.01" name="ladies_annual_interest_rate"
                                value="<?php echo e(old('ladies_annual_interest_rate', $plan->ladies_annual_interest_rate ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Ladies Annual Interest Rate (%)</div>
                        <?php $__errorArgs = ['ladies_annual_interest_rate'];
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

            <div class="row gutters">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['interest_lock_in_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="interest_lock_in_period">
                                <option value="" disabled selected>Interest Lock-in Period</option>
                                <option value="3" <?php echo e(old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 3 ?
                                    'selected' : ''); ?>>3 Months</option>
                                <option value="6" <?php echo e(old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 6 ?
                                    'selected' : ''); ?>>6 Months</option>
                                <option value="12" <?php echo e(old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 12 ?
                                    'selected' : ''); ?>>12 Months</option>
                                <option value="24" <?php echo e(old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 24 ?
                                    'selected' : ''); ?>>24 Months</option>
                                <option value="36" <?php echo e(old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 36 ?
                                    'selected' : ''); ?>>36 Months</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder"> Interest Lock-in Period (Months) <span
                                class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['interest_lock_in_period'];
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

                <!-- Tenure Type and Value -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <!-- Tenure Type Dropdown -->
                            <select class="form-control <?php $__errorArgs = ['tenure_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="tenure_type">
                                <option value="days" <?php echo e(old('tenure_type', $plan->tenure_type ?? 'days') == 'days' ?
                                    'selected' : ''); ?>>Days</option>
                                <option value="months" <?php echo e(old('tenure_type', $plan->tenure_type ?? 'days') ==
                                    'months' ? 'selected' : ''); ?>>Months</option>
                                <option value="years" <?php echo e(old('tenure_type', $plan->tenure_type ?? 'days') == 'years'
                                    ? 'selected' : ''); ?>>Years</option>
                            </select>
                            <span class="input-group-text">Type</span>

                            <!-- Tenure Value Input -->
                            <input class="form-control <?php $__errorArgs = ['tenure_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                name="tenure_value" value="<?php echo e(old('tenure_value', $plan->tenure_value ?? '')); ?>"
                                placeholder="Enter Tenure Value">
                            <span class="input-group-text">Value</span>
                        </div>
                        <div class="field-placeholder">Tenure <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['tenure_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['tenure_value'];
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


                <!-- RD/DD Frequency -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['rd_dd_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="rd_dd_frequency">
                                <option value="" disabled selected>Select Frequency</option>
                                <option value="daily" <?php echo e(old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'daily' ? 'selected' : ''); ?>>Daily</option>
                                <option value="monthly" <?php echo e(old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'monthly' ? 'selected' : ''); ?>>Monthly</option>
                                <option value="quarterly" <?php echo e(old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'quarterly' ? 'selected' : ''); ?>>Quarterly</option>
                                <option value="annually" <?php echo e(old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'annually' ? 'selected' : ''); ?>>Annually</option>
                            </select>
                            <span class="input-group-text">Frequency</span>
                        </div>
                        <div class="field-placeholder">RD/DD Frequency</div>
                        <?php $__errorArgs = ['rd_dd_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Interest Compounding Interval -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['interest_compounding_interval'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="interest_compounding_interval">
                                <option value="" disabled selected>Select Interval</option>
                                <option value="monthly" <?php echo e(old('interest_compounding_interval', $plan->
                                    interest_compounding_interval ?? '') == 'monthly' ? 'selected' : ''); ?>>Monthly
                                </option>
                                <option value="quarterly" <?php echo e(old('interest_compounding_interval', $plan->
                                    interest_compounding_interval ?? '') == 'quarterly' ? 'selected' : ''); ?>>Quarterly</option>
                                <option value="annually" <?php echo e(old('interest_compounding_interval', $plan->
                                    interest_compounding_interval ?? '') == 'annually' ? 'selected' : ''); ?>>Annually
                                </option>
                            </select>
                            <span class="input-group-text">Interval</span>
                        </div>
                        <div class="field-placeholder">Interest Compounding Interval</div>
                        <?php $__errorArgs = ['interest_compounding_interval'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Cancellation Charge -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['cancellation_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="cancellation_charge"
                                value="<?php echo e(old('cancellation_charge', $plan->cancellation_charge ?? '')); ?>"
                                placeholder="Enter Cancellation Charge">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Cancellation Charge</div>
                        <?php $__errorArgs = ['cancellation_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Penal Charge -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['penal_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="penal_charge"
                                value="<?php echo e(old('penal_charge', $plan->penal_charge ?? '')); ?>"
                                placeholder="Enter Penal Charge">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Penal Charge</div>
                        <?php $__errorArgs = ['penal_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="is_active">
                                <option value="1" <?php echo e(old('is_active', $plan->is_active ?? 1) == 1 ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e(old('is_active', $plan->is_active ?? 1) == 0 ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>


                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skip_sunday" id="skipSunday" value="1" <?php echo e(old('skip_sunday', $plan->skip_sunday ?? false) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="skipSunday">Skip Sunday</label>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skip_saturday" id="skipSaturday" value="1"
                            <?php echo e(old('skip_saturday', $plan->skip_saturday ?? false) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="skipSaturday">Skip Saturday</label>
                    </div>
                </div>


            </div>


        </div>

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="DDsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="DDbuttonText"><?php if(isset($plan->id)): ?> Update <?php else: ?> Submit <?php endif; ?></span>
                <span id="DDloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
                    <span class="visually-hidden">Submitting...</span>
                </span>
            </button>
        </div>
    </form>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    new FormSubmitHandler('DDstore', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accountPlan/Ddstore.blade.php ENDPATH**/ ?>