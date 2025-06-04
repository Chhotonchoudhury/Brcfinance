

<?php $__env->startSection('title'); ?> RD Account List <?php $__env->stopSection(); ?>

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
            <div class="d-flex justify-content-between align-items-center bg-light w-100" style="height: 40px;">
                <div class="ms-2">
                    <h6 class="m-0">All RD Accounts</h6>
                </div>
                <div class="me-2">
                    <?php if(hasRolePermission('rdAC-create')): ?>
                    <a href="<?php echo e(route('rdAc.create')); ?>" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"> </i> New RD Account
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                            role="status"></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Left side: Search Form -->
                        <form method="GET" action="<?php echo e(route('rdAc.account')); ?>" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm" value="<?php echo e($search); ?>"
                                placeholder="Search rd accounts..."
                                style="width: auto; min-height:30px; max-width: 300px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <i class="icon icon-search1 me-1"></i> Search
                            </button>
                        </form>

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            <?php if(hasRolePermission('rdAC-data-export')): ?>
                            <button id="export-print" class="btn btn-outline-success btn-sm ms-2" title="Print"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <span class="icon-printer"></span> Print
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <table id="account-table" class="table table-bordered table-striped table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Member Name</th>
                                <th>Membership No</th>
                                <th>Account Number</th>
                                <th>Plan Name</th>
                                <th>Nominee(Y/N)</th>
                                <th>Avilable Balance</th>
                                <th>Approval status</th>
                                <th>AC status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e($account->status === 'pending' ? 'table-danger' : ''); ?>">
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($account->branch->branch_name); ?></td>
                                <td><a href="<?php echo e(route('rdAc.profile',$account->id)); ?>"><?php echo e($account->member->first_name); ?> <?php echo e($account->member->last_name); ?> </a></td>
                                <td><?php echo e($account->member->member_code); ?></td>
                                <td><a href="<?php echo e(route('rdAc.profile',$account->id)); ?>"><?php echo e($account->account_number); ?></a></td>
                                <td><?php echo e($account->rdPlan->plan_name); ?></td>
                                <td><?php echo e($account->nominee ? 'Yes' : 'No'); ?></td>
                                <td><?php echo e(number_format($account->balance, 2)); ?></td>

                                <td>
                                    <?php if($account->status === 'approved'): ?>
                                    <span class="badge bg-success rounded-pill shadow-sm">approved</span>
                                    <?php elseif($account->status === 'rejected'): ?>
                                    <span class="badge bg-danger rounded-pill shadow-sm">rejected</span>
                                    <?php elseif($account->status === 'pending'): ?>
                                    <span class="badge bg-warning rounded-pill shadow-sm">pending</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if($account->account_status === 'active'): ?>
                                    <span class="badge bg-success rounded-pill shadow-sm">Active</span>
                                    <?php elseif($account->account_status === 'inactive'): ?>
                                    <span class="badge bg-danger rounded-pill shadow-sm">Inactive</span>
                                    <?php elseif($account->account_status === 'on_hold'): ?>
                                    <span class="badge bg-warning rounded-pill shadow-sm">On Hold</span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <div class="td-actions">
                                        <!-- Calculate Button (Styled Professionally with Font Awesome Icon) -->
                                        <?php if($account->maturity_date === null): ?>
                                        <a href="#"
                                            class="btn btn-sm btn-outline-dark d-inline-flex align-items-center rounded-pill shadow-sm px-3 calculate-btn"
                                            data-id="<?php echo e($account->id); ?>" data-bs-toggle="tooltip"
                                            title="Perform calculation">
                                            <i class="fas fa-calculator me-2"></i> Calculate
                                        </a>
                                        <?php else: ?>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-success d-inline-flex align-items-center rounded-pill shadow-sm px-3 view-details-btn"
                                            data-bs-toggle="modal" data-bs-target="#accountDetailModal"
                                            data-id="<?php echo e($account->id); ?>">
                                            <i class="fa fa-table"></i>
                                        </button>
                                        <?php endif; ?>

                                        <?php if(hasRolePermission('rdAC-profile-view')): ?>
                                        <!-- View Button (Eye Icon) -->
                                        <a href="<?php echo e(route('rdAc.profile',$account->id)); ?>" class="icon green"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <?php endif; ?>
                                        <!-- Edit Button (Pencil Icon) -->

                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="10" class="text-center">No RD accounts found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <div class="footer-info">
                    Total Records: <?php echo e($accounts->total()); ?>

                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <?php echo e($accounts->links('vendor.pagination.custom-pagination')); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!---Model for account details-->
