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
                {{--
                <div class="me-2 d-flex align-items-center">
                    <input type="date" class="form-control form-control-sm me-2" style="width: 250px;height: 10px;"
                        id="transactionDate">
                    <button class="btn btn-sm btn-primary py-1 px-2" onclick="searchTransactions()">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div> --}}
                {{-- <div class="me-2">
                    <a href="{{ route('rdAc.create') }}" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"> </i> New RD Account
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                            role="status"></span>
                    </a>
                </div> --}}
            </div>

            <div class="card-body">
                <div class="table-responsive mb-0">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Date Range Picker -->
                        <form method="GET" id="search-form" action="{{ route('transaction.index') }}"
                            class="d-flex align-items-center">
                            <div class="field-wrapper mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control custom-daterange"
                                        placeholder="Select Date Range" name="date_range"
                                        value="{{ request()->input('date_range') }}">
                                    <span class="input-group-text">
                                        <i class="icon-calendar1"></i>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2" id="search-btn">
                                <i class="icon icon-search1 me-1"></i> <span id="btn-text">Search</span>
                                <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </form>
                        <!-- Search Bar -->

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            <!-- Print Button -->
                            @if(hasRolePermission('transaction-data-export'))
                            <button id="export-print" class="btn btn-sm btn-outline-success ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" title="Print">
                                <i class="icon-printer"></i> Print
                            </button>
                            @endif
                        </div>
                    </div>

                    <table id="account-table" class="table table-bordered table-striped table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Account Type</th>
                                <th>Member Name/Number</th>
                                <th>Account Number</th>
                                <th>produced by</th>
                                <th>Transaction Date</th>
                                <th>debited / credited</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalDebit = 0;
                            $totalCredit = 0;
                            @endphp
                            @if($transactions->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">No Records Found</td>
                            </tr>
                            @else

                            @foreach($transactions as $key => $transaction)
                            <tr class="@if($transaction->status == 'pending') table-warning @elseif($transaction->status
                                == 'rejected') table-danger @else '' @endif">
                                <td>{{ $key + 1 }}</td>
                                <td> @if($transaction->transaction)
                                    {{ $transaction->transaction->branch->branch_name ?? 'N/A' }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $transaction->account_type }}</td>
                                <td>
                                    @if($transaction->transaction && $transaction->transaction->member)
                                    {{
                                    $transaction->transaction->member->first_name ?? 'N/A' }}
                                    {{
                                    $transaction->transaction->member->middle_name ? ' ' .
                                    $transaction->transaction->member->middle_name : '' }}
                                    {{
                                    $transaction->transaction->member->last_name ?? 'N/A' }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->transaction)
                                    {{ $transaction->transaction->account_number ?? 'N/A' }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $transaction->producedBy->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format(' F j, Y h:i A')
                                    }}</td>

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
                                </td>
                            </tr>
                            @endforeach

                            @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="8" style="text-align: right;">Total :</td>
                                <td style="font-weight: bold;">
                                    Debit: <span class="text-danger">{{ number_format($totalDebit, 2) }}</span>
                                </td>

                            </tr>

                            <tr>
                                <td colspan="8" style="text-align: right;">Total :</td>
                                <td style="font-weight: bold;">
                                    Credit: <span class="text-success">{{ number_format($totalCredit, 2) }}</span>
                                </td>

                            </tr>
                        </tfoot>
                    </table>
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
@endsection