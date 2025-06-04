@extends('layouts.app')

@section('title') Loan Against Deposit @endsection

@section('style')
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
@endsection

@section('content')


<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center bg-light w-100" style="height: 40px;">
                <div class="ms-2">
                    <h6 class="m-0">All Loan AD Applications</h6>
                </div>
                <div class="me-2">
                    <a href="{{ route('LoanADApplication.create') }}" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"> </i> New Loan AD Application
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                            role="status"></span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Left side: Search Form -->
                        <form method="GET" action="{{ route('LoanADApplication.index') }}"
                            class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}"
                                placeholder="Search loan against  deposit..."
                                style="width: auto; min-height:30px; max-width: 300px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <i class="icon icon-search1 me-1"></i> Search
                            </button>
                        </form>

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            <button id="export-print" class="btn btn-outline-success btn-sm ms-2" title="Print"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <span class="icon-printer"></span> Print
                            </button>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Application No</th>
                                <th>Member</th>
                                <th>Branch</th>
                                <th>Market</th>
                                <th>Against</th>
                                <th>Requested Loan</th>
                                <th>Date</th>
                                <th>Associate</th>
                                <th>Applicant</th>
                                <th>Status</th>
                                <th>Approver</th>
                                <th>Rejector</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $index => $account)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $account->application_number }}</td>
                                <td>{{ $account->member->member_code }} <br>({{ $account->member->first_name }} {{
                                    $account->member->last_name }})</td>
                                <td>{{ $account->branch->branch_name }}</td>
                                <td>
                                    {{ $account->marketcode ? $account->marketcode->code . ' - ' .
                                    $account->marketcode->area_name : 'N/A' }}
                                </td>

                                <td>
                                    Type: {{ $account->against_type }}<br>
                                    Ac: {{ $account->against_account_number ?? 'N/A' }}
                                </td>

                                <td>₹ {{ number_format($account->application_balance, 2) }}</td>
                                <td>{{ $account->application_date }}</td>
                                <td>{{ $account->associated ? $account->associated->name . '-' .
                                    $account->associated->user_type : 'NA' }}</td>
                                <td>{{ $account->applicant->name ?? 'NA' }}</td>



                                <td><span
                                        class="badge bg-{{ $account->application_status == 'approved' ? 'success' : ($account->application_status == 'pending' ? 'warning' : 'danger') }}">{{
                                        ucfirst($account->application_status) }}</span></td>

                                <td>
                                    @if ($account->application_approved_by && $account->application_approved_at)
                                    {{ $account->applicationApprovedBy->name }}<br>
                                    {{ \Carbon\Carbon::parse($account->application_approved_at)->format('d-m-Y') }}
                                    @else
                                    NA
                                    @endif
                                </td>

                                <td>
                                    @if ($account->application_rejected_by && $account->application_rejected_at)
                                    {{ $account->applicationRejectedBy->name }}<br>
                                    {{ \Carbon\Carbon::parse($account->application_rejected_at)->format('d-m-Y') }}
                                    @else
                                    NA
                                    @endif
                                </td>

                                {{-- <a href="#" class="btn btn-sm btn-primary rounded-pill px-2 py-1">View</a>
                                <a href="#" class="btn btn-sm btn-warning rounded-pill px-2 py-1">Edit</a> --}}
                                <td>
                                    <div class="td-actions">
                                        <!-- View Button (Eye Icon) -->

                                        <!-- Approve Button (Check Icon) -->
                                        <a href="#" class="icon text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{ $account->application_approved_by == null ? 'Approve Application' : 'Quick View' }}"
                                            onclick="openLoanModal({{ $account->id }})">
                                            <i
                                                class="fas {{ $account->application_approved_by == null ? 'fa-check-circle' : 'fa-eye' }}"></i>
                                        </a>


                                        <!-- Show delete button if not yet approved -->
                                        @if($account->application_approved_by == null)
                                        <!-- Delete Button (Trash Icon) -->
                                        <form action="{{ route('LoanADApplication.delete', $account->id) }}"
                                            method="POST" class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this application?');">
                                            @csrf
                                            <button type="submit" class="icon red btn btn-link text-danger p-0 m-0"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                data-bs-original-title="Delete Row">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>

                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">No loan applications found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <div class="footer-info">
                    Total Records: {{ $accounts->total() }}
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    {{ $accounts->links('vendor.pagination.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>


<!---model for showing the daata --->
<!-- Approve/View Modal -->
<!-- Loan Application Modal -->
<!-- PDF Export JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Loan Application Modal -->
<div class="modal fade" id="loanAppModal" tabindex="-1" aria-labelledby="loanAppModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen  modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white py-3 px-4 rounded-top">
                <h5 class="modal-title fw-semibold" id="loanAppModalLabel">
                    <i class="fas fa-file-alt me-2"></i>Loan Application Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 py-4" id="loanModalContent">

                <!-- Member Details -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3">
                        <i class="fas fa-user me-1 text-primary"></i> Member Details
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-3"><strong>Member Code :</strong> <span id="member_code"
                                class="text-dark"></span></div>
                        <div class="col-md-3"><strong>Branch :</strong> <span id="branch_name" class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Name :</strong> <span id="member_name" class="text-dark"></span>
                        </div>

                        {{-- <div class="col-md-3"><strong>Gender :</strong> <span id="gender_name"
                                class="text-dark"></span>
                        </div> --}}

                        <div class="col-md-3"><strong>Father :</strong> <span id="father_name" class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Mother :</strong> <span id="mother_name" class="text-dark"></span>
                        </div>
                        <div class="col-md-3"><strong>Gender :</strong> <span id="gender" class="text-dark"></span>
                        </div>
                        <div class="col-md-3"><strong>Matiral Status :</strong> <span id="marital_status"
                                class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Spouse :</strong> <span id="spouse" class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Phone No :</strong> <span id="phone_number"
                                class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Email :</strong> <span id="email" class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>City :</strong> <span id="city" class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Address :</strong> <span id="address" class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Occupation :</strong> <span id="occupation"
                                class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Monthly Income :</strong> <span id="monthly_income"
                                class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Annual Income :</strong> <span id="annual_income"
                                class="text-dark"></span>
                        </div>



                        {{-- <div class="col-md-3"><strong>Mother :</strong> <span id="mother_name"
                                class="text-dark"></span>
                        </div>

                        <div class="col-md-3"><strong>Marital_status :</strong> <span id="marital_status"
                                class="text-dark"></span>
                        </div> --}}

                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3">
                        <i class="fas fa-file-alt me-1 text-primary"></i> Important Doc Details
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-3"><strong>Aadhaar Number :</strong> <span id="aadhaar_number"
                                class="text-dark"></span></div>
                        <div class="col-md-3"><strong>Pan Number :</strong> <span id="pan_number"
                                class="text-dark"></span>
                        </div>
                        <div class="col-md-3"><strong>Voter ID :</strong> <span id="voter_number"
                                class="text-dark"></span>
                        </div>
                        <div class="col-md-3"><strong>DL No :</strong> <span id="dl_number" class="text-dark"></span>
                        </div>
                    </div>
                </div>

                <!-- Loan Details -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3">
                        <i class="fas fa-hand-holding-usd me-1 text-success"></i> Loan Application Details
                    </h6>
                    <div class="row g-2">
                        <div class="col-md-3"><strong>Application No :</strong> <span id="application_number"
                                class="text-dark"></span></div>
                        <div class="col-md-3"><strong>Requested Amount :</strong> ₹<span id="requested_amount"
                                class="text-dark"></span></div>

                        <div class="col-md-3"><strong>Asset Type :</strong> <span id="asset_type"
                                class="text-dark"></span></div>

                        <div class="col-md-3"><strong>Asset Value :</strong> ₹<span id="asset_value"
                                class="text-dark"></span></div>

                        <div class="col-md-3"><strong>Asset Paid :</strong> ₹<span id="asset_paid"
                                class="text-dark"></span></div>

                        <div class="col-md-3"><strong>Eligible Amount :</strong> ₹<span id="eligible_amount"
                                class="text-dark"></span>
                        </div>
                        <div class="col-md-3"><strong>Market :</strong> <span id="market_name" class="text-dark"></span>
                        </div>
                        <div class="col-md-3"><strong>Associate :</strong> <span id="associated_name"
                                class="text-dark"></span></div>
                    </div>
                </div>

                <!-- Approval Details -->
                <div id="approval_summary" class="mb-3">
                    <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3">
                        <i class="fas fa-check-circle me-1 text-info"></i> Approval Summary
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <strong>Status :</strong>
                            <span id="loan_status" class="badge text-uppercase px-2 py-1 fw-bold"></span>
                        </div>
                        <div class="col-md-2"><strong>Amount :</strong> ₹<span id="approved_amount"
                                class="text-dark"></span></div>
                        <div class="col-md-2"><strong>Interest Rate :</strong> <span id="interest_rate"
                                class="text-dark"></span>%</div>
                        <div class="col-md-2"><strong>EMI :</strong> ₹<span id="emi_amount" class="text-dark"></span>
                        </div>
                        <div class="col-md-2"><strong>No of EMI's :</strong> <span id="emi_no" class="text-dark"></span>
                        </div>
                        <div class="col-md-2"><strong>Total Payable :</strong> ₹<span id="total_payable"
                                class="text-dark"></span>
                        </div>
                    </div>
                </div>

                <form id="loanActionForm" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Approval Details when pending -->
                    <div id="approval_pending" class="mb-3" style="display:none;">
                        <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3">
                            <i class="fas fa-hourglass-half me-1 text-warning"></i> Approval Pending
                        </h6>
                        <p class="text-muted">Your application is still pending. Approval details will appear once
                            approved.
                        </p>

                        <div class="row">
                            <input type="hidden" id="rdPlanId" value="" />
                            <input type="hidden" id="ApplicationId" name="applicationId" value="" />
                            <!-- Approval Amount Input -->
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="field-wrapper">
                                    <input type="number" step="0.01" class="form-control" id="approvalAmount"
                                        name="approval_amount" placeholder="Enter approval amount" />
                                    <div class="field-placeholder">Approval Amount</div>
                                </div>
                            </div>

                            <!-- EMI Type Select -->
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="field-wrapper">
                                    <select class="form-control" id="emiType" name="emi_type">
                                        <option value="daily">Daily</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="annually">Annually</option>
                                    </select>
                                    <div class="field-placeholder">EMI Type</div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 d-flex align-items-end">
                                <div class="field-wrapper w-100">
                                    <button type="button" class="btn btn-primary w-100" id="checkEmiButton">
                                        <i class='bx bx-calculator'></i> Check Amount & EMIs
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="row gutters mt-3">
                            <!-- Loan Approval Amount (Calculated) -->
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="field-wrapper">
                                    <div class="field-placeholder">Loan Amount</div>
                                    <div class="field-value" id="loanApprovalAmounts"></div>
                                </div>
                            </div>

                            <!-- Interest Percentage (Calculated) -->
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <div class="field-placeholder">Interest Percentage</div>
                                    <div class="field-value" id="interestPercentage"></div>
                                </div>
                            </div>

                            <!-- EMI Amount (Calculated) -->
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <div class="field-placeholder">EMI Amount</div>
                                    <div class="field-value" id="emiAmount"></div>
                                </div>
                            </div>

                            <!-- Number of EMIs (Calculated) -->
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <div class="field-placeholder">Number of EMIs</div>
                                    <div class="field-value" id="emiCount"></div>
                                </div>
                            </div>

                            <!-- Total Payable Amount (Calculated) -->
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="field-wrapper">
                                    <div class="field-placeholder">Total Payable Amount</div>
                                    <div class="field-value" id="payableAmount"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>


            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light rounded-bottom px-4 py-3">
                <button class="btn btn-outline-secondary me-auto" onclick="exportPDF()">
                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                </button>
                <button type="button" class="btn btn-danger" id="rejectBtn" onclick="submitLoanAction('reject')">
                    <i class="fas fa-times-circle me-1"></i> Reject
                </button>
                <button type="button" class="btn btn-success" id="approveBtn" onclick="submitLoanAction('approve')">
                    <i class="fas fa-check-circle me-1"></i> Approve
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>

</div>




<!---end of the mdoel showing the data --->


@endsection

@section('script')
<script>
    // For printing the Savings Account table content
    setupPrintButton('export-print', 'account-table');
</script>

<script>
    function openLoanModal(id) {
        // Optionally show a loader
        
       
        fetch(`/loan-ad-application/${id}`)
            .then(response => response.json())
            .then(data => {
                // Fill in the modal fields with raw data from backend
                document.getElementById('member_code').innerText = data.member?.member_code ?? 'N/A';
                document.getElementById('member_name').innerText = `${data.member?.first_name ?? ''} ${data.member?.middle_name ?? ''} ${data.member?.last_name ?? ''}`;
                document.getElementById('branch_name').innerText = data.branch?.branch_name ?? 'N/A';

                document.getElementById('father_name').innerText = data.member?.father_name ?? 'N/A';

                document.getElementById('mother_name').innerText = data.member?.mother_name ?? 'N/A';
                document.getElementById('gender').innerText = data.member?.gender ?? 'N/A';
                document.getElementById('marital_status').innerText = data.member?.marital_status ?? 'N/A';
                document.getElementById('spouse').innerText = data.member?.husband_spouse ?? 'N/A';

                document.getElementById('phone_number').innerText = data.member?.mobile_number ?? 'N/A';
                document.getElementById('email').innerText = data.member?.email ?? 'N/A';
                document.getElementById('city').innerText = data.member?.city ?? 'N/A';
                document.getElementById('address').innerText = `${data.member?.permanent_address ?? 'N/A'}, ${data.member?.permanent_state ?? ''}, ${data.member?.permanent_pincode ?? ''}`;
                // document.getElementById('mother_name').innerText = data.member?.mother_name ?? 'N/A';
                // document.getElementById('marital_status').innerText = data.member?.marital_status ?? 'N/A';

                document.getElementById('occupation').innerText = data.member?.occupation ?? 'N/A';
                document.getElementById('annual_income').innerText = `₹ ${parseFloat(data.member?.annual_income ?? 0).toFixed(2)}`;    
                document.getElementById('monthly_income').innerText = `₹ ${parseFloat(data.member?.monthly_income ?? 0).toFixed(2)}`;

                document.getElementById('aadhaar_number').innerText = data.member?.aadhaar_number ?? 'N/A';
                document.getElementById('pan_number').innerText = data.member?.pan_number ?? 'N/A';     
                document.getElementById('voter_number').innerText = data.member?.voter_number ?? 'N/A';
                document.getElementById('dl_number').innerText = data.member?.dl_number ?? 'N/A';

                document.getElementById('application_number').innerText = data.application_number ?? 'N/A';
                document.getElementById('requested_amount').innerText = parseFloat(data.application_balance ?? 0).toFixed(2);
                document.getElementById('asset_type').innerText = `(${data.asset_type}), ${data.ac_no}`;
                document.getElementById('asset_value').innerText = parseFloat(data.rd_principal_amount ?? 0).toFixed(2);
                document.getElementById('asset_paid').innerText = parseFloat(data.rd_balance ?? 0).toFixed(2);
                document.getElementById('eligible_amount').innerText = parseFloat(data.eligible_loan_amount ?? 0).toFixed(2);

                document.getElementById('market_name').innerText = `${data.marketcode?.area_name ?? 'N/A'} - ${data.marketcode?.code ?? 'N/A'}`;
                document.getElementById('associated_name').innerText = data.associated?.name ?? 'N/A';




                if (data.application_status !== 'pending') {
                    // Show approval_summary section
                    document.getElementById('approval_summary').style.display = 'block';
                    document.getElementById('approval_pending').style.display = 'none';

                    document.getElementById('approveBtn').style.display = 'none';
                    document.getElementById('rejectBtn').style.display = 'none';
                    
                    
                    // Fill the approval data
                    document.getElementById('approved_amount').innerText = parseFloat(data.approved_balance ?? 0).toFixed(2);
                    document.getElementById('interest_rate').innerText = parseFloat(data.interest_rate ?? 0).toFixed(2);
                    document.getElementById('emi_amount').innerText = `${parseFloat(data.emi_amount ?? 0).toFixed(2)} / ${data.emi_type}`;
                    document.getElementById('emi_no').innerText = data.number_of_emis;
                    document.getElementById('total_payable').innerText = parseFloat(data.total_payable_amount ?? 0).toFixed(2);

                    const statusElement = document.getElementById('loan_status');

                    if (data.application_status === 'approved') {
                        statusElement.innerText = 'Approved';
                        statusElement.classList.add('bg-success', 'text-white');
                        statusElement.classList.remove('bg-danger', 'bg-warning');
                    } else if (data.application_status === 'rejected') {
                        statusElement.innerText = 'Rejected';
                        statusElement.classList.add('bg-danger', 'text-white');
                        statusElement.classList.remove('bg-success', 'bg-warning');
                    } else {
                        statusElement.innerText = 'Pending';
                        statusElement.classList.add('bg-warning', 'text-dark');
                        statusElement.classList.remove('bg-success', 'bg-danger');
                    }

                } else {
                    // Show the pending section instead

                   

                    document.getElementById('approval_summary').style.display = 'none';
                    document.getElementById('approval_pending').style.display = 'block';
                    document.getElementById('rdPlanId').value = data.plan_id;
                    document.getElementById('ApplicationId').value = data.id;
                }



                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('loanAppModal'));
                modal.show();
            })
            .catch(error => {
                console.error('Error loading loan data:', error);
                alert(error);
            });
    }

    function exportPDF() {
        const element = document.getElementById('loanModalContent');
        const opt = {
            margin: 0.5,
            filename: 'loan-application-details.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const checkEmiButton = document.getElementById('checkEmiButton');
        const emiTypeSelect = document.getElementById('emiType');
        const approvalAmountInput = document.getElementById('approvalAmount');

        const loanApprovalAmountDiv = document.getElementById('loanApprovalAmounts');
        const interestPercentageDiv = document.getElementById('interestPercentage');
        const emiAmountDiv = document.getElementById('emiAmount');
        const emiCountDiv = document.getElementById('emiCount');
        const payableAmountDiv = document.getElementById('payableAmount');


        checkEmiButton.addEventListener('click', function () {
            const originalButtonHTML = checkEmiButton.innerHTML;
            checkEmiButton.disabled = true;
            checkEmiButton.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Calculating...`;

             // Replace with actual way you store the RD Plan ID
            const rdPlanId = document.getElementById('rdPlanId').value;



            const emiType = emiTypeSelect.value;
            const approvalAmount = parseFloat(approvalAmountInput.value || 0);

            if (!rdPlanId) {
                alert("RD Plan ID is missing.");
                checkEmiButton.innerHTML = originalButtonHTML;
                checkEmiButton.disabled = false;
                return;
            }

            fetch('/check-emi-details', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    rd_plan_id: rdPlanId,
                    emi_type: emiType,
                    requested_amount: approvalAmount
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
                    alert('Something went wrong while calculating EMI details.');
                })
                .finally(() => {
                    checkEmiButton.innerHTML = originalButtonHTML;
                    checkEmiButton.disabled = false;
                });
        });
    });


    function submitLoanAction(actionType) {
        const loanId = document.getElementById('ApplicationId').value;
        if (!loanId) {
            alert('Loan ID missing!');
            return;
        }

        // If actionType is 'approve', validate approvalAmount and emiType
        if (actionType === 'approve') {
            const approvalAmount = document.getElementById('approvalAmount').value.trim();
            const emiType = document.getElementById('emiType').value.trim();

            if (!approvalAmount || isNaN(approvalAmount) || Number(approvalAmount) <= 0) {
                alert('Please enter a valid approval amount greater than 0.');
                return;
            }

            if (!emiType) {
                alert('Please select an EMI Type.');
                return;
            }
        }

        // Get button element to show loading effect
        const btnId = actionType === 'approve' ? 'approveBtn' : 'rejectBtn';
        const btn = document.getElementById(btnId);

        btn.disabled = true;
        const originalText = btn.innerHTML;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...`;

        // Submit form
        const form = document.getElementById('loanActionForm');
        form.action = `/loan-ad-application/${loanId}/${actionType}`;
        form.submit();
    }


</script>

@endsection