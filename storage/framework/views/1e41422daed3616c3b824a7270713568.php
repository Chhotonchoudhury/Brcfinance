<?php $__env->startSection('title'); ?> Member Store <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Member</a></li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="<?php echo e(route('member.index')); ?>" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="<?php echo e(route('member.save', $member->id ?? '')); ?>" id="Memberstore" method="POST"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="card-body">
            


            <!-- General Info Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> General Info</div>
            </div>

            <!-- Row Start -->
            <div class="row gutters">
                <!-- Branch -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control js-states select2 <?php $__errorArgs = ['branch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="select2" name="branch_id">
                                <option value="" <?php echo e(old('branch_id', $member->branch_id ?? '') == '' ? 'selected' :
                                    ''); ?>>Select Branch</option>
                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(old('branch_id', $member->branch_id ?? '') ==
                                    $branch->id ? 'selected' : ''); ?>>
                                    <?php echo e($branch->branch_name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="field-placeholder">Branch <span class="text-danger">*</span></div>
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
                </div>

                <!-- Agent / Employee / assosiacre  -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="user_id">
                                <option value="" <?php echo e(old('user_id', $member->user_id ?? '') == '' ? 'selected' : ''); ?>>Select User</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id', $member->user_id ?? '') ==
                                    $user->id ? 'selected' : ''); ?>>
                                    <?php echo e($user->name); ?> (<?php echo e($user->user_type); ?>)
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="field-placeholder">Agent / Employee / assosiate</div>
                        <?php $__errorArgs = ['user_id'];
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

                <!-- Enrollment Date -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['enrollment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="enrollment_date"
                                value="<?php echo e(old('enrollment_date', $member->enrollment_date ?? '')); ?>">
                        </div>
                        <div class="field-placeholder">Enrollment Date <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['enrollment_date'];
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
                <!---application number--->
                <?php
                    $nextApplicationNumber = \App\Models\Memeber::getNextApplicationNumber();
                ?>
                
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['application_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="application_number"
                                value="<?php echo e(old('application_number', $nextApplicationNumber)); ?>" required>
                            <span class="input-group-text">
                                #
                            </span>
                        </div>
                        <div class="field-placeholder">Application Number <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['application_number'];
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
            <!-- Row End -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Title -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title">
                                <option value="" <?php echo e(old('title', $member->title ?? '') == '' ? 'selected' : ''); ?>>Select Title</option>
                                <option value="Mr" <?php echo e(old('title', $member->title ?? '') == 'Mr' ? 'selected' : ''); ?>>Mr</option>
                                <option value="Mrs" <?php echo e(old('title', $member->title ?? '') == 'Mrs' ? 'selected' : ''); ?>>Mrs</option>
                                <option value="Miss" <?php echo e(old('title', $member->title ?? '') == 'Miss' ? 'selected' :
                                    ''); ?>>Miss</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Title</div>
                        <?php $__errorArgs = ['title'];
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

                <!-- First Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="first_name" value="<?php echo e(old('first_name', $member->first_name ?? '')); ?>" required>
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">First Name <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['first_name'];
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

                <!-- Middle Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="middle_name" value="<?php echo e(old('middle_name', $member->middle_name ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Middle Name</div>
                        <?php $__errorArgs = ['middle_name'];
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

                <!-- Last Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="last_name" value="<?php echo e(old('last_name', $member->last_name ?? '')); ?>" required>
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Last Name <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['last_name'];
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

            <!-- Row Start -->
            <div class="row gutters">
                <!-- Gender -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="gender" required>
                                <option value="" <?php echo e(old('gender', $member->gender ?? '') == '' ? 'selected' : ''); ?>>Select Gender</option>
                                <option value="male" <?php echo e(old('gender', $member->gender ?? '') == 'male' ? 'selected'
                                    : ''); ?>>Male</option>
                                <option value="female" <?php echo e(old('gender', $member->gender ?? '') == 'female' ?
                                    'selected' : ''); ?>>Female</option>
                                <option value="other" <?php echo e(old('gender', $member->gender ?? '') == 'other' ?
                                    'selected' : ''); ?>>Other</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Gender <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['gender'];
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

                <!-- Date of Birth -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date"
                                name="date_of_birth"
                                value="<?php echo e(old('date_of_birth', isset($member) && $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d') : '')); ?>"
                                required>

                        </div>
                        <div class="field-placeholder">Date of Birth <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['date_of_birth'];
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

                <!-- Father's Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['father_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="father_name" value="<?php echo e(old('father_name', $member->father_name ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-person"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Father's Name</div>
                        <?php $__errorArgs = ['father_name'];
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

                <!-- Mother's Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['mother_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="mother_name" value="<?php echo e(old('mother_name', $member->mother_name ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-person"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Mother's Name</div>
                        <?php $__errorArgs = ['mother_name'];
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
            <!-- Row End -->

            <!-- New Fields Row -->
            <div class="row gutters">
                <!-- Occupation -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['occupation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="occupation" value="<?php echo e(old('occupation', $member->occupation ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-card_travel"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Occupation</div>
                        <?php $__errorArgs = ['occupation'];
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

                <!-- Monthly Income -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['monthly_income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="monthly_income"
                                value="<?php echo e(old('monthly_income', $member->monthly_income ?? '')); ?>">
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Monthly Income</div>
                        <?php $__errorArgs = ['monthly_income'];
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

                <!-- Annual Income -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['annual_income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number"
                                step="0.01" name="annual_income"
                                value="<?php echo e(old('annual_income', $member->annual_income ?? '')); ?>">

                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Annual Income</div>
                        <?php $__errorArgs = ['annual_income'];
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



                <!-- Ex-Service Person -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['ex_service_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="checkbox" id="ex_service_person" name="ex_service_person" value="1" <?php echo e(old('ex_service_person', $member->ex_service_person ?? '') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="ex_service_person">Ex-Service Person</label>
                            </div>
                        </div>
                        <?php $__errorArgs = ['ex_service_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="field-placeholder">Ex-Service Person</div>
                    </div>
                    <!-- Field wrapper end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- New Fields Row -->
            <div class="row gutters">

                <!-- Marital Status -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="radio" id="single" name="marital_status" value="single" <?php echo e(old('marital_status', $member->marital_status ?? '') == 'single' ? 'checked' :
                                ''); ?>>
                                <label class="form-check-label" for="single">Single</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="radio" id="married" name="marital_status" value="married" <?php echo e(old('marital_status', $member->marital_status ?? '') == 'married' ? 'checked' :
                                ''); ?>>
                                <label class="form-check-label" for="married">Married</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="radio" id="divorced" name="marital_status" value="divorced" <?php echo e(old('marital_status', $member->marital_status ?? '') == 'divorced' ? 'checked' :
                                ''); ?>>
                                <label class="form-check-label" for="divorced">Divorced</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="radio" id="widowed" name="marital_status" value="widowed" <?php echo e(old('marital_status', $member->marital_status ?? '') == 'widowed' ? 'checked' :
                                ''); ?>>
                                <label class="form-check-label" for="widowed">Widowed</label>
                            </div>
                        </div>
                        <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="field-placeholder">Marital Status</div>
                    </div>
                    <!-- Field wrapper end -->
                </div>


                <!-- Husband/Spouse Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['husband_spouse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="husband_spouse"
                                value="<?php echo e(old('husband_spouse', $member->husband_spouse ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-person"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Husband/Spouse Name</div>
                        <?php $__errorArgs = ['husband_spouse'];
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

            <!-- General Info Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Phone & Email</div>
            </div>

            <!-- Email and Mobile Activation -->
            <div class="row gutters">

                <!-- Mobile Number -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['mobile_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="mobile_number" value="<?php echo e(old('mobile_number', $member->mobile_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-phone"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Mobile Number</div>
                        <?php $__errorArgs = ['mobile_number'];
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

                <!-- Mobile Active Checkbox -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['mobile_is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="checkbox" id="mobile_is_active" name="mobile_is_active" <?php echo e(old('mobile_is_active', $member->mobile_is_active ?? true) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="mobile_is_active">Mobile Active</label>
                            </div>
                        </div>
                        <?php $__errorArgs = ['mobile_is_active'];
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


                <!-- Email Address -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email" name="email"
                                value="<?php echo e(old('email', $member->email ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-mail"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Email Address</div>
                        <?php $__errorArgs = ['email'];
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

                <!-- Email Active Checkbox -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input <?php $__errorArgs = ['email_is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="checkbox" id="email_is_active" name="email_is_active" <?php echo e(old('email_is_active', $member->email_is_active ?? true) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="email_is_active">Email Active</label>
                            </div>
                        </div>
                        <?php $__errorArgs = ['email_is_active'];
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

            <!-- General Info Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Identification Info</div>
            </div>


            <!-- Aadhaar, Voter ID, PAN, Ration Card, Meter, CI, and DL Number in Same Row -->
            <div class="row gutters">
                <!-- Aadhaar Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['aadhaar_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="aadhaar_number"
                                value="<?php echo e(old('aadhaar_number', $member->aadhaar_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Aadhaar Number</div>
                        <?php $__errorArgs = ['aadhaar_number'];
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

                <!-- Voter ID -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['voter_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="voter_id" value="<?php echo e(old('voter_id', $member->voter_id ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Voter ID</div>
                        <?php $__errorArgs = ['voter_id'];
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

                <!-- PAN Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['pan_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="pan_number" value="<?php echo e(old('pan_number', $member->pan_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">PAN Number</div>
                        <?php $__errorArgs = ['pan_number'];
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

                <!-- Ration Card Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['ration_card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="ration_card_number"
                                value="<?php echo e(old('ration_card_number', $member->ration_card_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Ration Card Number</div>
                        <?php $__errorArgs = ['ration_card_number'];
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
                <!-- Meter Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['meter_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="meter_number" value="<?php echo e(old('meter_number', $member->meter_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Meter Number</div>
                        <?php $__errorArgs = ['meter_number'];
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

                <!-- CI Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['ci_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="ci_number" value="<?php echo e(old('ci_number', $member->ci_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-info"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">CI Number</div>
                        <?php $__errorArgs = ['ci_number'];
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

                <!-- CI Relation -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['ci_relation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="ci_relation" value="<?php echo e(old('ci_relation', $member->ci_relation ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">CI Relation</div>
                        <?php $__errorArgs = ['ci_relation'];
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

                <!-- Driving License Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control <?php $__errorArgs = ['dl_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="dl_number" value="<?php echo e(old('dl_number', $member->dl_number ?? '')); ?>">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Driving License Number</div>
                        <?php $__errorArgs = ['dl_number'];
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
            <!-- Correspondence Address Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Correspondence Address</div>
            </div>

            <!-- Correspondence Address Fields -->
            <div class="row gutters">
                <!-- Address Line 1 (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text"
                            class="form-control <?php $__errorArgs = ['correspondence_address_line1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="correspondence_address_line1" required
                            value="<?php echo e(old('correspondence_address_line1', $member->correspondence_address_line1 ?? '')); ?>">
                        <div class="field-placeholder">Address Line 1 <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['correspondence_address_line1'];
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

                <!-- Address Line 2 -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text"
                            class="form-control <?php $__errorArgs = ['correspondence_address_line2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="correspondence_address_line2"
                            value="<?php echo e(old('correspondence_address_line2', $member->correspondence_address_line2 ?? '')); ?>">
                        <div class="field-placeholder">Address Line 2</div>
                        <?php $__errorArgs = ['correspondence_address_line2'];
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

                <!-- Para -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['para'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="para"
                            value="<?php echo e(old('para', $member->para ?? '')); ?>">
                        <div class="field-placeholder">Para</div>
                        <?php $__errorArgs = ['para'];
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

                <!-- Panchayat -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['panchayat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="panchayat" value="<?php echo e(old('panchayat', $member->panchayat ?? '')); ?>">
                        <div class="field-placeholder">Panchayat</div>
                        <?php $__errorArgs = ['panchayat'];
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
                <!-- Ward -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['ward'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="ward"
                            value="<?php echo e(old('ward', $member->ward ?? '')); ?>">
                        <div class="field-placeholder">Ward</div>
                        <?php $__errorArgs = ['ward'];
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

                <!-- Area -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="area"
                            value="<?php echo e(old('area', $member->area ?? '')); ?>">
                        <div class="field-placeholder">Area</div>
                        <?php $__errorArgs = ['area'];
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

                <!-- Landmark (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['landmark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="landmark"
                            required value="<?php echo e(old('landmark', $member->landmark ?? '')); ?>">
                        <div class="field-placeholder">Landmark <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['landmark'];
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

                <!-- City (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city" required
                            value="<?php echo e(old('city', $member->city ?? '')); ?>">
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

            <div class="row gutters">
                <!-- State (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="state"
                            required value="<?php echo e(old('state', $member->state ?? '')); ?>">
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

                <!-- Pincode (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pincode"
                            required value="<?php echo e(old('pincode', $member->pincode ?? '')); ?>">
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

                <!-- Country (disabled) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control" name="country" value="India" readonly>
                        <div class="field-placeholder">Country</div>
                    </div>
                </div>
            </div>


            <!-- Permanent Address Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Permanent Address</div>
            </div>

            <!-- Permanent Address Fields -->
            <div class="row gutters">
                <!-- Permanent Address Line 1 (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['permanent_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="permanent_address"
                            value="<?php echo e(old('permanent_address', $member->permanent_address ?? '')); ?>" required>
                        <div class="field-placeholder">Permanent Address *</div>
                        <?php $__errorArgs = ['permanent_address'];
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

                <!-- Permanent City -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['permanent_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="permanent_city" value="<?php echo e(old('permanent_city', $member->permanent_city ?? '')); ?>">
                        <div class="field-placeholder">Permanent City</div>
                        <?php $__errorArgs = ['permanent_city'];
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

                <!-- Permanent State (Required) -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['permanent_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="permanent_state" value="<?php echo e(old('permanent_state', $member->permanent_state ?? '')); ?>"
                            required>
                        <div class="field-placeholder">Permanent State *</div>
                        <?php $__errorArgs = ['permanent_state'];
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

                <!-- Permanent Pincode (Required) -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['permanent_pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="permanent_pincode"
                            value="<?php echo e(old('permanent_pincode', $member->permanent_pincode ?? '')); ?>" required>
                        <div class="field-placeholder">Permanent Pincode *</div>
                        <?php $__errorArgs = ['permanent_pincode'];
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

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="form-check">
                            <input class="form-check-input <?php $__errorArgs = ['use_as_communication_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="checkbox" id="use_as_communication_address" name="use_as_communication_address" <?php echo e(old('use_as_communication_address', $member->use_as_communication_address ?? false) ?
                            'checked' : ''); ?>>
                            <label class="form-check-label" for="use_as_communication_address">Use as Communication
                                Address</label>
                        </div>
                        <?php $__errorArgs = ['use_as_communication_address'];
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

            <!-- Address Geolocation Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Address Geolocation</div>
            </div>

            <!-- Address Geolocation Fields -->
            <div class="row gutters">
                <!-- Latitude -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['address_latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="address_latitude"
                            value="<?php echo e(old('address_latitude', $member->address_latitude ?? '')); ?>">
                        <div class="field-placeholder">Latitude</div>
                        <?php $__errorArgs = ['address_latitude'];
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

                <!-- Longitude -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['address_longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="address_longitude"
                            value="<?php echo e(old('address_longitude', $member->address_longitude ?? '')); ?>">
                        <div class="field-placeholder">Longitude</div>
                        <?php $__errorArgs = ['address_longitude'];
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

            <!-- Nominee Details Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Nominee Details</div>
            </div>

            <!-- Nominee Details Fields -->
            <div class="row gutters">
                <!-- Nominee Name (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_name" required value="<?php echo e(old('nominee_name', $member->nominee_name ?? '')); ?>">
                        <div class="field-placeholder">Nominee Name <span class="text-danger">*</span></div>
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

                <!-- Nominee Relation (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_relation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_relation" required
                            value="<?php echo e(old('nominee_relation', $member->nominee_relation ?? '')); ?>">
                        <div class="field-placeholder">Nominee Relation <span class="text-danger">*</span></div>
                        <?php $__errorArgs = ['nominee_relation'];
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

                <!-- Nominee Mobile Number (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_mobile_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_mobile_number" required
                            value="<?php echo e(old('nominee_mobile_number', $member->nominee_mobile_number ?? '')); ?>">
                        <div class="field-placeholder">Nominee Mobile Number <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['nominee_mobile_number'];
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

                <!-- Nominee Aadhaar Number (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_aadhaar_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_aadhaar_number" required
                            value="<?php echo e(old('nominee_aadhaar_number', $member->nominee_aadhaar_number ?? '')); ?>">
                        <div class="field-placeholder">Nominee Aadhaar Number <span class="text-danger">*</span>
                        </div>
                        <?php $__errorArgs = ['nominee_aadhaar_number'];
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
                <!-- Nominee Voter ID -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_voter_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_voter_id"
                            value="<?php echo e(old('nominee_voter_id', $member->nominee_voter_id ?? '')); ?>">
                        <div class="field-placeholder">Nominee Voter ID</div>
                        <?php $__errorArgs = ['nominee_voter_id'];
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

                <!-- Nominee PAN Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_pan_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_pan_number"
                            value="<?php echo e(old('nominee_pan_number', $member->nominee_pan_number ?? '')); ?>">
                        <div class="field-placeholder">Nominee PAN Number</div>
                        <?php $__errorArgs = ['nominee_pan_number'];
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

                <!-- Nominee Ration Card Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text"
                            class="form-control <?php $__errorArgs = ['nominee_ration_card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_ration_card_number"
                            value="<?php echo e(old('nominee_ration_card_number', $member->nominee_ration_card_number ?? '')); ?>">
                        <div class="field-placeholder">Nominee Ration Card Number</div>
                        <?php $__errorArgs = ['nominee_ration_card_number'];
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

                <!-- Nominee Address -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['nominee_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="nominee_address" value="<?php echo e(old('nominee_address', $member->nominee_address ?? '')); ?>">
                        <div class="field-placeholder">Nominee Address</div>
                        <?php $__errorArgs = ['nominee_address'];
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


            <!-- Bank Details Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Bank Details</div>
            </div>

            <!-- Bank Details Fields -->
            <div class="row gutters">
                <!-- Bank Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['bank_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="bank_name" value="<?php echo e(old('bank_name', $member->bank_name ?? '')); ?>">
                        <div class="field-placeholder">Bank Name</div>
                        <?php $__errorArgs = ['bank_name'];
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

                <!-- Bank Code -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['bank_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="bank_code" value="<?php echo e(old('bank_code', $member->bank_code ?? '')); ?>">
                        <div class="field-placeholder">Bank Code</div>
                        <?php $__errorArgs = ['bank_code'];
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

                <!-- Account Type -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <select class="form-control <?php $__errorArgs = ['account_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="account_type">
                            <option value="" disabled selected>Select Account Type</option>
                            <option value="savings" <?php echo e(old('account_type', $member->account_type ?? '') == 'savings'
                                ? 'selected' : ''); ?>>Savings</option>
                            <option value="current" <?php echo e(old('account_type', $member->account_type ?? '') == 'current'
                                ? 'selected' : ''); ?>>Current</option>
                        </select>
                        <div class="field-placeholder">Account Type</div>
                        <?php $__errorArgs = ['account_type'];
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

                <!-- Account Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="account_number" value="<?php echo e(old('account_number', $member->account_number ?? '')); ?>">
                        <div class="field-placeholder">Account Number</div>
                        <?php $__errorArgs = ['account_number'];
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
                <!-- IFSC Code -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['ifsc_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="ifsc_code" value="<?php echo e(old('ifsc_code', $member->ifsc_code ?? '')); ?>">
                        <div class="field-placeholder">IFSC Code</div>
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

                <!-- Branch Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control <?php $__errorArgs = ['branch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="branch_name" value="<?php echo e(old('branch_name', $member->branch_name ?? '')); ?>">
                        <div class="field-placeholder">Branch Name</div>
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
            </div>
            <div class="row gutters">
                <!-- Alerts and Notifications Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Alerts and Notifications</div>
                </div>

                <!-- SMS Alerts -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="form-check">
                            <input class="form-check-input <?php $__errorArgs = ['enable_sms_alert'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="checkbox" id="enable_sms_alert" name="enable_sms_alert" <?php echo e(old('enable_sms_alert',
                                $member->enable_sms_alert ?? true) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="enable_sms_alert">Enable SMS Alerts</label>
                        </div>
                        <?php $__errorArgs = ['enable_sms_alert'];
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
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status">
                            <option value="active" <?php echo e(old('status', $member->status ?? '') == 'active' ? 'selected'
                                : ''); ?>>Active</option>
                            <option value="inactive" <?php echo e(old('status', $member->status ?? '') == 'inactive' ?
                                'selected'
                                : ''); ?>>Inactive</option>
                        </select>
                        <div class="field-placeholder">Member Account Status</div>
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

            <div class="row gutters">
                <!-- Document Uploads Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header"><?php if(isset($member->id)): ?> Update <?php endif; ?> Document Uploads</div>
                </div>

                <!-- Photo -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="photo"
                            accept="image/*">
                        <div class="field-placeholder">Photo</div>
                        <?php $__errorArgs = ['photo'];
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

                <!-- Signature -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control <?php $__errorArgs = ['signature'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="signature" accept="image/*">
                        <div class="field-placeholder">Signature</div>
                        <?php $__errorArgs = ['signature'];
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

                <!-- Driving License -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control <?php $__errorArgs = ['driving_license'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="driving_license" accept="image/*">
                        <div class="field-placeholder">Driving License</div>
                        <?php $__errorArgs = ['driving_license'];
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

                <!-- PAN Card -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control <?php $__errorArgs = ['pan_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="pan_card"
                            accept="image/*">
                        <div class="field-placeholder">PAN Card</div>
                        <?php $__errorArgs = ['pan_card'];
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

                <!-- Aadhaar Card -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control <?php $__errorArgs = ['aadhar_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="aadhar_card" accept="image/*">
                        <div class="field-placeholder">Aadhaar Card</div>
                        <?php $__errorArgs = ['aadhar_card'];
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

            <?php if(!isset($member)): ?>
            <!-- Row start -->
            <div class="row gutters">
                <!-- Form Section Header -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Uploading Center (optional)</div>
                </div>
            </div>
            <!-- Row start -->
            <div class="row gutters">
                <!-- Document Type & File Upload (initial row) -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="document-section">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <!-- Document Type Input -->
                            <input class="form-control <?php $__errorArgs = ['document_type[]'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="document_type[]" placeholder="Document Type">
                            <span class="input-group-text">
                                <i class="icon-file"></i>
                            </span>
                            <!-- File Upload Input -->
                            <input class="form-control <?php $__errorArgs = ['document[]'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="file"
                                name="document[]">
                            <button type="button" id="add-document" class="btn btn-outline-primary btn-sm"
                                style="margin-left: 10px;">+</button>
                        </div>
                        <?php $__errorArgs = ['document_type[]'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['document[]'];
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
            <?php endif; ?>




        </div>
        <!-- Card body end -->

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="MsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="MbuttonText"><?php if(isset($member->id)): ?> Update <?php else: ?> Submit <?php endif; ?> </span>
                <span id="MloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
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
    // JavaScript to dynamically add/remove document fields
    document.getElementById('add-document').addEventListener('click', function() {
        // Create a new row for document type and file input
        const newDocumentField = document.createElement('div');
        newDocumentField.classList.add('col-xl-12', 'col-lg-12', 'col-md-12', 'col-sm-12', 'col-12');
        newDocumentField.innerHTML = `
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="text" name="document_type[]" placeholder="Document Type" required>
                    <span class="input-group-text">
                        <i class="icon-file"></i>
                    </span>
                    <input class="form-control" type="file" name="document[]" required>
                    <!-- Remove Button -->
                    <button type="button" class="btn btn-danger remove-document btn-sm" style="margin-left: 10px;">-</button>
                </div>
            </div>
        `;
        
        // Append the new document field to the document section
        document.getElementById('document-section').appendChild(newDocumentField);
    
        // Attach event listener to the remove button for the newly added row
        newDocumentField.querySelector('.remove-document').addEventListener('click', function() {
            newDocumentField.remove();
        });
    });
</script>



<script>
    //
    new FormSubmitHandler('Memberstore', 'MsubmitButton', 'MbuttonText', 'MloadingSpinner');
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Select the monthly income and annual income input fields
    const monthlyIncomeInput = document.querySelector("input[name='monthly_income']");
    const annualIncomeInput = document.querySelector("input[name='annual_income']");

    // Add an event listener to the monthly income input field
    monthlyIncomeInput.addEventListener('input', function () {
        // Get the value of the monthly income input
        const monthlyIncome = parseFloat(monthlyIncomeInput.value);

        // Check if the monthly income is a valid number
        if (!isNaN(monthlyIncome)) {
            // Calculate the annual income (monthly income * 12)
            const annualIncome = monthlyIncome * 12;

            // Set the value of the annual income input field
            annualIncomeInput.value = annualIncome.toFixed(2);
        } else {
            // If the input is invalid, clear the annual income field
            annualIncomeInput.value = '';
        }
    });
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/members/storeFrom.blade.php ENDPATH**/ ?>