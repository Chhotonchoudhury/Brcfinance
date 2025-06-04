
<?php $__env->startSection('title'); ?> Savings Account Create <?php $__env->stopSection(); ?>

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
</style>
<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Savings Account</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('sa.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
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
            <h5 class="card-title mb-0">Create New Account</h5>
            <p class="text-muted small mb-0">Fill in the form below to create a new account</p>
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


    <form action="<?php echo e(route('sa.store')); ?>" id="SAstore" method="POST">
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
                                    name="member_id" id="memberSelect">
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
                                name="branch_id">
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
                            <select class="select-single js-states <?php $__errorArgs = ['savings_plan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="savings_plan_id" id="savingsPlanSelect">
                                <option selected>Select Plan</option>
                                <?php $__currentLoopData = $savingsPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plan->id); ?>" <?php echo e(old('savings_plan_id')==$plan->id ? 'selected' :
                                    ''); ?>>
                                    <?php echo e($plan->plan_name); ?> #<?php echo e($plan->plan_code); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="field-placeholder">Plans <span class="text-danger">*</span></div>
                        </div>
                        <?php $__errorArgs = ['savings_plan_id'];
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

                    <!-- Agents / Eomplyee Select -->
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

                <div class="row gutters">
                    <!-- Minimum Amount -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
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
                                id="minimumAmount" name="minimum_amount" value="<?php echo e(old('minimum_amount')); ?>"
                                placeholder="Enter Minimum Amount">
                            <div class="field-placeholder">Minimum Amount <span class="text-danger">*</span></div>
                            <div id="minimumAmountMessage"
                                class="form-text d-none p-2 bg-light border rounded text-danger shadow-sm">
                                Minimum amount :- <span id="minimumAmountValue" style="font-weight: bold;"></span>
                                required to open the account.
                            </div>
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

                    <!-- Opening Date -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
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
                                name="opeaning_date" value="<?php echo e(old('opeaning_date')); ?>">
                            <div class="field-placeholder">Opening Date <span class="text-danger">*</span> </div>
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

                    <!-- Transaction Date -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control <?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="transaction_date" value="<?php echo e(old('transaction_date')); ?>">
                            <div class="field-placeholder">Transaction Date <span class="text-danger">*</span>
                            </div>
                            <?php $__errorArgs = ['transaction_date'];
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



                <!-- Toggle Switch Row -->
                <div class="row gutters">
                    <!-- Open Account with Less Minimum Balance -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Open account with less minimum balance</label>
                            <label class="form-switch">
                                <input type="hidden" name="opened_with_less_minimum" value="0">
                                <input type="checkbox" name="opened_with_less_minimum" value="1"
                                    id="openedWithLessMinimum" <?php echo e(old('opened_with_less_minimum') ? 'checked' : ''); ?>>
                                <span class="form-switch-slider"></span>

                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- Account on Hold -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Account on hold</label>
                            <label class="form-switch">
                                <input type="hidden" name="account_on_hold" value="0">
                                <input type="checkbox" name="account_on_hold" id="accountOnHold" value="1" <?php echo e(old('account_on_hold') ? 'checked' : ''); ?>>
                                <span class="form-switch-slider"></span>

                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- Joint Account -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Joint Account</label>
                            <label class="form-switch">
                                <input type="hidden" name="is_joint_account" value="0">
                                <input type="checkbox" name="is_joint_account" id="hasJoint" value="1" <?php echo e(old('is_joint_account') ? 'checked' : ''); ?>>
                                <span class="form-switch-slider"></span>

                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- Nominee -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Nominee</label>
                            <label class="form-switch">
                                <input type="hidden" name="has_nominee" value="0">
                                <input type="checkbox" name="has_nominee" id="hasNominee" value="1" <?php echo e(old('has_nominee') ? 'checked' : ''); ?>>
                                <span class="form-switch-slider"></span>
                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>
                </div>


                <!-- Joint member section  -->
                <div id="joininfoSection" style="display: none;">
                    <div class="row gutters ">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                            <div class="form-section-header">Joint Account Memebr</div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <div class="">
                                    <select
                                        class="select-single js-states <?php $__errorArgs = ['joint_member_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="joint_member_id" id="joint_member_id">
                                        <option value="" selected>Select Member</option>
                                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($member->id); ?>" <?php echo e(old('joint_member_id')==$member->id ?
                                            'selected' : ''); ?>>
                                            <?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="field-placeholder">Joint Member <span class="text-danger">*</span>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['joint_member_id'];
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
                                <input class="form-control" type="text" id="JMemberName" readonly>
                                <div class="field-placeholder">Member Name <span class="text-danger">*</span></div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" id="JMemberCode" readonly>
                                <div class="field-placeholder">Member Code <span class="text-danger">*</span></div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" id="JMemberPhone" readonly>
                                <div class="field-placeholder">Member Phone<span class="text-danger">*</span></div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>

                    </div>
                </div>

                <!-- Nominee info -->
                <div id="nomineeInfoSection" style="display: none;">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Nominee Information</div>
                    </div>
                    <div class="row gutters">

                        <!-- Relationship -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <select class="form-control <?php $__errorArgs = ['relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="relationship" id="relationship">
                                    <option selected disabled>Select Relationship</option>
                                    <option value="spouse" <?php echo e(old('relationship')=='spouse' ? 'selected' : ''); ?>>
                                        Spouse
                                    </option>
                                    <option value="parent" <?php echo e(old('relationship')=='parent' ? 'selected' : ''); ?>>
                                        Parent
                                    </option>
                                    <option value="child" <?php echo e(old('relationship')=='child' ? 'selected' : ''); ?>>Child
                                    </option>
                                    <option value="sibling" <?php echo e(old('relationship')=='sibling' ? 'selected' : ''); ?>>
                                        Sibling
                                    </option>
                                    <option value="other" <?php echo e(old('relationship')=='other' ? 'selected' : ''); ?>>Other
                                    </option>
                                </select>
                                <div class="field-placeholder">Relationship <span class="text-danger">*</span></div>
                                <?php $__errorArgs = ['relationship'];
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

                        <!-- Full Name -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control <?php $__errorArgs = ['nominee_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                    name="nominee_name" value="<?php echo e(old('nominee_name')); ?>" id="nomineeName"
                                    placeholder="Enter full name">
                                <div class="field-placeholder">Full Name <span class="text-danger">*</span></div>
                                <?php $__errorArgs = ['nominee_name'];
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

                        <!-- Aadhar Number -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control <?php $__errorArgs = ['aadhar_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                    name="aadhar_number" value="<?php echo e(old('aadhar_number')); ?>" id="aadharNumber"
                                    placeholder="Enter Aadhar number">
                                <div class="field-placeholder">Aadhar Number</div>
                                <?php $__errorArgs = ['aadhar_number'];
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

                        <!-- Voter ID Number -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control <?php $__errorArgs = ['voter_id_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                    name="voter_id_number" value="<?php echo e(old('voter_id_number')); ?>" id="voterIdNumber"
                                    placeholder="Enter Voter ID number">
                                <div class="field-placeholder">Voter ID Number</div>
                                <?php $__errorArgs = ['voter_id_number'];
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

                        <!-- Phone Number -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                    name="phone_number" value="<?php echo e(old('phone_number')); ?>" id="phoneNumber"
                                    placeholder="Enter phone number">
                                <div class="field-placeholder">Phone Number</div>
                                <?php $__errorArgs = ['phone_number'];
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

                        <!-- Full Address -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address"
                                    id="address" rows="3"
                                    placeholder="Enter full address"><?php echo e(old('address')); ?></textarea>
                                <div class="field-placeholder">Full Address</div>
                                <?php $__errorArgs = ['address'];
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


                <!-- Payment Information Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Payment Information</div>
                </div>

                <div class="row gutters mb-1">
                    <!-- Payment Mode -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <select class="form-control <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paymentMode"
                                name="payment_mode">
                                <option value="" selected disabled>Select Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online">Online</option>
                            </select>
                            <div class="field-placeholder">Payment Mode <span class="text-danger">*</span></div>
                            <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <!-- Field wrapper end -->
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12">
                        <div class="form-text p-3 bg-light border rounded text-success shadow-sm"
                            style="font-weight: bold;">
                            Payable Balance Must Be: <span id="payableValue" class="fs-6 mb-2"> 0</span>/-
                        </div>
                    </div>
                </div>

                <!-- Cash Section -->
                <div id="cashSection" style="display: none;">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-section-header">Cash Denominations</div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_1">
                                <div class="field-placeholder">₹1 Notes</div>
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_5">
                                <div class="field-placeholder">₹5 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_10">
                                <div class="field-placeholder">₹10 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_20">
                                <div class="field-placeholder">₹20 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_50">
                                <div class="field-placeholder">₹50 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_100">
                                <div class="field-placeholder">₹100 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_200">
                                <div class="field-placeholder">₹200 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_500">
                                <div class="field-placeholder">₹500 Notes</div>
                            </div>
                        </div>
                        <!-- Add other cash inputs similarly -->
                    </div>
                </div>

                <!-- Cheque Section -->
                <div id="chequeSection" style="display: none;">
                    <div class="row gutters">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="cheque_number">
                                <div class="field-placeholder">Cheque Number</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="bank_name">
                                <div class="field-placeholder">Bank Name</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="branch_name">
                                <div class="field-placeholder">Branch Name</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="date" name="cheque_date">
                                <div class="field-placeholder">Cheque Date</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Online Section -->
                <div id="onlineSection" style="display: none;">
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="online_transaction_id">
                                <div class="field-placeholder">Transaction ID</div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="payment_gateway">
                                <div class="field-placeholder">Payment Gateway / Platfrom</div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="field-wrapper">
                                <textarea class="form-control" name="remarks" rows="3"
                                    placeholder="Details About the Transactiron"></textarea>
                                <div class="field-placeholder">Remarks</div>
                            </div>
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
                    <span id="DDbuttonText"> Create </span>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 for the dropdown
        $('#joint_member_id').select2();

        // Attach the select2:select event
        $('#joint_member_id').on('select2:select', function (e) {
            const MemberId = e.params.data.id; // Get the selected member ID

            // Make an AJAX request to fetch member details
            if (MemberId) {
                fetch(`/get-member-info/${MemberId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                        
                            // Populate the fields with member details
                            document.getElementById('JMemberName').value = data.first_name + ' ' + data.last_name;
                            document.getElementById('JMemberCode').value = data.member_code;
                            document.getElementById('JMemberPhone').value = data.phone;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching member data:', error);
                    });
            } else {
                // Clear the input fields if no member is selected
                document.getElementById('JMemberName').value = '';
                document.getElementById('JMemberCode').value = '';
                document.getElementById('JMemberPhone').value = '';
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 for the plan dropdown
        $('#savingsPlanSelect').select2();

        // Attach event listener for when a plan is selected
        $('#savingsPlanSelect').on('select2:select', function (e) {
            const selectedPlanId = e.params.data.id;

            // Make an AJAX request to fetch plan details
            if (selectedPlanId) {
                fetch(`/get-plan-info/${selectedPlanId}`)
                    .then(response => response.json())
                    .then(data => {
                        
                        if (data && data.minimum_amount) {
                            // Update the minimum amount field and message
                            document.getElementById('minimumAmount').value = data.minimum_amount;
                            document.getElementById('minimumAmountValue').textContent = data.minimum_amount;
                            document.getElementById('payableValue').textContent = data.minimum_amount;
                            document.getElementById('minimumAmountMessage').classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching plan data:', error);
                    });
            } else {
                // Clear the minimum amount field and hide the message
                document.getElementById('minimumAmount').value = '';
                document.getElementById('minimumAmountValue').textContent = '';
                document.getElementById('payableValue').textContent = '';
                document.getElementById('minimumAmountMessage').classList.add('d-none');
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const hasNomineeCheckbox = document.getElementById("hasNominee");
    const nomineeInfoSection = document.getElementById("nomineeInfoSection");

    const hasJointCheckbox = document.getElementById("hasJoint");
    const jointInfoSection = document.getElementById("joininfoSection");

    // Function to toggle the visibility of the Nominee Information section
    const toggleNomineeSection = () => {
        if (hasNomineeCheckbox.checked) {
            nomineeInfoSection.style.display = "block";
        } else {
            nomineeInfoSection.style.display = "none";
        }
    };

     // Function to toggle the visibility of the Nominee Information section
     const toggleJointSection = () => {
        if (hasJointCheckbox.checked) {
            jointInfoSection.style.display = "block";
        } else {
            jointInfoSection.style.display = "none";
        }
    };

    // Initialize visibility based on checkbox state
    toggleNomineeSection();
    toggleJointSection();

    // Add event listener for checkbox changes
    hasNomineeCheckbox.addEventListener("change", toggleNomineeSection);
    hasJointCheckbox.addEventListener("change", toggleJointSection);
  });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const hasNomineeCheckbox = document.getElementById("hasNominee");
    const nomineeInfoSection = document.getElementById("nomineeInfoSection");

    

    // Function to toggle the visibility of the Nominee Information section
    const toggleNomineeSection = () => {
        nomineeInfoSection.style.display = hasNomineeCheckbox.checked ? "block" : "none";
    };

    // Function to toggle the visibility of the Joint Member section
    const toggleJointSection = () => {
        jointInfoSection.style.display = hasJointCheckbox.checked ? "block" : "none";
    };

    // Initialize visibility based on checkbox states
    toggleNomineeSection();
    toggleJointSection();

    // Add event listeners for checkbox changes
    hasNomineeCheckbox.addEventListener("change", toggleNomineeSection);
    hasJointCheckbox.addEventListener("change", toggleJointSection);
  });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const paymentModeSelect = document.getElementById("paymentMode");
        const cashSection = document.getElementById("cashSection");
        const chequeSection = document.getElementById("chequeSection");
        const onlineSection = document.getElementById("onlineSection");

        // Function to toggle sections based on payment mode
        const togglePaymentSections = () => {
            const selectedMode = paymentModeSelect.value;

            // Hide all sections
            cashSection.style.display = "none";
            chequeSection.style.display = "none";
            onlineSection.style.display = "none";

            // Show the relevant section
            if (selectedMode === "cash") {
                cashSection.style.display = "block";
            } else if (selectedMode === "cheque") {
                chequeSection.style.display = "block";
            } else if (selectedMode === "online") {
                onlineSection.style.display = "block";
            }
        };

        // Add event listener to dropdown
        paymentModeSelect.addEventListener("change", togglePaymentSections);

        // Initialize visibility on page load
        togglePaymentSections();
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const minimumAmountInput = document.getElementById("minimumAmount");
        const payableValueSpan = document.getElementById("payableValue");

        // Function to update the payable value dynamically
        const updatePayableValue = () => {
            const minimumAmount = parseFloat(minimumAmountInput.value) || 0; // Default to 0 if input is empty or invalid
            payableValueSpan.textContent = minimumAmount.toFixed(2); // Format to 2 decimal places
        };

        // Add event listener to the minimum amount input field
        minimumAmountInput.addEventListener("input", updatePayableValue);

        // Initialize payable value on page load
        updatePayableValue();
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accounts/SavingACForm.blade.php ENDPATH**/ ?>