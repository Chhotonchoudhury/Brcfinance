
<?php $__env->startSection('title'); ?> Loan Against Deposit Store <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan AD Plans</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('loanAD.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="<?php echo e(route('loanAD.form', $plan->id ?? '')); ?>" id="DDstore" method="POST">
        <?php echo csrf_field(); ?>

        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($plan->id)): ?> Update <?php else: ?> Add <?php endif; ?> Loan Against Deposit Plan
                </div>
            </div>

            <!-- Plan Code & Name -->
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
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

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
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

                <!-- Deposit Type -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['deposit_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="deposit_type">
                                <option value="" disabled selected>Select Deposit Type</option>
                                <option value="FD" <?php echo e(old('deposit_type', $plan->deposit_type ?? '') == 'FD' ?
                                    'selected' : ''); ?>>Fixed Deposit (FD)</option>
                                <option value="RD" <?php echo e(old('deposit_type', $plan->deposit_type ?? '') == 'RD' ?
                                    'selected' : ''); ?>>Recurring Deposit (RD)</option>
                                <option value="MIS" <?php echo e(old('deposit_type', $plan->deposit_type ?? '') == 'MIS' ?
                                    'selected' : ''); ?>>Monthly Income Scheme (MIS)</option>
                            </select>
                            <span class="input-group-text"><i class="icon-archive"></i></span>
                        </div>
                        <div class="field-placeholder">Deposit Type <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['deposit_type'];
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
                            <input class="form-control <?php $__errorArgs = ['interest_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="interest_rate"
                                value="<?php echo e(old('interest_rate', $plan->interest_rate ?? '')); ?>">
                            <span class="input-group-text"><i class="icon-percent"></i></span>
                        </div>
                        <div class="field-placeholder">Loan Interest Rate (%) <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['interest_rate'];
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

            <!-- Interest Rate & Tenure -->
            <div class="row gutters">


                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['tenure_months'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                name="tenure_months" value="<?php echo e(old('tenure_months', $plan->tenure_months ?? '')); ?>">
                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                        </div>
                        <div class="field-placeholder">Loan Tenure (Months) <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['tenure_months'];
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
                            <input class="form-control <?php $__errorArgs = ['ltv_ratio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="ltv_ratio" value="<?php echo e(old('ltv_ratio', $plan->ltv_ratio ?? 75)); ?>">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Loan-to-Value Ratio (%)</div>
                        <?php $__errorArgs = ['ltv_ratio'];
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
                            <input class="form-control <?php $__errorArgs = ['min_loan_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="min_loan_amount"
                                value="<?php echo e(old('min_loan_amount', $plan->min_loan_amount ?? '')); ?>">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Minimum Loan Amount <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['min_loan_amount'];
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
                            <input class="form-control <?php $__errorArgs = ['max_loan_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="max_loan_amount"
                                value="<?php echo e(old('max_loan_amount', $plan->max_loan_amount ?? '')); ?>">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Maximum Loan Amount</div>
                        <?php $__errorArgs = ['max_loan_amount'];
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

            <!-- Loan Amount & EMI Type -->
            <div class="row gutters">
                <!-- Processing Fee -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['processing_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="processing_fee"
                                value="<?php echo e(old('processing_fee', $plan->processing_fee ?? 0)); ?>">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Processing Fee</div>
                        <?php $__errorArgs = ['processing_fee'];
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
                            <select class="form-control <?php $__errorArgs = ['emi_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="emi_type">
                                <option value="daily" <?php echo e(old('emi_type', $plan->emi_type ?? '') == 'daily' ?
                                    'selected' : ''); ?>>Daily</option>
                                <option value="monthly" <?php echo e(old('emi_type', $plan->emi_type ?? '') == 'monthly' ?
                                    'selected' : ''); ?>>Monthly</option>
                                <option value="quarterly" <?php echo e(old('emi_type', $plan->emi_type ?? '') == 'quarterly' ?
                                    'selected' : ''); ?>>Quarterly</option>
                                <option value="annually" <?php echo e(old('emi_type', $plan->emi_type ?? '') == 'annually' ?
                                    'selected' : ''); ?>>Annually</option>
                            </select>
                            <span class="input-group-text"><i class="icon-clock"></i></span>
                        </div>
                        <div class="field-placeholder">EMI Type</div>
                        <?php $__errorArgs = ['emi_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Prepayment Lock-in Period (Months) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['prepayment_lockin_period_months'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" name="prepayment_lockin_period_months"
                                value="<?php echo e(old('prepayment_lockin_period_months', $plan->prepayment_lockin_period_months ?? 4)); ?>">
                            <span class="input-group-text">Months</span>
                        </div>
                        <div class="field-placeholder">Prepayment Lock-in Period</div>
                        <?php $__errorArgs = ['prepayment_lockin_period_months'];
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


                <!-- Prepayment Charges -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['prepayment_charges'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="prepayment_charges"
                                value="<?php echo e(old('prepayment_charges', $plan->prepayment_charges ?? 0)); ?>">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Prepayment Charges</div>
                        <?php $__errorArgs = ['prepayment_charges'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Late Payment Penalty -->
                
            </div>

            <div class="row gutters">

                <!-- Late Payment Daily Fine Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['late_payment_daily_fine_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" step="0.001" name="late_payment_daily_fine_rate"
                                value="<?php echo e(old('late_payment_daily_fine_rate', $plan->late_payment_daily_fine_rate ?? 0.1)); ?>">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Late Payment Daily Fine Rate</div>
                        <?php $__errorArgs = ['late_payment_daily_fine_rate'];
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

                <!-- Late Payment Fine Start After Days -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input
                                class="form-control <?php $__errorArgs = ['late_payment_fine_start_after_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" name="late_payment_fine_start_after_days"
                                value="<?php echo e(old('late_payment_fine_start_after_days', $plan->late_payment_fine_start_after_days ?? 0)); ?>">
                            <span class="input-group-text">Days</span>
                        </div>
                        <div class="field-placeholder">Fine Starts After (Days)</div>
                        <?php $__errorArgs = ['late_payment_fine_start_after_days'];
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


                <!-- Stamp Duty Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['stamp_duty_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="stamp_duty_rate"
                                value="<?php echo e(old('stamp_duty_rate', $plan->stamp_duty_rate ?? 0)); ?>">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Stamp Duty Rate</div>
                        <?php $__errorArgs = ['stamp_duty_rate'];
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

                <!-- Insurance Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['insurance_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="insurance_rate"
                                value="<?php echo e(old('insurance_rate', $plan->insurance_rate ?? 0)); ?>">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Insurance Rate</div>
                        <?php $__errorArgs = ['insurance_rate'];
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



                <!-- Grace Period -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['grace_period_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                name="grace_period_days"
                                value="<?php echo e(old('grace_period_days', $plan->grace_period_days ?? 0)); ?>">
                            <span class="input-group-text">Days</span>
                        </div>
                        <div class="field-placeholder">Grace Period (Days)</div>
                        <?php $__errorArgs = ['grace_period_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status">
                                <option value="1" <?php echo e(old('status', $plan->status ?? 1) == 1 ? 'selected' : ''); ?>>Active
                                </option>
                                <option value="0" <?php echo e(old('status', $plan->status ?? 1) == 0 ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                            <span class="input-group-text"><i class="icon-check"></i></span>
                        </div>
                        <div class="field-placeholder">Status</div>
                        <?php $__errorArgs = ['status'];
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
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accountPlan/LoanAdstore.blade.php ENDPATH**/ ?>