<!-- Account Detail Modal -->
<div class="modal fade" id="accountDetailModal" tabindex="-1" aria-labelledby="accountDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow rounded">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title" id="accountDetailModalLabel">RD Account Summary</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="accountDetailContentLoader" class="text-center my-3 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div id="accountDetailContent" class="row gy-3">
                    <!-- Fetched content will be inserted here -->
                </div>

            </div>
            <div class="modal-footer bg-light rounded-bottom">
                <button type="button" class="btn btn-outline-secondary rounded-pill"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!---End of Model-->

<script>
    window.quickViewUrl = "<?php echo e(url('/rd-accounts-quick-view')); ?>/";
</script>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    // For printing the Savings Account table content
    setupPrintButton('export-print', 'account-table');
    const calculateUrl = "<?php echo e(route('rdAc.calculate')); ?>";
    //function for rd calculation 
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.calculate-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const accountId = this.getAttribute('data-id');
                const buttonElement = this;

                buttonElement.disabled = true;
                buttonElement.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Calculating';

                fetch(calculateUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ id: accountId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Hide the button on success
                        buttonElement.remove();

                        // Show success toastr
                        toastr.success(data.message);
                    } else {
                        alert(data.message || 'Calculation failed.');
                        buttonElement.disabled = false;
                        buttonElement.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error(error.message || 'Something went wrong!');
                    buttonElement.disabled = false;
                    buttonElement.innerHTML = '<i class="fas fa-calculator me-2"></i> Calculate';
                });
            });
        });
    });


    //function for account quick view 
    //function for account quick view 
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-details-btn').forEach(button => {
        button.addEventListener('click', function () {
            const accountId = this.getAttribute('data-id');

            const url = `${window.quickViewUrl}${accountId}`;
            console.log("Fetching URL:", url); // ✅ debug

            // Show loader and clear old content
            document.getElementById('accountDetailContent').innerHTML = '';
            document.getElementById('accountDetailContentLoader').classList.remove('d-none');

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const html = `
                        <div class="col-md-3">
                            <strong>Member Code:</strong> <div>${data.member_code}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Member Name:</strong> <div>${data.member_name}</div>
                        </div>
                        
                        <div class="col-md-3">
                            <strong>Account Number:</strong> <div>${data.account_number}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Branch:</strong> <div>${data.branch}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Installment Amount:</strong> <div>₹ ${data.installment_amount}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Duration:</strong> <div> ${data.tenure_duration_days} / Days</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Principal Amount:</strong> <div>₹ ${data.principal_amount} </div>
                        </div>

                        <div class="col-md-3">
                            <strong>Interet Rate % :</strong> <div> ${data.interest_rate_percentage} %</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Total Interest :</strong> <div>₹ ${data.total_interest} </div>
                        </div>

                        <div class="col-md-3">
                            <strong>Maturity Amount:</strong> <div>₹ ${data.maturity_balance}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Maturity Date:</strong> <div> ${data.maturity_date}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Current Paid:</strong> <div>₹ ${data.current_amount}</div>
                        </div>

                        <div class="col-md-3">
                            <strong>Due Blance:</strong> <div>₹ ${data.due_blance}</div>
                        </div>
                    `;

                    document.getElementById('accountDetailContentLoader').classList.add('d-none'); // hide loader
                    document.getElementById('accountDetailContent').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('accountDetailContentLoader').classList.add('d-none'); // hide loader
                    toastr.error(error.message);
                    console.error(error);
                });
        });
    });
});


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\NidhiBank\resources\views/accounts/RdAccount.blade.php ENDPATH**/ ?>