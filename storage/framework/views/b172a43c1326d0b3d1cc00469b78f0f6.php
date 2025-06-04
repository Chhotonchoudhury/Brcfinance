<?php $__env->startSection('title'); ?> Savings Account Plan Store <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Savings plan</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('saving.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="<?php echo e(route('saving.save', $plan->id ?? '')); ?>" id="SVstore" method="POST">
        <?php echo csrf_field(); ?>

        <div class="card-body">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"> <?php if(isset($plan->id)): ?> Update <?php endif; ?> Plan Details</div>
            </div>

            <!-- Plan Name -->
            <!-- Row start -->
            <div class="row gutters">
                <!-- Plan Code -->
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
                            <span class="input-group-text">
                                <i class="icon-hash"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Plan Code <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['plan_code'];
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
                            <span class="input-group-text">
                                <i class="icon-domain"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Plan Name <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['plan_name'];
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
                <!-- Min Opening Balance -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['min_opening_balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="min_opening_balance"
                                value="<?php echo e(old('min_opening_balance', $plan->min_opening_balance ?? '')); ?>">
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Opening Balance <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['min_opening_balance'];
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
                <!-- Min Average Balance -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['min_avg_balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="min_avg_balance"
                                value="<?php echo e(old('min_avg_balance', $plan->min_avg_balance ?? '')); ?>" required>
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Average Balance <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['min_avg_balance'];
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
                <!-- Annual Interest Rate -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
                                value="<?php echo e(old('annual_interest_rate', $plan->annual_interest_rate ?? '')); ?>" required>
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Annual Interest Rate (%) <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['annual_interest_rate'];
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
                <!-- Senior Citizen Annual Interest Rate -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Senior Citizen Annual Interest Rate (%)</div>
                        <?php $__errorArgs = ['senior_citizen_annual_interest_rate'];
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
                <!-- Interest Payout Frequency -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['interest_payout'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="interest_payout" required>
                                <option value="Monthly" <?php echo e(old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Monthly' ? 'selected' : ''); ?>>Monthly</option>
                                <option value="Yearly" <?php echo e(old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Yearly' ? 'selected' : ''); ?>>Yearly</option>
                                <option value="Half Yearly" <?php echo e(old('interest_payout', $plan->interest_payout ?? '')
                                    == 'Half Yearly' ? 'selected' : ''); ?>>Half Yearly</option>
                                <option value="Quarterly" <?php echo e(old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Quarterly' ? 'selected' : ''); ?>>Quarterly</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Interest Payout Frequency <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['interest_payout'];
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
                <!-- Lock-in Amount -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['lock_in_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="lock_in_amount"
                                value="<?php echo e(old('lock_in_amount', $plan->lock_in_amount ?? '')); ?>" required>
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Lock-in Amount <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['lock_in_amount'];
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

                <!-- Active/Deactive -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="active" required>
                                <option value="1" <?php echo e(old('active', $plan->active ?? 1) == 1 ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e(old('active', $plan->active ?? 1) == 0 ? 'selected' : ''); ?>>Deactive</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-priority_high"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['active'];
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

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($plan->id)): ?> Update <?php endif; ?> Plan Charges</div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <!-- Min Monthly Avg Balance Charge -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['min_monthly_avg_balance_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" name="min_monthly_avg_balance_charge"
                                value="<?php echo e(old('min_monthly_avg_balance_charge', $plan->min_monthly_avg_balance_charge ?? '')); ?>"
                                required>
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Monthly Avg Balance Charge <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['min_monthly_avg_balance_charge'];
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
                <!-- SMS Charge Frequency -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['sms_charge_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="sms_charge_frequency" required>
                                <option value="Monthly" <?php echo e(old('sms_charge_frequency', $plan->sms_charge_frequency
                                    ?? '') == 'Monthly' ? 'selected' : ''); ?>>Monthly</option>
                                <option value="Yearly" <?php echo e(old('sms_charge_frequency', $plan->sms_charge_frequency ??
                                    '') == 'Yearly' ? 'selected' : ''); ?>>Yearly</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-message"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">SMS Charge Frequency <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['sms_charge_frequency'];
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
                <!-- SMS Charge -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['sms_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="sms_charge" value="<?php echo e(old('sms_charge', $plan->sms_charge ?? '')); ?>"
                                required>
                            <span class="input-group-text">
                                <i class="icon-message"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">SMS Charge <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['sms_charge'];
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
                <!-- Card Charges Frequency -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['card_charge_frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="card_charge_frequency" required>
                                <option value="Monthly" <?php echo e(old('card_charge_frequency', $plan->card_charge_frequency
                                    ?? '') == 'Monthly' ? 'selected' : ''); ?>>Monthly</option>
                                <option value="Yearly" <?php echo e(old('card_charge_frequency', $plan->card_charge_frequency
                                    ?? '') == 'Yearly' ? 'selected' : ''); ?>>Yearly</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Card Charge Frequency <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['card_charge_frequency'];
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
                <!-- Card Charge -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['card_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="card_charge"
                                value="<?php echo e(old('card_charge', $plan->card_charge ?? '')); ?>" required>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Card Charge <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['card_charge'];
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
                <!-- Free IFSC Collection Per Month -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['free_ifsc_collection_per_month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="number" name="free_ifsc_collection_per_month"
                                value="<?php echo e(old('free_ifsc_collection_per_month', $plan->free_ifsc_collection_per_month ?? 0)); ?>"
                                required>
                            <span class="input-group-text">
                                <i class="icon-repeat"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Free IFSC Collection Per Month</div>
                        <?php $__errorArgs = ['free_ifsc_collection_per_month'];
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

        </div>

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="SVsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="SVbuttonText"><?php if(isset($plan->id)): ?> Update <?php else: ?> Submit <?php endif; ?> </span>
                <span id="SVloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
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
    new FormSubmitHandler('SVstore', 'SVsubmitButton', 'SVbuttonText', 'SVloadingSpinner');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accountPlan/Savingstore.blade.php ENDPATH**/ ?>