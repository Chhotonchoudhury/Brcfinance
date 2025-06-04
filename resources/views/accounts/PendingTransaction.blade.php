@extends('layouts.app')

@section('title') All Transactions @endsection

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
</style>
@endsection

@section('content')


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
                        <form method="GET" id="search-form" action="{{ route('pending.transaction') }}">
                            <div class="row">
                                <!-- Branch -->
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select
                                                class="form-control js-states select2 @error('branch_id') is-invalid @enderror"
                                                id="branch-select" name="branch_id">
                                                <option value="" {{ old('branch_id')=='' ? 'selected' : '' }}>Select
                                                    Branch
                                                </option>
                                                @foreach($branches as $branch)
                                                <option value="{{ $branch->id }}" {{ old('branch_id')==$branch->id ?
                                                    'selected'
                                                    : '' }}>
                                                    {{ $branch->branch_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field-placeholder">Branch <span class="text-danger">*</span></div>
                                        @error('branch_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Users -->
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select
                                                class="form-control js-states select2 @error('employee_id') is-invalid @enderror"
                                                id="employee-select" name="employee_id">
                                                <option value="" {{ old('employee_id')=='' ? 'selected' : '' }}>Select
                                                    employees
                                                </option>

                                            </select>
                                        </div>
                                        <div class="field-placeholder">Employees <span class="text-danger">*</span>
                                        </div>
                                        @error('employee_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Acccounts -->
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select
                                                class="form-control js-states select2 @error('account_type') is-invalid @enderror"
                                                id="select2" name="account_type">
                                                <option value="" {{ old('account_type')=='' ? 'selected' : '' }}>Select
                                                    Accounts
                                                </option>
                                                <option value="savings">Savings</option>
                                                <option value="rd">RD</option>
                                                <option value="fd">FD</option>
                                                <option value="all">All</option>
                                            </select>
                                        </div>
                                        <div class="field-placeholder">Accounts <span class="text-danger">*</span></div>
                                        @error('account_type')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <input
                                                class="form-control @error('date_range') is-invalid @enderror custom-daterange"
                                                type="text" name="date_range" value="{{ old('date_range') }}" required>
                                            <span class="input-group-text">
                                                <i class="icon-calendar1"></i>
                                            </span>
                                        </div>
                                        <div class="field-placeholder">Date Ranges <span class="text-danger">*</span>
                                        </div>
                                        @error('date_range')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                    <form method="POST" action="{{ route('transactions.approve.multiple') }}"
                        onsubmit="return confirm('Are you sure you want to approve the selected transactions?');">
                        @csrf
                        <!-- Search Form with Export and Print Buttons on the Same Row -->

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <!-- Date Range Picker -->

                            <!-- Select All Checkbox -->

                            {{-- <input class="form-check-input" type="checkbox" id="select-all"> --}}
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
                                @php
                                $totalDebit = 0;
                                $totalCredit = 0;
                                @endphp

                                @if($transactions->isEmpty())
                                <tr>
                                    <td colspan="11" class="text-center">No Records Found</td>
                                </tr>
                                @else
                                @foreach($transactions as $key => $transaction)
                                @php
                                // Highlight rejected transactions with a subtle red background
                                $rowClass = $transaction->status == 'rejected' ? 'table-danger' : '';
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td>
                                        @if($transaction->status == 'pending')
                                        <input type="checkbox" class="row-checkbox" name="selected_transactions[]"
                                            value="{{ $transaction->id }}">
                                        @endif

                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $transaction->transaction->branch->branch_name ?? 'N/A' }}</td>
                                    <td>{{ $transaction->account_type }}</td>
                                    <td>
                                        @if($transaction->transaction && $transaction->transaction->member)
                                        {{ $transaction->transaction->member->first_name ?? 'N/A' }}
                                        {{ $transaction->transaction->member->middle_name ? ' ' .
                                        $transaction->transaction->member->middle_name : '' }}
                                        {{ $transaction->transaction->member->last_name ?? 'N/A' }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>{{ $transaction->transaction->account_number ?? 'N/A' }}</td>
                                    <td>{{ $transaction->producedBy->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('F j, Y h:i A')
                                        }}
                                    </td>
                                    <td>

                                        @if($transaction->action_type == 'withdrawal')
                                        <span class="text-danger">{{ $transaction->action_type }}</span>
                                        @if($transaction->status != 'rejected')
                                        @php $totalDebit += $transaction->amount; @endphp
                                        @endif
                                        @else
                                        <span class="text-success">{{ $transaction->action_type }}</span>
                                        @if($transaction->status != 'rejected')
                                        @php $totalCredit += $transaction->amount; @endphp
                                        @endif
                                        @endif

                                    </td>
                                    <td>
                                        @if($transaction->action_type == 'withdrawal')
                                        <span class="text-danger">- {{ number_format($transaction->amount, 2) }}</span>
                                        @else
                                        <span class="text-success">+ {{ number_format($transaction->amount, 2) }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($transaction->status == 'pending')
                                        <!-- Approve Single Transaction Form -->
                                        <form method="POST"
                                            action="{{ route('transactions.approve.single', $transaction->id) }}"
                                            onsubmit="return confirm('Are you sure you want to approve this transaction?');"
                                            style="display: inline-block;">
                                            @csrf
                                            <!-- Individual Approve Button -->
                                            <button type="submit" class="btn btn-sm btn-outline-success approve-btn"
                                                style="font-size: 0.50rem; padding: 0.20rem 0.5rem;"
                                                data-id="{{ $transaction->id }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Approve Transaction">
                                                <i class="fa fa-check"></i>
                                            </button>

                                        </form>

                                        <form method="POST"
                                            action="{{ route('transactions.revert', $transaction->id) }}"
                                            onsubmit="return confirm('Are you sure you want to revert this transaction?');"
                                            style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger "
                                                style="font-size: 0.50rem; padding: 0.20rem 0.5rem;"
                                                data-id="{{ $transaction->id }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Revert Transaction">
                                                <span class="icon-undo"></span>
                                            </button>
                                        </form>
                                        @else
                                        @php
                                        $statusClasses = [
                                        'pending' => 'bg-warning text-dark',
                                        'approved' => 'bg-success text-white',
                                        'rejected' => 'bg-danger text-white'
                                        ];
                                        @endphp
                                        <span
                                            class="badge {{ $statusClasses[$transaction->status] ?? 'bg-secondary' }}  rounded-pill shadow-sm">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="9" style="text-align: right;">Total Debit:</td>
                                    <td style="font-weight: bold;">
                                        <span class="text-danger">{{ number_format($totalDebit, 2) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9" style="text-align: right;">Total Credit:</td>
                                    <td style="font-weight: bold;">
                                        <span class="text-success">{{ number_format($totalCredit, 2) }}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <div class="footer-info">
                    Total Records: @if($transactions->isEmpty()) 0 @else {{ $transactions->count() }} @endif
                </div>


                <!-- Pagination -->
                <div class="pagination-container">
                    {{-- {{ $transactions->links('vendor.pagination.custom-pagination') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
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
@endsection