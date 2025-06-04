
<?php $__env->startSection('title'); ?> Loan Against Application Create <?php $__env->stopSection(); ?>

<style>
    .form-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .form-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .form-switch-slider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 24px;
    }

    .form-switch-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    .form-switch input:checked+.form-switch-slider {
        background-color: #007bff;
    }

    .form-switch input:checked+.form-switch-slider:before {
        transform: translateX(26px);
    }

    .field-wrapper {
        margin-bottom: 20px;
    }

    .field-placeholder {
        font-size: 0.9rem;
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .field-value {
        background-color: #f0f0f0;
        /* Light background for the value */
        border: 1px solid #ddd;
        /* Light border for clarity */
        padding: 10px;
        font-size: 1rem;
        color: #333;
        font-weight: 500;
        border-radius: 5px;
        text-align: center;
    }
</style>
<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Loan AD Application</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('LoanADApplication.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="header-left">
            <h5 class="card-title mb-0">Create New Loan AD Appliaction</h5>
            <p class="text-muted small mb-0">Fill in the form below to create application</p>
        </div>
        <div class="header-right">
            <button class="btn btn-outline-primary btn-sm py-1 px-2">Help</button>
        </div>
    </div>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>


    <form action="<?php echo e(route('LoanADApplication.save')); ?>" id="SAstore" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Card Body -->
        <div class="card-body">
            <div class="row gutters">

                <div class="row gutters">
                    <!-- Members Select -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <div class="">
                                <select class="select-single js-states <?php $__errorArgs = ['member_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="member_id" id="memberSelect" required>
                                    <option selected>Select Member</option>
                                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($member->id); ?>" <?php echo e(old('member_id')==$member->id ? 'selected'
                                        : ''); ?>>
                                        <?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?> (<?php echo e($member->member_code); ?>)
                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="field-placeholder">Members <span class="text-danger">*</span></div>
                            </div>
                            <?php $__errorArgs = ['member_id'];
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

                    <!-- Branches Select -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <select class="select-single js-states <?php $__errorArgs = ['branch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="branch_id" required>
                                <option selected>Select Branch</option>
                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(old('branch_id')==$branch->id ? 'selected' : ''); ?>>
                                    <?php echo e($branch->branch_name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="field-placeholder">Branches <span class="text-danger">*</span></div>
                        </div>
                        <?php $__errorArgs = ['branch_id'];
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

                    <!-- Plans Select -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <select class="select-single js-states <?php $__errorArgs = ['rd_plan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="rd_plan_id" id="savingsPlanSelect" required>
                                <option selected>Select Plan</option>
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plan->id); ?>" <?php echo e(old('rd_plan_id')==$plan->id ? 'selected' :
                                    ''); ?>>
                                    <?php echo e($plan->plan_name); ?> ( <?php echo e($plan->interest_rate); ?> %)
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="field-placeholder">Plans <span class="text-danger">*</span></div>
                        </div>
                        <?php $__errorArgs = ['rd_plan_id'];
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

                    <!-- Agents Employee Id Select  -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <select class="select-single js-states <?php $__errorArgs = ['agent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="agent_id">
                                <option selected value="">Select Agent / Employee</option>
                                <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($agent->id); ?>" <?php echo e(old('agent_id')==$agent->id ? 'selected' : ''); ?>>
                                    <?php echo e($agent->name); ?> (<?php echo e($agent->user_type); ?>)
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="field-placeholder">Agents / Employee</div>
                        </div>
                        <?php $__errorArgs = ['agent_id'];
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

                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberName">
                            <div class="field-placeholder">Member Name </div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberCode">
                            <div class="field-placeholder">Member Code </div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberEmail">
                            <div class="field-placeholder">Member Email</div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberPhone">
                            <div class="field-placeholder">Member Phone</div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>
                </div>
                <hr>

                <div class="row gutters">

                    <!---selec the Deposit Type -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <label for="depositType" class="field-placeholder">Deposit Type <span
                                    class="text-danger">*</span></label>
                            <select class="form-control <?php $__errorArgs = ['deposit_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="depositType"
                                name="deposit_type">
                                <option value="">Select Deposit Type</option>
                                <option value="FD" <?php echo e(old('deposit_type')=='fd' ? 'selected' : ''); ?>>Fixed Deposit
                                    (FD)</option>
                                <option value="RD" <?php echo e(old('deposit_type')=='rd' ? 'selected' : ''); ?>>
                                    Recurring Deposit (RD)</option>
                                <option value="MIS" <?php echo e(old('deposit_type')=='mis' ? 'selected' : ''); ?>>Monthly Income
                                    Scheme (MIS)</option>
                            </select>
                            <?php $__errorArgs = ['deposit_type'];
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
                        <!-- Field wrapper end -->
                    </div>
                    <!----End part--->

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper" id="accountNumberFieldWrapper">
                            <div id="accountNumberLoading" class="form-control text-muted" style="display: none;">
                                Loading accounts...
                            </div>

                            <!-- Single account input (default) -->
                            <input class="form-control <?php $__errorArgs = ['deposit_account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="text" id="depositAccountNumberInput" name="deposit_account_number"
                                value="<?php echo e(old('deposit_account_number')); ?>" placeholder="Enter Deposit Account Number">

                            <!-- Dropdown for multiple accounts -->
                            <select class="form-control <?php $__errorArgs = ['deposit_account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="depositAccountNumberSelect" name="deposit_account_number" style="display: none;">
                            </select>

                            <div class="field-placeholder">Deposit Account Number <span class="text-danger">*</span>
                            </div>

                            <?php $__errorArgs = ['deposit_account_number'];
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


                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control <?php $__errorArgs = ['asset_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                id="assetValue" name="asset_value" value="" placeholder="Asset Value" readonly>
                            <div class="field-placeholder">Asset Value</div>
                            <?php $__errorArgs = ['asset_value'];
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
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control <?php $__errorArgs = ['asset_paid_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                id="assetPaidValue" name="asset_paid_value" value="" placeholder="Asset Paid Value"
                                readonly>
                            <div class="field-placeholder">Asset Paid Value</div>
                            <?php $__errorArgs = ['asset_paid_value'];
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
                        <!-- Field wrapper end -->
                    </div>


                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <div class="field-placeholder">Estimated approval amount</div>
                            <div class="field-value" id="loanApprovalAmount"></div>
                            <!-- Display loan approval amount -->
                        </div>
                    </div>
                    <!-- Minimum Amount -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control <?php $__errorArgs = ['minimum_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                id="requestedAmount" name="minimum_amount" value="<?php echo e(old('minimum_amount')); ?>"
                                placeholder="Enter Requested Amount">
                            <div class="field-placeholder">Requested Amount <span class="text-danger">*</span></div>
                            <?php $__errorArgs = ['minimum_amount'];
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
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <select class="form-control <?php $__errorArgs = ['emi_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="emiType"
                                name="emi_type">
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="annually">Annually</option>
                            </select>
                            <div class="field-placeholder">EMI Type</div>
                            <?php $__errorArgs = ['emi_type'];
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
                        <!-- Field wrapper end -->
                    </div>

                    <!-- Button: Check Amount & EMIs -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 d-flex align-items-end">
                        <div class="field-wrapper w-100">
                            <button type="button" class="btn btn-primary w-100" id="checkEmiButton">
                                <i class='bx bx-calculator'></i> Check Amount & EMIs
                            </button>
                        </div>
                    </div>


                    <div class="row gutters">

                        <!-- Loan Approval Amount (Calculated) -->
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <div class="field-placeholder">Loan Amount</div>
                                <div class="field-value" id="loanApprovalAmounts"></div>
                                <!-- Display loan approval amount -->
                            </div>
                        </div>

                        <!-- Interest Percentage (Calculated) -->
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <div class="field-placeholder">Interest Percentage</div>
                                <div class="field-value" id="interestPercentage"></div>
                                <!-- Display interest percentage -->
                            </div>
                        </div>

                        <!-- EMI Amount (Calculated) -->
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <div class="field-placeholder">EMI Amount</div>
                                <div class="field-value" id="emiAmount"></div>
                                <!-- Display calculated EMI amount -->
                            </div>
                        </div>

                        <!-- Number of EMIs (Calculated) -->
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <div class="field-placeholder">Number of EMIs</div>
                                <div class="field-value" id="emiCount"></div>
                                <!-- Display calculated number of EMIs -->
                            </div>
                        </div>

                        <!-- Total Payable Amount (Calculated) -->
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <div class="field-placeholder">Total Payable Amount</div>
                                <div class="field-value" id="payableAmount"></div>
                                <!-- Display total payable amount -->
                            </div>
                        </div>

                        <!-- Market Code -->
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <label for="market_code" class="field-placeholder">Market Code <span
                                        class="text-danger">*</span></label>
                                <select class="form-control <?php $__errorArgs = ['market_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="market_code"
                                    name="market_code">
                                    <option value="">Select Market Code</option>
                                    <?php $__currentLoopData = $marketCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $market): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($market->id); ?>"><?php echo e($market->code); ?> - <?php echo e($market->area_name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select required>
                                <?php $__errorArgs = ['market_code'];
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
                            <!-- Field wrapper end -->
                        </div>


                        <!-- Opening Date -->
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control <?php $__errorArgs = ['opeaning_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                    name="opeaning_date" value="<?php echo e(old('opeaning_date')); ?>" required>
                                <div class="field-placeholder">Application Date <span class="text-danger">*</span>
                                </div>
                                <?php $__errorArgs = ['opeaning_date'];
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
                            <!-- Field wrapper end -->
                        </div>
                    </div>




                </div>






            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div class="footer-left">
                <p class="text-muted mb-0 small">Need help? Contact our <a href="#" class="text-primary">support
                        team</a>.</p>
            </div>
            <div class="footer-right">

                <button class="btn btn-sm btn-outline-primary py-1 px-2" id="DDsubmitButton" type="submit">
                    <span class="icon-save2"></span>
                    <span id="DDbuttonText"> Submit Application </span>
                    <span id="DDloadingSpinner" class="spinner-border spinner-border-sm text-white d-none"
                        role="status">
                        <span class="visually-hidden">Creating...</span>
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
    new FormSubmitHandler('SAstore', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 for the dropdown
        $('#memberSelect').select2();

        // Attach the select2:select event
        $('#memberSelect').on('select2:select', function (e) {
            const selectedMemberId = e.params.data.id; // Get the selected member ID

            // Debugging: Show an alert or log the selected ID

            // Make an AJAX request to fetch member details
            if (selectedMemberId) {
                fetch(`/get-member-info/${selectedMemberId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Populate the fields with member details
                            document.getElementById('memberName').value = data.first_name + ' ' + data.last_name;
                            document.getElementById('memberCode').value = data.member_code;
                            document.getElementById('memberEmail').value = data.email;
                            document.getElementById('memberPhone').value = data.phone;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching member data:', error);
                    });
            } else {
                // Clear the input fields if no member is selected
                document.getElementById('memberName').value = '';
                document.getElementById('memberCode').value = '';
                document.getElementById('memberEmail').value = '';
                document.getElementById('memberPhone').value = '';
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const checkDetailsBtn = document.getElementById("checkDetailsBtn");
    const memberSelect = document.getElementById("member_id");
    const planSelect = document.getElementById("loan_plan_id");
    const amountInput = document.getElementById("loan_amount");

    // Function to toggle button visibility
    function toggleCheckButton() {
        if (memberSelect.value && planSelect.value && amountInput.value) {
            checkDetailsBtn.style.display = "block";
        } else {
            checkDetailsBtn.style.display = "none";
        }
    }

    // Listen for changes in fields
    [memberSelect, planSelect, amountInput].forEach(input => {
        input.addEventListener("change", toggleCheckButton);
        input.addEventListener("keyup", toggleCheckButton);
    });

    // Handle button click
    checkDetailsBtn.addEventListener("click", function () {
        const memberId = memberSelect.value;
        const loanPlanId = planSelect.value;
        const loanAmount = amountInput.value;

        fetch("/check-loan-eligibility", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ member_id: memberId, loan_plan_id: loanPlanId, loan_amount: loanAmount })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("eligibleAmount").innerText = data.eligible_amount;
                document.getElementById("emiAmount").innerText = data.emi_amount;
                document.getElementById("loanDetailsModal").style.display = "block";
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });
});

</script>

<!---get the account dtails -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const depositTypeSelect = document.getElementById('depositType');
    const memberSelect = document.getElementById('memberSelect');
    const planSelect = document.getElementById('savingsPlanSelect');

    const inputField = document.getElementById('depositAccountNumberInput');
    const selectField = document.getElementById('depositAccountNumberSelect');
    const loadingField = document.getElementById('accountNumberLoading');

    const assetValueInput = document.getElementById('assetValue');
    const assetPaidValueInput = document.getElementById('assetPaidValue');
    const loanApprovalAmountDiv = document.getElementById('loanApprovalAmount');

    function showLoading() {
        loadingField.style.display = 'block';
        inputField.style.display = 'none';
        selectField.style.display = 'none';
    }

    function hideLoading() {
        loadingField.style.display = 'none';
    }

    function showInputField(value = '') {
        inputField.value = value;
        inputField.style.display = 'block';
        selectField.style.display = 'none';
    }

    function showSelectField(accounts) {
        selectField.innerHTML = '';
        accounts.forEach(acc => {
            const option = document.createElement('option');
            option.value = acc;
            option.textContent = acc;
            selectField.appendChild(option);
        });
        selectField.style.display = 'block';
        inputField.style.display = 'none';
    }

    function fetchAccountNumber() {
        const memberId = memberSelect.value;
        const depositType = depositTypeSelect.value;

        if (!memberId || !depositType) return;

        showLoading();

        fetch(`/get-deposit-account/${memberId}/${depositType}`)
            .then(response => response.json())
            .then(data => {
                hideLoading();
                const accounts = data.accounts || [];

                if (accounts.length === 1) {
                    showInputField(accounts[0]);
                    // triggerAssetValueFetch(depositType, accounts[0], planSelect.value);
                } else if (accounts.length > 1) {
                    showSelectField(accounts);
                    // selectField.addEventListener('change', function () {
                    //     triggerAssetValueFetch(depositType, this.value, planSelect.value);
                    // });
                } else {
                    showInputField('');
                }

                // Trigger asset value fetch for the first account immediately
                if (accounts.length > 0) {
                    triggerAssetValueFetch(depositTypeSelect.value, accounts[0], planSelect.value);
                }

                //Also bind change listener
                selectField.onchange = function () {
                    triggerAssetValueFetch(depositTypeSelect.value, this.value, planSelect.value);
                };
            })
            .catch(error => {
                console.error('Error fetching account:', error);
                hideLoading();
                showInputField('');
            });
    }

    function triggerAssetValueFetch(depositType, accountNumber, planId) {
        if (!depositType || !accountNumber || !planId) return;

        fetch(`/get-asset-values?deposit_type=${depositType}&account_number=${accountNumber}&plan_id=${planId}`)
            .then(response => response.json())
            .then(data => {
                
                assetValueInput.value = data.asset_value || '';
                document.getElementById('assetPaidValue').value = data.asset_paid_value || '';
                document.getElementById('loanApprovalAmount').innerHTML = `₹ ${parseFloat(data.loan_approval_amount || 0).toFixed(2)}`;
            })
            .catch(error => {
                console.error('Error fetching asset values:', error);
            });
    }

    // Event bindings
    depositTypeSelect.addEventListener('change', fetchAccountNumber);
    // memberSelect.addEventListener('change', fetchAccountNumber);

});
</script>

<!---EMI calculation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkEmiButton = document.getElementById('checkEmiButton');
        const savingsPlanSelect = document.getElementById('savingsPlanSelect');
        const emiTypeSelect = document.getElementById('emiType');

        // Output fields
        const loanApprovalAmountDiv = document.getElementById('loanApprovalAmounts');
        const interestPercentageDiv = document.getElementById('interestPercentage');
        const emiAmountDiv = document.getElementById('emiAmount');
        const emiCountDiv = document.getElementById('emiCount');
        const payableAmountDiv = document.getElementById('payableAmount');

        checkEmiButton.addEventListener('click', function () {
            const planId = savingsPlanSelect.value;
            const emiType = emiTypeSelect.value;

            // Add requested loan amount input if needed
            const requestedAmount = document.getElementById('requestedAmount');

            if (!planId || !emiType) {
                alert('Please select both Plan and EMI Type');
                return;
            }

              // Show loading spinner on button
            const originalButtonHTML = checkEmiButton.innerHTML;
            checkEmiButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking...`;
            checkEmiButton.disabled = true;

            fetch('/check-emi-details', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        rd_plan_id: planId,
                        emi_type: emiType,
                        requested_amount: requestedAmount ? parseFloat(requestedAmount.value) : 0
                    })
                })

            .then(response => response.json())
            .then(data => {
                loanApprovalAmountDiv.textContent = `₹ ${data.loan_approval_amount}`;
                interestPercentageDiv.textContent = `${parseFloat(data.interest_percentage || 0).toFixed(2)}%`;
                emiAmountDiv.textContent = `₹ ${parseFloat(data.emi_amount || 0).toFixed(2)}`;
                emiCountDiv.textContent = data.emi_count || '0';
                payableAmountDiv.textContent = `₹ ${parseFloat(data.total_payable || 0).toFixed(2)}`;
            })
            .catch(error => {
                console.error('Error calculating EMI details:', error);
            })
            .finally(() => {
                // Restore button
                checkEmiButton.innerHTML = originalButtonHTML;
                checkEmiButton.disabled = false;
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accounts/createLoanADapplication.blade.php ENDPATH**/ ?>