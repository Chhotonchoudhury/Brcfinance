


<?php $__env->startSection('title', 'Loan Calculator'); ?>

<?php $__env->startSection('style'); ?>
<style>
    .loan-form-container {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .loan-form-header {
        background-color: #f8f9fa;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .loan-form-header h2 {
        margin: 0;
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 30px;
        position: relative;
    }

    .btn-loading {
        visibility: hidden;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .modal-body p {
        font-size: 1rem;
        line-height: 1.6;
    }

    .modal-footer {
        justify-content: center;
    }

    .footer-info {
        font-size: 0.9rem;
        background-color: #f1f1f1;
        padding: 8px 15px;
        border-radius: 5px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-1">
    <div class="loan-form-container">
        <form id="loanForm">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="plan_id" class="form-label">Select Loan Plan</label>
                    <select class="form-select" name="plan_id" id="selected_plan_id" required>
                        <option value="">-- Select a Plan --</option>
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($plan->id); ?>">
                            <?php echo e($plan->plan_name); ?> (<?php echo e($plan->interest_rate); ?>% Interest, <?php echo e($plan->tenure_months); ?>

                            months)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="loan_amount" class="form-label">Loan Amount</label>
                    <input type="number" id="loan_amount" name="loan_amount" class="form-control"
                        placeholder="Enter loan amount" min="1" required>
                </div>

                <div class="col-md-3 mb-3"><br>
                    <button type="submit" class="btn btn-primary w-100 btn-custom">Calculate Loan
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm btn-loading"
                            role="status"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container mt-4">
    <h4 class="mb-3">Available Loan Plans</h4>
    <div class="d-flex overflow-auto pb-2" style="gap: 20px;">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card flex-shrink-0 shadow-sm border-0"
            style="min-width: 300px; border-radius: 15px; transition: all 0.3s;">
            <div class="card-body p-4">
                <div class="mb-3">
                    <h5 class="card-title text-primary"><?php echo e($plan->plan_name); ?></h5>
                    <span class="badge bg-success mb-2"><?php echo e($plan->interest_rate); ?> % Interest</span>
                    <div class="mt-2 small text-muted">
                        <p class="mb-1"><i class="bx bx-barcode me-1"></i> Plan Code: <?php echo e($plan->plan_code); ?></p>
                        <p class="mb-1"><i class="bx bx-calendar-star me-1"></i> Tenure: <?php echo e($plan->tenure_months); ?>

                            months</p>
                        <p class="mb-1"><i class="bx bx-credit-card me-1"></i> EMI Type: <?php echo e(ucfirst($plan->emi_type)); ?>

                        </p>
                        <p class="mb-1"><i class="bx bx-wallet me-1"></i> Deposit Type: <?php echo e($plan->deposit_type); ?></p>
                        <p class="mb-1"><i class="bx bx-rupee me-1"></i> Min: ₹<?php echo e(number_format($plan->min_loan_amount)); ?> - Max: ₹<?php echo e(number_format($plan->max_loan_amount)); ?></p>
                        <p class="mb-0"><i class="bx bx-money me-1"></i> Processing Fee: <?php echo e($plan->processing_fee); ?>%
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- See All Plans Card -->
        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="min-width: 300px;">
            <a href="<?php echo e(route('loanAD.index')); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2">
                See All Plans <i class="bx bx-right-arrow-alt ms-1"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
    }

    .d-flex::-webkit-scrollbar {
        display: none;
    }

    .d-flex {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>



<!-- Result Modal -->
<div class="modal fade" id="loanResultModal" tabindex="-1" aria-labelledby="loanResultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="loanResultModalLabel">Loan Calculation Result</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Dynamic Content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    const loanCalculatorUrl = "<?php echo e(route('loan.ad.calculator.calculate')); ?>";

    document.addEventListener('DOMContentLoaded', function() {
        const loanForm = document.getElementById('loanForm');
        const loadingSpinner = document.getElementById('loadingSpinner');

        loanForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const planId = document.getElementById('selected_plan_id').value;
            const loanAmount = document.getElementById('loan_amount').value;
            const token = document.querySelector('input[name="_token"]').value;

            if (!planId) {
                alert('Please select a Loan Plan.');
                return;
            }

            // Show loading spinner
            loadingSpinner.style.visibility = 'visible';

            try {
                const response = await fetch(loanCalculatorUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        plan_id: planId,
                        loan_amount: loanAmount
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to calculate loan.');
                }

                const data = await response.json();

                // Hide loading spinner
                loadingSpinner.style.visibility = 'hidden';

                document.querySelector('#loanResultModal .modal-body').innerHTML = `
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-bookmark-alt me-2 fs-4 text-primary"></i>
                                    <strong class="me-2">Plan:</strong> <span>${data.plan_name}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-rupee me-2 fs-4 text-success"></i>
                                    <strong class="me-2">Loan:</strong> ₹${data.loan_amount}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-dollar-circle me-2 fs-4 text-warning"></i>
                                    <strong class="me-2">Processing Fee:</strong> ₹${data.processing_fee}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-certification me-2 fs-4 text-info"></i>
                                    <strong class="me-2">Stamp Duty:</strong> ₹${data.stamp_duty}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-shield-quarter me-2 fs-4 text-danger"></i>
                                    <strong class="me-2">Insurance:</strong> ₹${data.insurance}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-minus-circle me-2 fs-4 text-muted"></i>
                                    <strong class="me-2">Total Deductions:</strong> ₹${data.total_deductions}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-wallet me-2 fs-4 text-primary"></i>
                                    <strong class="me-2">Net Disbursal:</strong> ₹${data.net_disbursal_amount}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-credit-card me-2 fs-4 text-success"></i>
                                    <strong class="me-2">EMI:</strong> ₹${data.emi} / ${data.emi_type}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-calendar me-2 fs-4 text-warning"></i>
                                    <strong class="me-2">EMIs Count:</strong> ${data.number_of_emis}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 rounded bg-light d-flex align-items-center">
                                    <i class="bx bx-calendar-star me-2 fs-4 text-info"></i>
                                    <strong class="me-2">EMI Start Date:</strong> ${data.emi_start_date}
                                </div>
                            </div>
                        </div>
                    `;


                const modal = new bootstrap.Modal(document.getElementById('loanResultModal'));
                modal.show();

            } catch (error) {
                // Hide loading spinner on error
                loadingSpinner.style.visibility = 'hidden';
                alert(error.message);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/loan/loan-calculator.blade.php ENDPATH**/ ?>