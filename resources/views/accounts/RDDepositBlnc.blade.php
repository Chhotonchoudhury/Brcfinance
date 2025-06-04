@extends('layouts.app')

@section('title') Rd Deposit Blance @endsection

@section('style')

@endsection

@section('content')


<div class="row gutters mb-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RD Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Deposit </li>

            </ol>
        </nav>
    </div>

</div>

<div class="row gutters ">
    <div class="card ">


        <!-- Main Card Container -->
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm rounded-3 border-0" style="max-width: 800px; width: 100%;">
                <div class="card-body p-1 mt-2">

                    <!-- Search Section -->
                    <div class="row g-2 ">
                        <div class="col-md-9">
                            <input type="text" id="account_search" class="form-control form-control-lg"
                                placeholder="Enter RD Account Number" aria-label="Account Number Search">
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="searchButton" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="card mb-2">

            <div class="" id="accountDetailsCard" style="display: none;">
                <div class="row gutters mb-1">
                    <!-- Branch Name -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <input class="form-control" type="text" value="" id="branchName" readonly>
                            <div class="field-placeholder">Branch</div>
                        </div>
                    </div>

                    <!-- Account Name -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <input class="form-control" type="text" value="" id="accountHolderName" readonly>
                            <div class="field-placeholder">Account Holder Name</div>
                        </div>
                    </div>

                    <!-- Account Number -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <input class="form-control" type="text" id="accountNumber" value="" readonly>
                            <div class="field-placeholder">Account Number</div>
                        </div>
                    </div>

                    <!-- Account Balance -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <input class="form-control" type="text" id="balance" value="" readonly>
                            <div class="field-placeholder">Balance</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message for account not found -->
            <div id="accountNotFoundMessage" class="alert alert-danger text-center mt-3"
                style="display: none; font-size: 1.0rem; font-weight: bold; padding: 5px; border-radius: 5px;">
                <p class="m-0"></p>
            </div>

        </div>

        <div class="card " id="transactionInput" style="display: none;">

            <form id="SaTran" action="{{ route('rdAc.transaction') }}" method="POST">
                @csrf
                <div class="card">

                    <input type="hidden" name="account_id" value="" id="account_id">
                    <input type="hidden" name="branch_id" value="" id="branch_id">
                    <!-- Payment Information Section -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Make Deposit of RD</div>
                    </div>

                    <div class="row gutters mb-1">
                        {{-- <input type="hidden" name="account_id" value="{{ $account->id }}">
                        <input type="hidden" name="branch_id" value="{{ $account->branch->id }}"> --}}
                        <!-- Payment Mode -->
                        {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <select class="form-control @error('payment_type') is-invalid @enderror" required
                                    id="paymentType" name="payment_type">
                                    <option value="" selected disabled>Type</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdrawal">Withdrawal</option>

                                </select>
                                <div class="field-placeholder">Payment type <span class="text-danger">*</span>
                                </div>
                                @error('payment_type') is-invalid @enderror
                            </div>
                            <!-- Field wrapper end -->
                        </div> --}}

                        <!--transaction Amount --->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control @error('amount') is-invalid @enderror" type="number"
                                    id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter Amount"
                                    required>
                                <div class="field-placeholder">Amount <span class="text-danger">*</span>
                                </div>

                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Field wrapper end -->
                        </div>

                        <!-- Transaction Date -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control @error('transaction_date') is-invalid @enderror" type="date"
                                    name="transaction_date" value="{{ old('transaction_date') }}" required>
                                <div class="field-placeholder">Transaction Date <span class="text-danger">*</span>
                                </div>
                                @error('transaction_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <!-- Payment Mode -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <select class="form-control @error('payment_mode') is-invalid @enderror"
                                    id="paymentMode" name="payment_mode" required>
                                    <option value="" selected disabled>Select Payment Mode</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="online">Online</option>
                                </select>
                                <div class="field-placeholder">Payment Mode <span class="text-danger">*</span>
                                </div>
                                @error('payment_mode') is-invalid @enderror
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
                                    <input class="form-control" type="number" name="cash_1" min="0" data-value="1">
                                    <div class="field-placeholder">₹1 Notes</div>
                                </div>
                                <!-- Field wrapper end -->
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_5" min="0" data-value="5">
                                    <div class="field-placeholder">₹5 Notes</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_10" min="0" data-value="10">
                                    <div class="field-placeholder">₹10 Notes</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_20" min="0" data-value="20">
                                    <div class="field-placeholder">₹20 Notes</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_50" min="0" data-value="50">
                                    <div class="field-placeholder">₹50 Notes</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_100" min="0" data-value="100">
                                    <div class="field-placeholder">₹100 Notes</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_200" min="0" data-value="200">
                                    <div class="field-placeholder">₹200 Notes</div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="number" name="cash_500" min="0" data-value="500">
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
                    <!-- Card Footer -->
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="footer-left">
                            <p class="text-muted mb-0 small"></p>
                        </div>
                        <div class="footer-right">

                            <button class="btn btn-sm btn-outline-success py-1 px-2" id="DDsubmitButton" type="submit">
                                <span class="icon-check_circle"></span>
                                <span id="DDbuttonText"> Make Payment </span>
                                <span id="DDloadingSpinner" class="spinner-border spinner-border-sm text-white d-none"
                                    role="status">
                                    <span class="visually-hidden">Payment creating...</span>
                                </span>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

@endsection



@section('script')

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

    //account serach 
    // Function to fetch account details based on the entered account number
    document.getElementById('searchButton').addEventListener('click', function () {
        const accountNumber = document.getElementById('account_search').value.trim();

        if (accountNumber === '') {
            alert('Please enter an account number.');
            return;
        }

        // Disable the button to prevent multiple clicks
        document.getElementById('searchButton').disabled = true;
        document.getElementById('searchButton').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';

        // Send a GET request to fetch account details from the backend
        fetch(`/get-RD/search?account_number=${accountNumber}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Account not found or error fetching details.');
                }
                return response.json();
            })
            .then(data => {
                // Reset the message and card display
                document.getElementById('accountNotFoundMessage').style.display = 'none';
                document.getElementById('accountDetailsCard').style.display = 'none';
                document.getElementById('transactionInput').style.display = 'none';
                // Display account details
                if (data.success) {

                  
                     // Set the account details in the card
                    document.getElementById('branchName').value = data.branch_name || '';
                    document.getElementById('accountHolderName').value = data.account_holder_name || '';
                    document.getElementById('accountNumber').value = data.account_number || '';
                    document.getElementById('balance').value = data.balance || '';
                    document.getElementById('account_id').value = data.id || '';
                    document.getElementById('branch_id').value = data.branch_id || '';
                    // Show the account details card
                    document.getElementById('accountDetailsCard').style.display = 'block';
                    document.getElementById('transactionInput').style.display = 'block';
                } else {
                    document.getElementById('accountNotFoundMessage').style.display = 'block';    
                    document.getElementById('accountNotFoundMessage').innerHTML = '<p>No account found with this number.</p>';
                }
            })
            .catch(error => {
                // console.error('Error fetching account details:', error);
                document.getElementById('accountDetailsCard').style.display = 'none';
                document.getElementById('transactionInput').style.display = 'none';
                document.getElementById('accountNotFoundMessage').style.display = 'block'; 
                document.getElementById('accountNotFoundMessage').innerHTML = `<p>${error.message || 'An unexpected error occurred. Please try again later.'}</p>`;
            })
            .finally(() => {
                // Enable the button after the request is completed
                document.getElementById('searchButton').disabled = false;
                document.getElementById('searchButton').innerHTML = '<i class="fas fa-search"></i> Search';
            });
    });



    //cash match 
    document.addEventListener("DOMContentLoaded", function () {
    const totalAmountInput = document.getElementById("amount"); // Assume there's an input for total amount
    const cashInputs = document.querySelectorAll("input[name^='cash_']");
    const cashSection = document.getElementById("cashSection");
    const matchStatus = document.createElement("div");
    matchStatus.style.fontWeight = "bold";
    cashSection.appendChild(matchStatus);

    function calculateTotalCash() {
        let totalCash = 0;
        cashInputs.forEach(input => {
            const denomination = parseInt(input.name.replace("cash_", ""), 10);
            const count = parseInt(input.value, 10) || 0;
            totalCash += denomination * count;
        });
        return totalCash;
    }

    function updateMatchStatus() {
        const totalCash = calculateTotalCash();
        const enteredAmount = parseInt(totalAmountInput.value, 10) || 0;
        if (totalCash === enteredAmount) {
            matchStatus.textContent = "✔ Cash Match";
            matchStatus.style.color = "green";
        } else {
            matchStatus.textContent = `✘ Mismatch: Entered ${enteredAmount}, Calculated ${totalCash}`;
            matchStatus.style.color = "red";
        }
    }

    cashInputs.forEach(input => {
        input.addEventListener("input", updateMatchStatus);
    });

    totalAmountInput.addEventListener("input", updateMatchStatus);
});

</script>
<script>
    new FormSubmitHandler('SaTran', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>
@endsection