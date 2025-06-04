

<?php $__env->startSection('title'); ?> Savings Account Profile <?php $__env->stopSection(); ?>

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

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <!-- Summary Card -->
        <div class="card mb-1">
            <div class="account-type d-flex justify-content-between">
                Savings Account
                <a href="<?php echo e(route('sa.index')); ?>" class=""><span class="icon-arrow-left-circle"></span>Back</a>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="mb-1"><?php echo e($account->member->first_name); ?> <?php echo e($account->member->middle_name); ?> <?php echo e($account->member->last_name); ?></h5>
                        <p class="mb-0">A/c Number : <strong><?php echo e($account->account_number); ?></strong></p>
                        <p class="mb-0">Branch : <strong><?php echo e($account->branch->branch_name); ?></strong></p>

                    </div>
                    <div>
                        <h4 class="text-success mb-1">&#8377;<?php echo e($account->balance); ?></h4>
                        <span class="badge 
                        <?php if($account->account_status === 'active'): ?> bg-success 
                        <?php elseif($account->account_status === 'inactive'): ?> bg-danger 
                        <?php elseif($account->account_status === 'on_hold'): ?> bg-warning 
                        <?php endif; ?>">
                            <?php echo e(ucfirst($account->account_status)); ?>

                        </span>

                    </div>
                </div>
            </div>
        </div>


        <!-- Tabs Section -->


        <div class="card">
            <div class="card-body">

                <div class="custom-tabs-container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="first-tab" data-bs-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true">Basic Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tran-tab" data-bs-toggle="tab" href="#tran" role="tab"
                                aria-controls="tran" aria-selected="false">Deposit / Withdrawal</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="second-tab" data-bs-toggle="tab" href="#second" role="tab"
                                aria-controls="second" aria-selected="false">Transaction History</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="third-tab" data-bs-toggle="tab" href="#third" role="tab"
                                aria-controls="third" aria-selected="false">Deposit logs</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <!-- Basic Details Tab -->
                        <div class="tab-pane fade show active" id="first" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <tr>
                                        <th>Member Name</th>
                                        <td><?php echo e($account->member->first_name); ?> <?php echo e($account->member->middle_name); ?> <?php echo e($account->member->last_name); ?></td>

                                        <th>Account Number</th>
                                        <td><?php echo e($account->account_number); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Branch</th>
                                        <td><?php echo e($account->branch->branch_name); ?> | <?php echo e($account->branch->branch_code); ?></td>

                                        <th>Member Code</th>
                                        <td><?php echo e($account->member->member_code); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Plan</th>
                                        <td><?php echo e($account->savingsPlan->plan_name); ?> | <?php echo e($account->savingsPlan->plan_code); ?>

                                        </td>

                                        <th>Interest Rate</th>
                                        <td><?php echo e($account->savingsPlan->annual_interest_rate); ?> %</td>
                                    </tr>
                                    <tr>
                                        <th>Ac on Hold</th>
                                        <td><?php if($account->account_status != 'on_hold'): ?>
                                            <span class="badge bg-primary">No</span>
                                            <?php else: ?>
                                            <span class="badge bg-danger">Yes</span>
                                            <?php endif; ?>
                                        </td>

                                        <th>Opeaning Date</th>
                                        <td><?php echo e(\Carbon\Carbon::parse($account->opeaning_date)->format('d M Y')); ?></td>

                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><?php echo e($account->member->mobile_number); ?></td>

                                        <th>Email</th>
                                        <td><?php echo e($account->member->email); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Aadhaar No</th>
                                        <td><?php echo e($account->member->aadhaar_number); ?></td>

                                        <th>PAN No</th>
                                        <td><?php echo e($account->member->pan_number); ?></td>
                                    </tr>


                                </table>
                            </div>
                        </div>


                        <!-- Other Details Tab -->
                        <div class="tab-pane fade" id="tran" role="tabpanel">
                            <form id="SaTran" action="<?php echo e(route('sa.transaction')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="card">
                                    <!-- Payment Information Section -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                        <div class="form-section-header">Make Payment (Deposit / withdrawal)</div>
                                    </div>

                                    <div class="row gutters mb-1">
                                        <input type="hidden" name="account_id" value="<?php echo e($account->id); ?>">
                                        <input type="hidden" name="branch_id" value="<?php echo e($account->branch->id); ?>">
                                        <!-- Payment Mode -->
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <select class="form-control <?php $__errorArgs = ['payment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    required id="paymentType" name="payment_type">
                                                    <option value="" selected disabled>Type</option>
                                                    <option value="deposit">Deposit</option>
                                                    <option value="withdrawal">Withdrawal</option>

                                                </select>
                                                <div class="field-placeholder">Payment type <span
                                                        class="text-danger">*</span>
                                                </div>
                                                <?php $__errorArgs = ['payment_type'];
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

                                        <!--transaction Amount --->
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <input class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="number" id="amount" name="amount" value="<?php echo e(old('amount')); ?>"
                                                    placeholder="Enter Amount" required>
                                                <div class="field-placeholder">Amount <span class="text-danger">*</span>
                                                </div>

                                                <?php $__errorArgs = ['amount'];
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
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <input
                                                    class="form-control <?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="date" name="transaction_date"
                                                    value="<?php echo e(old('transaction_date')); ?>" required>
                                                <div class="field-placeholder">Transaction Date <span
                                                        class="text-danger">*</span>
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
unset($__errorArgs, $__bag); ?>"
                                                    id="paymentMode" name="payment_mode" required>
                                                    <option value="" selected disabled>Select Payment Mode</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="cheque">Cheque</option>
                                                    <option value="online">Online</option>
                                                </select>
                                                <div class="field-placeholder">Payment Mode <span
                                                        class="text-danger">*</span>
                                                </div>
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
                                                    <input class="form-control" type="text"
                                                        name="online_transaction_id">
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
                                    <!-- Card Footer -->
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <div class="footer-left">
                                            <p class="text-muted mb-0 small"></p>
                                        </div>
                                        <div class="footer-right">

                                            <button class="btn btn-sm btn-outline-success py-1 px-2" id="DDsubmitButton"
                                                type="submit">
                                                <span class="icon-check_circle"></span>
                                                <span id="DDbuttonText"> Make Payment </span>
                                                <span id="DDloadingSpinner"
                                                    class="spinner-border spinner-border-sm text-white d-none"
                                                    role="status">
                                                    <span class="visually-hidden">Payment creating...</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- Transaction History Tab -->
                        <div class="tab-pane fade" id="second" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(\Carbon\Carbon::parse($transaction->transaction_date)->format('d M
                                                Y')); ?></td>
                                            <td>₹<?php echo e(number_format($transaction->amount, 2)); ?></td>
                                            <td><?php echo e(ucfirst($transaction->action_type)); ?></td>
                                            <td>
                                                <?php if($transaction->status == 'approved'): ?>
                                                <span class="badge bg-success">Completed</span>
                                                <?php elseif($transaction->status == 'pending'): ?>
                                                <span class="badge bg-warning">Pending</span>
                                                <?php elseif($transaction->status == 'rejected'): ?>
                                                <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-outline-info btn-sm" title="Print Receipt">
                                                    <span class="icon-printer"></span>
                                                </a>
                                                <a href="#" class="btn-outline-danger btn-sm"
                                                    title="Revert Transaction">
                                                    <span class="icon-undo"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Other Details Tab -->
                        <div class="tab-pane fade" id="third" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>₹1 Notes</th>
                                            <th>₹5 Notes</th>
                                            <th>₹10 Notes</th>
                                            <th>₹20 Notes</th>
                                            <th>₹50 Notes</th>
                                            <th>₹100 Notes</th>
                                            <th>₹200 Notes</th>
                                            <th>₹500 Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $depositLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(\Carbon\Carbon::parse($transaction->transaction_date)->format('d M
                                                Y')); ?></td>
                                            <td>₹<?php echo e(number_format($transaction->amount, 2)); ?></td>
                                            <td><?php echo e(ucfirst($transaction->action_type)); ?></td>
                                            <td>
                                                <?php if($transaction->status == 'approved'): ?>
                                                <span class="badge bg-success">Completed</span>
                                                <?php elseif($transaction->status == 'pending'): ?>
                                                <span class="badge bg-warning">Pending</span>
                                                <?php elseif($transaction->status == 'rejected'): ?>
                                                <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                            </td>
                                            <!-- Display cash denominations if available -->
                                            <td><?php echo e($transaction->cash_1); ?></td>
                                            <td><?php echo e($transaction->cash_5); ?></td>
                                            <td><?php echo e($transaction->cash_10); ?></td>
                                            <td><?php echo e($transaction->cash_20); ?></td>
                                            <td><?php echo e($transaction->cash_50); ?></td>
                                            <td><?php echo e($transaction->cash_100); ?></td>
                                            <td><?php echo e($transaction->cash_200); ?></td>
                                            <td><?php echo e($transaction->cash_500); ?></td>

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

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
    new FormSubmitHandler('SaTran', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accounts/SAProfile.blade.php ENDPATH**/ ?>