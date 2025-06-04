

<?php $__env->startSection('title'); ?> All Transactions <?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .footer-info {
        font-size: 0.900rem;
        color: #333333;
        background-color: #f0f0f0;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #d1d1d1;
    }

    .pagination {
        margin-bottom: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center bg-light w-100 " style="height: 40px;">
                <div class="ms-2">
                    <h6 class="m-0">All Transactions</h6>
                </div>

                <!-- Filter Button -->
                <div class="me-2">
                    <button class="btn btn-sm btn-outline-primary py-1 px-2" id="filter-button" type="button">
                        <i class="fa fa-filter me-1"></i> Filter
                    </button>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive mb-0">
                    <div id="filter-section" class="bg-light p-1 mb-1" style="display: none; ">
                        <form method="GET" id="search-form" action="<?php echo e(route('pending.transaction')); ?>">
                            <div class="row">
                                <!-- Branch -->
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select
                                                class="form-control js-states select2 <?php $__errorArgs = ['branch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="branch-select" name="branch_id">
                                                <option value="" <?php echo e(old('branch_id')=='' ? 'selected' : ''); ?>>Select
                                                    Branch
                                                </option>
                                                <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>" <?php echo e(old('branch_id')==$branch->id ?
                                                    'selected'
                                                    : ''); ?>>
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

                                <!-- Users -->
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select
                                                class="form-control js-states select2 <?php $__errorArgs = ['employee_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="employee-select" name="employee_id">
                                                <option value="" <?php echo e(old('employee_id')=='' ? 'selected' : ''); ?>>Select
                                                    employees
                                                </option>

                                            </select>
                                        </div>
                                        <div class="field-placeholder">Employees <span class="text-danger">*</span>
                                        </div>
                                        <?php $__errorArgs = ['employee_id'];
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

                                <!-- Acccounts -->
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select
                                                class="form-control js-states select2 <?php $__errorArgs = ['account_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="select2" name="account_type">
                                                <option value="" <?php echo e(old('account_type')=='' ? 'selected' : ''); ?>>Select
                                                    Accounts
                                                </option>
                                                <option value="savings">Savings</option>
                                                <option value="rd">RD</option>
                                                <option value="fd">FD</option>
                                                <option value="all">All</option>
                                            </select>
                                        </div>
                                        <div class="field-placeholder">Accounts <span class="text-danger">*</span></div>
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

                                <!-- Date -->
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <input
                                                class="form-control <?php $__errorArgs = ['date_range'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> custom-daterange"
                                                type="text" name="date_range" value="<?php echo e(old('date_range')); ?>" required>
                                            <span class="input-group-text">
                                                <i class="icon-calendar1"></i>
                                            </span>
                                        </div>
                                        <div class="field-placeholder">Date Ranges <span class="text-danger">*</span>
                                        </div>
                                        <?php $__errorArgs = ['date_range'];
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
                                <!-- Search Button (Aligned with the other inputs) -->
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2"
                                                id="search-btn">
                                                <i class="icon icon-search1 me-1"></i> <span id="btn-text">Search</span>
                                                <span id="loading-spinner"
                                                    class="spinner-border spinner-border-sm d-none" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div class="field-placeholder"></div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>

                    <!-- Approve Multiple Transactions -->
                    <form method="POST" action="<?php echo e(route('transactions.approve.multiple')); ?>"
                        onsubmit="return confirm('Are you sure you want to approve the selected transactions?');">
                        <?php echo csrf_field(); ?>
                        <!-- Search Form with Export and Print Buttons on the Same Row -->

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <!-- Date Range Picker -->

                            <!-- Select All Checkbox -->

                            
                            <label class="form-check-label" for="select-all">
                                Select All
                            </label>


                            <!-- Approve Button (Hidden Initially) -->
                            <button type="submit" class="btn btn-success btn-sm ms-2" id="approve-btn"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem; display: none;">
                                <i class="fa fa-check me-1"></i> Approve Selected
                            </button>


                            <!-- Right side: Export Buttons -->
                            <div class="d-flex">
                                <!-- Print Button -->
                                <button id="export-print" class="btn btn-sm btn-outline-success ms-2"
                                    style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" title="Print">
                                    <i class="icon-printer"></i> Print
                                </button>
                            </div>
                        </div>

                        <table id="account-table" class="table table-bordered table-striped table-hover v-middle m-0">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select-all-checkbox">
                                    </th>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Account Type</th>
                                    <th>Member Name/Number</th>
                                    <th>Account Number</th>
                                    <th>Produced By</th>
                                    <th>Transaction Date</th>
                                    <th>Debited / Credited</th>
                                    <th>Amount</th>
                                    <th>Action</th> <!-- New Column for Single Approve Button -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalDebit = 0;
                                $totalCredit = 0;
                                ?>

                                <?php if($transactions->isEmpty()): ?>
                                <tr>
                                    <td colspan="11" class="text-center">No Records Found</td>
                                </tr>
                                <?php else: ?>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                // Highlight rejected transactions with a subtle red background
                                $rowClass = $transaction->status == 'rejected' ? 'table-danger' : '';
                                ?>
                                <tr class="<?php echo e($rowClass); ?>">
                                    <td>
                                        <?php if($transaction->status == 'pending'): ?>
                                        <input type="checkbox" class="row-checkbox" name="selected_transactions[]"
                                            value="<?php echo e($transaction->id); ?>">
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($transaction->transaction->branch->branch_name ?? 'N/A'); ?></td>
                                    <td><?php echo e($transaction->account_type); ?></td>
                                    <td>
                                        <?php if($transaction->transaction && $transaction->transaction->member): ?>
                                        <?php echo e($transaction->transaction->member->first_name ?? 'N/A'); ?>

                                        <?php echo e($transaction->transaction->member->middle_name ? ' ' .
                                        $transaction->transaction->member->middle_name : ''); ?>

                                        <?php echo e($transaction->transaction->member->last_name ?? 'N/A'); ?>

                                        <?php else: ?>
                                        N/A
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($transaction->transaction->account_number ?? 'N/A'); ?></td>
                                    <td><?php echo e($transaction->producedBy->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($transaction->transaction_date)->format('F j, Y h:i A')); ?>

                                    </td>
                                    <td>

                                        <?php if($transaction->action_type == 'withdrawal'): ?>
                                        <span class="text-danger"><?php echo e($transaction->action_type); ?></span>
                                        <?php if($transaction->status != 'rejected'): ?>
                                        <?php $totalDebit += $transaction->amount; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <span class="text-success"><?php echo e($transaction->action_type); ?></span>
                                        <?php if($transaction->status != 'rejected'): ?>
                                        <?php $totalCredit += $transaction->amount; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <?php if($transaction->action_type == 'withdrawal'): ?>
                                        <span class="text-danger">- <?php echo e(number_format($transaction->amount, 2)); ?></span>
                                        <?php else: ?>
                                        <span class="text-success">+ <?php echo e(number_format($transaction->amount, 2)); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($transaction->status == 'pending'): ?>
                                        <!-- Approve Single Transaction Form -->
                                        <form method="POST"
                                            action="<?php echo e(route('transactions.approve.single', $transaction->id)); ?>"
                                            onsubmit="return confirm('Are you sure you want to approve this transaction?');"
                                            style="display: inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <!-- Individual Approve Button -->
                                            <button type="submit" class="btn btn-sm btn-outline-success approve-btn"
                                                style="font-size: 0.50rem; padding: 0.20rem 0.5rem;"
                                                data-id="<?php echo e($transaction->id); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Approve Transaction">
                                                <i class="fa fa-check"></i>
                                            </button>

                                        </form>

                                        <form method="POST"
                                            action="<?php echo e(route('transactions.revert', $transaction->id)); ?>"
                                            onsubmit="return confirm('Are you sure you want to revert this transaction?');"
                                            style="display: inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger "
                                                style="font-size: 0.50rem; padding: 0.20rem 0.5rem;"
                                                data-id="<?php echo e($transaction->id); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Revert Transaction">
                                                <span class="icon-undo"></span>
                                            </button>
                                        </form>
                                        <?php else: ?>
                                        <?php
                                        $statusClasses = [
                                        'pending' => 'bg-warning text-dark',
                                        'approved' => 'bg-success text-white',
                                        'rejected' => 'bg-danger text-white'
                                        ];
                                        ?>
                                        <span
                                            class="badge <?php echo e($statusClasses[$transaction->status] ?? 'bg-secondary'); ?>  rounded-pill shadow-sm">
                                            <?php echo e(ucfirst($transaction->status)); ?>

                                        </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="9" style="text-align: right;">Total Debit:</td>
                                    <td style="font-weight: bold;">
                                        <span class="text-danger"><?php echo e(number_format($totalDebit, 2)); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" style="text-align: right;">Total Credit:</td>
                                    <td style="font-weight: bold;">
                                        <span class="text-success"><?php echo e(number_format($totalCredit, 2)); ?></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <div class="footer-info">
                    Total Records: <?php if($transactions->isEmpty()): ?> 0 <?php else: ?> <?php echo e($transactions->count()); ?> <?php endif; ?>
                </div>


                <!-- Pagination -->
                <div class="pagination-container">
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    // For printing the Savings Account table content
    setupPrintButton('export-print', 'account-table');


    // Wait for the DOM to fully load
    document.addEventListener("DOMContentLoaded", function() {
        // Select the filter button
        var filterButton = document.getElementById("filter-button");
        // Check if the button is found
        if (filterButton) {
            // Add an event listener if the button is found
            filterButton.addEventListener("click", function() {
    
                var filterSection = document.getElementById("filter-section");
                // Check if the filter section is found
                if (filterSection) {
                    // Toggle the display of the filter section
                    if (filterSection.style.display === "none") {
                        filterSection.style.display = "block";
                    } else {
                        filterSection.style.display = "none";
                    }
                } else {
                    console.error("Filter section not found!");
                }
            });
        } else {
            console.error("Filter button not found!");
        }
    });


    //this is the finout the get emplyee

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("branch-select").addEventListener("change", function() {
            let branchId = this.value;
            let employeeSelect = document.getElementById("employee-select");

            // Clear existing options
            employeeSelect.innerHTML = '<option value="">Select Employee</option>';

            if (branchId) {
                fetch(`/get-employees/${branchId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(employee => {
                            let option = document.createElement("option");
                            option.value = employee.id;
                            option.textContent = employee.name;
                            employeeSelect.appendChild(option);
                        });

                              // Add "All Employees" option at the bottom
                        let allOption = document.createElement("option");
                        allOption.value = "all";
                        allOption.textContent = "All Employees";
                        employeeSelect.appendChild(allOption);
                    })
                    .catch(error => console.error("Error fetching employees:", error));
            }
        });
    });


    document.getElementById('search-form').addEventListener('submit', function() {
        let searchBtn = document.getElementById('search-btn');
        let btnText = document.getElementById('btn-text');
        let loadingSpinner = document.getElementById('loading-spinner');

        // Disable the button
        searchBtn.disabled = true;
        
        // Hide text and show spinner
        btnText.style.display = 'none';
        loadingSpinner.classList.remove('d-none');
    });

</script>

<!-- JavaScript for Checkbox Functionality -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectAllCheckbox = document.getElementById("select-all-checkbox");
        const rowCheckboxes = document.querySelectorAll(".row-checkbox");
        const approveBtn = document.getElementById("approve-btn");

        function updateApproveButtonVisibility() {
            const anyChecked = Array.from(rowCheckboxes).some(checkbox => checkbox.checked);
            approveBtn.style.display = anyChecked ? "inline-block" : "none";
        }

        // "Select All" Checkbox Click Event
        selectAllCheckbox.addEventListener("change", function () {
            const isChecked = selectAllCheckbox.checked;
            rowCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
            updateApproveButtonVisibility();
        });

        // Individual Row Checkboxes Click Event
        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                updateApproveButtonVisibility();

                // If all checkboxes are checked, check "Select All", else uncheck it
                selectAllCheckbox.checked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/accounts/PendingTransaction.blade.php ENDPATH**/ ?>