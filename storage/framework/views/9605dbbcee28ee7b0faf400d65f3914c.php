

<?php $__env->startSection('title'); ?> Member Profile <?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th,
    .table-custom td {
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: left;
    }

    .table-custom th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .account-type {
        background-color: #f0f8ff;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 5px;
        text-align: center;
        font-weight: bold;
        font-size: 1.1em;
        color: #0056b3;
    }
</style>
<?php $__env->stopSection(); ?>

<?php if(session('active_tab')): ?>
<?php $activeTab = session('active_tab'); ?>
<?php else: ?>
<?php $activeTab = 1; ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <!-- Summary Card -->
        <div class="card mb-1">
            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                <h5 class="mb-0">Member Profile</h5>
                <a href="<?php echo e(route('member.index')); ?>" class="text-decoration-none">
                    <span class="icon-arrow-left-circle"></span> Back
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body d-flex justify-content-between align-items-center">
                <!-- Left Side: Member Details -->
                <div>
                    <h5 class="mb-0"><?php echo e($member->first_name); ?> <?php echo e($member->middle_name); ?> <?php echo e($member->last_name); ?></h5>
                    <p class="mb-0"><strong>Member ID:</strong> <?php echo e($member->member_code); ?></p>
                    <p class="mb-0"><strong>Branch:</strong> <?php echo e($member->branch->branch_name); ?></p>
                </div>
                <!-- Right Side: Profile Image -->
                <div>
                    <img src="<?php echo e($member->photo ? asset('storage/'.$member->photo)  : asset('assetsDashboard/img/stock/img1.jpg')); ?>"
                        alt="Profile Image" class="border rounded profile-image" width="90" height="90">
                </div>
            </div>
        </div>
        <style>
            .profile-image {
                border: 3px solid #e0e0e0;
                /* Light gray border */
                border-radius: 50%;
                /* Makes the image circular */
                padding: 3px;
                /* Adds space between the image and the border */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                /* Subtle shadow for depth */
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                /* Smooth hover effect */
            }

            .profile-image:hover {
                transform: scale(1.05);
                /* Slightly enlarges the image on hover */
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
                /* Enhances shadow on hover */
            }
        </style>

        <div class="card">
            <div class="card-body">

                <div class="custom-tabs-container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo e($activeTab == 1 ? 'active' : ''); ?>" id="first-tab"
                                data-bs-toggle="tab" href="#first" role="tab" aria-controls="first"
                                aria-selected="true">Basic Details</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo e($activeTab == 2 ? 'active' : ''); ?>" id="address-tab"
                                data-bs-toggle="tab" href="#address_details" role="tab">Address Information</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo e($activeTab == 3 ? 'active' : ''); ?>" id="address-tab"
                                data-bs-toggle="tab" href="#documents" role="tab">Documents</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo e($activeTab == 4 ? 'active' : ''); ?>" id="address-tab"
                                data-bs-toggle="tab" href="#rdaccount" role="tab">RD Accounts</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo e($activeTab == 5 ? 'active' : ''); ?>" id="address-tab"
                                data-bs-toggle="tab" href="#savingaccount" role="tab">Savings Accounts</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Basic Details Tab -->
                        <div class="tab-pane fade <?php echo e($activeTab == 1 ? 'show active' : ''); ?> " id="first"
                            role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <tr>
                                        <th>Member Code</th>
                                        <td><?php echo e($member->member_code); ?></td>

                                        <th>Application Number</th>
                                        <td><?php echo e($member->application_number); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td><?php echo e($member->title); ?></td>

                                        <th>Full Name</th>
                                        <td><?php echo e($member->first_name); ?> <?php echo e($member->middle_name); ?> <?php echo e($member->last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td><?php echo e(\Carbon\Carbon::parse($member->date_of_birth)->format('d M Y')); ?></td>

                                        <th>Occupation</th>
                                        <td><?php echo e($member->occupation); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Annual Income</th>
                                        <td>&#8377;<?php echo e(number_format($member->annual_income, 2)); ?></td>

                                        <th>Monthly Income</th>
                                        <td>&#8377;<?php echo e(number_format($member->monthly_income, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Father's Name</th>
                                        <td><?php echo e($member->father_name); ?></td>

                                        <th>Mother's Name</th>
                                        <td><?php echo e($member->mother_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Spouse Name</th>
                                        <td><?php echo e($member->husband_spouse); ?></td>

                                        <th>Marital Status</th>
                                        <td><?php echo e(ucfirst($member->marital_status)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Enrollment Date</th>
                                        <td><?php echo e(\Carbon\Carbon::parse($member->enrollment_date)->format('d M Y')); ?></td>

                                        <th>Ex-Service Person</th>
                                        <td>
                                            <?php if($member->ex_service_person): ?>
                                            <span class="badge bg-success">Yes</span>
                                            <?php else: ?>
                                            <span class="badge bg-danger">No</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo e($member->email); ?></td>

                                        <th>Email Active</th>
                                        <td>
                                            <?php if($member->email_is_active): ?>
                                            <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Number</th>
                                        <td><?php echo e($member->mobile_number); ?></td>

                                        <th>Mobile Active</th>
                                        <td>
                                            <?php if($member->mobile_is_active): ?>
                                            <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Aadhaar Number</th>
                                        <td><?php echo e($member->aadhaar_number); ?></td>

                                        <th>Voter ID</th>
                                        <td><?php echo e($member->voter_id); ?></td>
                                    </tr>
                                    <tr>
                                        <th>PAN Number</th>
                                        <td><?php echo e($member->pan_number); ?></td>

                                        <th>Ration Card Number</th>
                                        <td><?php echo e($member->ration_card_number); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Meter Number</th>
                                        <td><?php echo e($member->meter_number); ?></td>

                                        <th>CI Number</th>
                                        <td><?php echo e($member->ci_number); ?></td>
                                    </tr>
                                    <tr>
                                        <th>CI Relation</th>
                                        <td><?php echo e($member->ci_relation); ?></td>

                                        <th>Driving License Number</th>
                                        <td><?php echo e($member->dl_number); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Address Information Tab -->
                        <div class="tab-pane fade <?php echo e($activeTab == 2 ? 'show active' : ''); ?>" id="address_details"
                            role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <tr>
                                        <th>Correspondence Address</th>
                                        <td><?php echo e($member->correspondence_address_line1); ?>, <?php echo e($member->correspondence_address_line2); ?></td>
                                        <th>Para</th>
                                        <td><?php echo e($member->para); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Panchayat</th>
                                        <td><?php echo e($member->panchayat); ?></td>
                                        <th>Ward</th>
                                        <td><?php echo e($member->ward); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td><?php echo e($member->area); ?></td>
                                        <th>Landmark</th>
                                        <td><?php echo e($member->landmark); ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?php echo e($member->city); ?></td>
                                        <th>State</th>
                                        <td><?php echo e($member->state); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pincode</th>
                                        <td><?php echo e($member->pincode); ?></td>
                                        <th>Country</th>
                                        <td><?php echo e($member->country); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Permanent Address</th>
                                        <td><?php echo e($member->permanent_address); ?></td>
                                        <th>Permanent City</th>
                                        <td><?php echo e($member->permanent_city); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Permanent State</th>
                                        <td><?php echo e($member->permanent_state); ?></td>
                                        <th>Permanent Pincode</th>
                                        <td><?php echo e($member->permanent_pincode); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Use as Communication Address</th>
                                        <td>
                                            <?php if($member->use_as_communication_address): ?>
                                            <span class="badge bg-success">Yes</span>
                                            <?php else: ?>
                                            <span class="badge bg-danger">No</span>
                                            <?php endif; ?>
                                        </td>
                                        <th>Geolocation</th>
                                        <td>Lat: <?php echo e($member->address_latitude); ?>, Lng: <?php echo e($member->address_longitude); ?>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Dcoucment section --->
                        <div class="tab-pane fade <?php echo e($activeTab == 3 ? 'show active' : ''); ?>" id="documents"
                            role="tabpanel">
                            <style>
                                .btn-xs {
                                    padding: 2px 5px;
                                    /* Smaller padding */
                                    font-size: 18px;
                                    /* Smaller text */
                                    line-height: 1;
                                    /* Adjust line height */
                                }
                            </style>
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Upload Required Documents</h5>
                                <div class="separator mb-3"></div> <!-- Subtle separator -->
                                <form action="<?php echo e(route('members.upload.documents', $member->id)); ?>" method="POST"
                                    enctype="multipart/form-data" id="DocStore">
                                    <?php echo csrf_field(); ?>
                                    <div class="row gutters">
                                        
                                        <!-- PAN Card -->
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="field-wrapper">
                                                <input type="file" class="form-control" name="pan_card"
                                                    accept="image/*">
                                                <div class="field-placeholder">PAN Card</div>
                                            </div>
                                        </div>

                                        <!-- Aadhaar Card -->
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="field-wrapper">
                                                <input type="file" class="form-control" name="aadhar_card"
                                                    accept="image/*">
                                                <div class="field-placeholder">Aadhaar Card</div>
                                            </div>
                                        </div>

                                        <!-- Photo -->
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                            <div class="field-wrapper">
                                                <input type="file" class="form-control" name="photo" accept="image/*">
                                                <div class="field-placeholder">Photo</div>
                                            </div>
                                        </div>

                                        <!-- Signature -->
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                            <div class="field-wrapper">
                                                <input type="file" class="form-control" name="signature"
                                                    accept="image/*">
                                                <div class="field-placeholder">Signature</div>
                                            </div>
                                        </div>

                                        <!-- Driving License -->
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                            <div class="field-wrapper">
                                                <input type="file" class="form-control" name="driving_license"
                                                    accept="image/*">
                                                <div class="field-placeholder">Driving License</div>
                                            </div>
                                        </div>

                                        <!-- Dynamic Document Upload Section -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                                            id="document-section">
                                            <div class="field-wrapper">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" name="document_type[]"
                                                        placeholder="Document Type">
                                                    <span class="input-group-text">
                                                        <i class="icon-file"></i>
                                                    </span>
                                                    <input class="form-control" type="file" name="document[]">
                                                    <button type="button" id="add-document"
                                                        class="btn btn-outline-primary btn-sm"
                                                        style="margin-left: 10px;">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('add-document').addEventListener('click', function() {
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
                                                        <button type="button" class="btn btn-danger remove-document btn-sm" style="margin-left: 10px;">-</button>
                                                    </div>
                                                </div>
                                            `;
                                            document.getElementById('document-section').appendChild(newDocumentField);
                                            newDocumentField.querySelector('.remove-document').addEventListener('click', function() {
                                                newDocumentField.remove();
                                            });
                                        });
                                    </script>
                                    <div class="separator mb-1"></div>
                                    <div class="text-end">
                                        <button class="btn btn-sm btn-outline-primary py-1 px-2" id="DocsubmitButton"
                                            type="submit">
                                            <span class="icon-save2"></span>
                                            <span id="DocbuttonText">Upload
                                                Documents </span>
                                            <span id="DocloadingSpinner"
                                                class="spinner-border spinner-border-sm text-white d-none"
                                                role="status">
                                                <span class="visually-hidden">Submitting...</span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive mt-4">
                                <h5 class="fw-bold mb-3">Uploaded Documents</h5>
                                <div class="separator mb-3"></div> <!-- Subtle separator -->
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Document Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Single File Documents -->
                                        <?php $__currentLoopData = ['photo', 'signature', 'pan_card', 'aadhar_card', 'driving_license']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($member->$field)): ?>
                                        <tr>
                                            <td><?php echo e(ucfirst(str_replace('_', ' ', $field))); ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-outline-primary preview-btn"
                                                    data-file="<?php echo e(asset('storage/' . $member->$field)); ?>"
                                                    data-type="image" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="<?php echo e(asset('storage/' . $member->$field)); ?>" download
                                                    class="btn btn-xs btn-outline-success" title="Download">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <form
                                                    action="<?php echo e(route('members.delete.document', ['id' => $member->id, 'type' => $field])); ?>"
                                                    method="POST" class="d-inline-block">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-xs btn-outline-danger"
                                                        title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this document?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Multiple Uploaded Documents -->
                                        <?php $__currentLoopData = json_decode($member->documents, true) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($document['doc_type']); ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-outline-primary preview-btn"
                                                    data-file="<?php echo e(asset('storage/' . $document['file_path'])); ?>"
                                                    data-type="<?php echo e(pathinfo($document['file_path'], PATHINFO_EXTENSION)); ?>"
                                                    title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="<?php echo e(asset('storage/' . $document['file_path'])); ?>" download
                                                    class="btn btn-xs btn-outline-success" title="Download">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <form
                                                    action="<?php echo e(route('members.delete.document', ['id' => $member->id, 'type' => basename($document['file_path'])])); ?>"
                                                    method="POST" class="d-inline-block">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-xs btn-outline-danger"
                                                        title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this document?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!---end of thedocument section-->

                        <!-- RD Account Section -->
                        <div class="tab-pane fade <?php echo e($activeTab == 4 ? 'show active' : ''); ?>" id="rdaccount"
                            role="tabpanel">

                            <!-- Display RD Accounts -->
                            <h5>Recurring Deposit (RD) Accounts</h5>
                            <div class="separator mb-3"></div> <!-- Subtle separator -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Plan Code</th>
                                        <th>Deposit Min Amount</th>
                                        <th>Account No</th>
                                        <th>Balance</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $rdAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($rd->rdPlan->plan_name); ?></td>
                                        <td><?php echo e($rd->rdPlan->plan_code); ?></td>
                                        <td><?php echo e($rd->rdPlan->minimum_amount); ?></td>
                                        <td><?php echo e($rd->account_number); ?> </td>
                                        <td><?php echo e(number_format($rd->balance, 2)); ?></td>
                                        <td><a href="<?php echo e(route('rdAc.profile', $rd->id)); ?>"
                                                class="btn btn-xs btn-outline-primary" title="View Account">
                                                <i class="fas fa-eye"></i>
                                            </a></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>

                        <!-- Saving Account Section -->
                        <div class="tab-pane fade <?php echo e($activeTab == 5 ? 'show active' : ''); ?>" id="savingaccount"
                            role="tabpanel">
                            <!-- Display Savings Accounts -->
                            <h5>Savings Accounts</h5>
                            <div class="separator mb-3"></div> <!-- Subtle separator -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Plan Code</th>
                                        <th>Account Number</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $savingsAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($account->savingsPlan->plan_name); ?></td>
                                        <td><?php echo e($account->savingsPlan->plan_code); ?></td>
                                        <td><?php echo e($account->account_number); ?></td>
                                        <td><?php echo e(number_format($account->balance, 2)); ?></td>
                                        <td><a href="<?php echo e(route('sa.profile', $account->id)); ?>"
                                                class="btn btn-xs btn-outline-primary" title="View Account">
                                                <i class="fas fa-eye"></i>
                                            </a></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <style>
                    /* Custom Separator Style */
                    .separator {
                        height: 1px;
                        background-color: #e0e0e0;
                        /* Light gray color */
                        width: 100%;
                        margin: 0 auto;
                        /* Center the separator */
                    }
                </style>

            </div>
        </div>


        <!-- Tabs Section -->

    </div>
</div>

<!-- Modal for Preview -->
<!-- Modal for Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <!-- Transparent Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title text-white fw-bold mx-auto" id="previewModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body (Content Preview) -->
            <div class="modal-body text-center">
                <div id="previewContent" class="d-flex justify-content-center align-items-center"></div>
            </div>

            <!-- Bottom Close Button -->
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button type="button" class="btn btn-light px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<style>
    /* Make modal background transparent */
    .modal-content.bg-transparent {
        background: rgba(0, 0, 0, 0.7);
        /* Dark transparent background */
        backdrop-filter: blur(8px);
        /* Blur effect */
    }

    /* Make modal title more elegant */
    .modal-title {
        font-size: 20px;
    }

    /* Adjust modal size for mobile */
    @media (max-width: 768px) {
        .modal-xl {
            max-width: 95%;
        }

        #previewContent {
            max-height: 400px;
            overflow-y: auto;
        }
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
    new FormSubmitHandler('DocStore', 'DocsubmitButton', 'DocbuttonText', 'DocloadingSpinner');
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.preview-btn').forEach(button => {
        button.addEventListener('click', function () {
            let fileUrl = this.getAttribute('data-file');
            let fileType = this.getAttribute('data-type');
            let modalTitle = document.getElementById('previewModalLabel');
            let previewContent = document.getElementById('previewContent');

            previewContent.innerHTML = ''; // Clear previous content

            if (fileType === 'image') {
                modalTitle.textContent = "Image Preview";
                previewContent.innerHTML = `<img src="${fileUrl}" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">`;
            } else if (fileType === 'pdf') {
                modalTitle.textContent = "Document Preview";
                previewContent.innerHTML = `<iframe src="${fileUrl}" width="100%" height="500px" style="border: none;"></iframe>`;
            } else {
                modalTitle.textContent = "File Preview";
                previewContent.innerHTML = `<p class="text-danger">Preview not available for this file type.</p>`;
            }

            new bootstrap.Modal(document.getElementById('previewModal')).show(); // Open modal
        });
    });
});


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/members/profile.blade.php ENDPATH**/ ?>