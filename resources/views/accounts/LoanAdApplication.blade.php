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
            <div class="d-flex justify-content-between align-items-center bg-light w-100 mb-2" style="height: 40px;">
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

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-3" id="loanTabs" role="tablist">

                <li class="nav-item" role="presentation">
                    <a href="{{ route('LoanADApplication.index') }}"
                    class="nav-link {{ request()->routeIs('LoanADApplication.index') ? 'active' : '' }}"
                    id="pending-tab" role="tab">
                       Pending Applications
                    </a>
                </li>


                <li class="nav-item" role="presentation">
                    <a href="{{ route('LoanADApplication.app') }}"
                    class="nav-link {{ request()->routeIs('LoanADApplication.app') ? 'active' : '' }}"
                    id="approved-tab" role="tab">
                        Approved Applications
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <!-- <button class="nav-link" id="doc-tab" data-bs-toggle="tab" data-bs-target="#doc" type="button" role="tab">
                    Under doc Verify
                    </button> -->

                    <a href="{{ route('LoanADApplication.underDocVerify') }}"
                    class="nav-link {{ request()->routeIs('LoanADApplication.underDocVerify') ? 'active' : '' }}"
                    id="doc-tab" role="tab">
                        under dcoument verification
                    </a>
                </li>


                <li class="nav-item bg-danger text-white" role="presentation">

                     <a href="{{ route('LoanADApplication.reject') }}"
                    class="nav-link {{ request()->routeIs('LoanADApplication.reject') ? 'active' : '' }}"
                    id="rejected-tab" role="tab">
                        Rejected
                    </a>
                    
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="loanTabContent">

                <div class="tab-pane fade {{ request()->routeIs('LoanADApplication.index') ? 'show active' : '' }}" id="pending" role="tabpanel">

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
                                           <td colspan="14" class="text-center py-5">
                                                <img src="{{ asset('assetsDashboard/img/stock/NoRecord.jpg') }}" alt="No Data Found"
                                                    style="width: 200px; opacity: 0.7;">
                                                <div class="mt-4 text-muted fs-5">No loan applications found.</div>
                                            </td>
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

                <div class="tab-pane fade {{ request()->routeIs('LoanADApplication.app') ? 'show active' : '' }}" id="approved" role="tabpanel">
                     <div class="card-body">
                        <div class="table-responsive">
                            <!-- Search Form with Export and Print Buttons on the Same Row -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <!-- Left side: Search Form -->
                                <form method="GET" action="{{ route('LoanADApplication.app') }}"
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

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Application No</th>
                                        <th>Member</th>
                                        <th>Branch</th>
                                        <th>Market</th>
                                        <th>Against</th>
                                        <th>Requested Loan</th>
                                        <th>Approved Loan</th>
                                        <th>Applicant</th>
                                        <th>Status</th>
                                        <th>Approver</th>
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accounts as $index => $account)
                                    <tr class="{{ $account->application_status === 'approved' ? 'table-secondary' : '' }}">

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
                                        <td>₹ {{ number_format($account->approved_balance, 2) }}</td>
                                        <td>{{ $account->applicant->name ?? 'NA' }}</td>



                                        @php
                                            $statusColorMap = [
                                                'pending' => 'warning',
                                                'approved' => 'success',
                                                'under_document_verification' => 'info',
                                                'document_verified' => 'primary',
                                                'under_disbursement' => 'secondary',
                                                'disbursed' => 'dark',
                                                'rejected' => 'danger',
                                            ];

                                            $statusTextMap = [
                                                'pending' => 'Pending',
                                                'approved' => 'Approved',
                                                'under_document_verification' => 'Under Document Verification',
                                                'document_verified' => 'Document Verified',
                                                'under_disbursement' => 'Under Disbursement',
                                                'disbursed' => 'Disbursed',
                                                'rejected' => 'Rejected',
                                            ];

                                            $status = $account->application_status;
                                        @endphp

                                        <td>
                                            <span class="badge bg-{{ $statusColorMap[$status] ?? 'secondary' }}">
                                                {{ $statusTextMap[$status] ?? ucfirst($status) }}
                                            </span>
                                        </td>


                                        <td>
                                            @if ($account->application_approved_by && $account->application_approved_at)
                                            {{ $account->applicationApprovedBy->name }}<br>
                                            {{ \Carbon\Carbon::parse($account->application_approved_at)->format('d-m-Y') }}
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

                                                
                                                    <!-- New: Send for Document Verification Button -->
                                                @if($account->application_status === 'approved')
                                                    <form method="POST"
                                                        action="{{ route('LoanADApplication.sendForVerification', $account->id) }}"
                                                        class="d-inline-block"
                                                        onsubmit="return confirmSendForVerification(this)">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="icon btn btn-link text-warning p-0 m-0 ms-2"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Send for Document Verification"
                                                            id="verifyBtn{{ $account->id }}">
                                                            <span class="btn-text"><i class="fas fa-share-square"></i></span>
                                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                        </button>
                                                    </form>
                                                @endif




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
                                           <td colspan="14" class="text-center py-5">
                                                <img src="{{ asset('assetsDashboard/img/stock/NoRecord.jpg') }}" alt="No Data Found"
                                                    style="width: 200px; opacity: 0.7;">
                                                <div class="mt-4 text-muted fs-5">No approved loan applications found.</div>
                                            </td>
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

                <div class="tab-pane fade {{ request()->routeIs('LoanADApplication.underDocVerify') ? 'show active' : '' }}" id="doc" role="tabpanel">
                     <div class="card-body">
                        <div class="table-responsive">
                            <!-- Search Form with Export and Print Buttons on the Same Row -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <!-- Left side: Search Form -->
                                <form method="GET" action="{{ route('LoanADApplication.reject') }}"
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

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Application No</th>
                                        <th>Member</th>
                                        <th>Branch</th>
                                        <th>Market</th>
                                 
                                        <th>Requested Loan</th>
                                      
                                        
                                        <th>Applicant</th>
                                        <th>Status</th>
                                        <th>Approver</th>
                                        
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
                                        <td>₹ {{ number_format($account->application_balance, 2) }}</td>
                                        <td>{{ $account->applicant->name ?? 'NA' }}</td>
                                        

                                        <td><span
                                                class="badge bg-{{ $account->application_status == 'under_document_verification' ? 'success' : ($account->application_status == 'document_verified' ? 'warning' : 'danger') }}">{{
                                                ucfirst($account->application_status) }}</span></td>
                                        <td>
                                            @if ($account->application_approved_by && $account->application_approved_at)
                                            {{ $account->applicationApprovedBy->name }}<br>
                                            {{ \Carbon\Carbon::parse($account->application_approved_at)->format('d-m-Y') }}
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


                                                <!-- Document Verification Button -->
                                                <a href="{{ route('loan-documents.edit', $account->id) }}" 
                                                    class="icon text-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Verify Documents">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>



                                                <!-- Show delete button if not yet approved -->
                                                
                                                <!-- Delete Button (Trash Icon) -->
                                                <!-- <form action="{{ route('LoanADApplication.delete', $account->id) }}"
                                                    method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this application?');">
                                                    @csrf
                                                    <button type="submit" class="icon red btn btn-link text-danger p-0 m-0"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-bs-original-title="Delete Row">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form> -->
                                               
                                            </div>

                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                           <td colspan="14" class="text-center py-5">
                                                <img src="{{ asset('assetsDashboard/img/stock/NoRecord.jpg') }}" alt="No Data Found"
                                                    style="width: 200px; opacity: 0.7;">
                                                <div class="mt-4 text-muted fs-5">No loan applications found.</div>
                                            </td>
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

                <div class="tab-pane fade {{ request()->routeIs('LoanADApplication.reject') ? 'show active' : '' }}" id="rejected" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Search Form with Export and Print Buttons on the Same Row -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <!-- Left side: Search Form -->
                                <form method="GET" action="{{ route('LoanADApplication.reject') }}"
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
                                 
                                        <th>Requested Loan</th>
                                      
                                        
                                        <th>Applicant</th>
                                        <th>Status</th>
                                        <th>Approver</th>
                                        <th>Rejector</th>
                                        <th>Rejection reason</th>
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
                                        <td>₹ {{ number_format($account->application_balance, 2) }}</td>
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
                                        <td>{{$account->rejection_reason}}</td>

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
                                               
                                            </div>

                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                           <td colspan="14" class="text-center py-5">
                                                <img src="{{ asset('assetsDashboard/img/stock/NoRecord.jpg') }}" alt="No Data Found"
                                                    style="width: 200px; opacity: 0.7;">
                                                <div class="mt-4 text-muted fs-5">No loan applications found.</div>
                                            </td>
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
            <div class="modal-header border-0 py-2 px-3" style="
                background: linear-gradient(to right, #a8edea, #fed6e3); 
                color: #333;
                border-top-left-radius: 0.6rem;
                border-top-right-radius: 0.6rem;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-file-alt fs-5" style="color: rgba(51, 51, 51, 0.8);"></i>
                    <h6 class="modal-title fw-semibold mb-0" id="loanAppModalLabel">Loan Application Details</h6>
                </div>

                <button type="button" class="btn btn-sm btn-light bg-white bg-opacity-50 border-0 rounded-circle shadow-sm"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-xmark small text-dark"></i>
                </button>
            </div>





            <!-- Modal Body -->
            <div class="modal-body px-3 py-3" id="loanModalContent">

                <!-- Member Details -->
               <div class="border rounded-10 shadow-sm p-4 mb-1 bg-white">
                    <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                        <i class="fas fa-user-circle text-primary me-2 fs-4"></i>
                        <h6 class="mb-0 text-dark fw-semibold text-uppercase">Member Details</h6>
                    </div>

                    <div class="row g-3 text-sm text-dark">
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Member Code</div>
                            <div id="member_code" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Branch</div>
                            <div id="branch_name" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Name</div>
                            <div id="member_name" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Father</div>
                            <div id="father_name" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Mother</div>
                            <div id="mother_name" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Gender</div>
                            <div id="gender" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Marital Status</div>
                            <div id="marital_status" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Spouse</div>
                            <div id="spouse" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Phone No</div>
                            <div id="phone_number" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Email</div>
                            <div id="email" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">City</div>
                            <div id="city" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Address</div>
                            <div id="address" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Occupation</div>
                            <div id="occupation" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Monthly Income</div>
                            <div id="monthly_income" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Annual Income</div>
                            <div id="annual_income" class="fw-semibold text-dark"></div>
                        </div>
                    </div>
                </div>


               <!--Doc Details --->
                <div class="border rounded-3 shadow-sm p-4 mb-1 bg-white">
                    <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                        <i class="fas fa-file-alt text-primary me-2 fs-5"></i>
                        <h6 class="mb-0 text-dark fw-semibold text-uppercase">Important Doc Details</h6>
                    </div>

                    <div class="row g-3 text-sm text-dark">
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Aadhaar Number</div>
                            <div id="aadhaar_number" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">PAN Number</div>
                            <div id="pan_number" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Voter ID</div>
                            <div id="voter_number" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">DL No</div>
                            <div id="dl_number" class="fw-semibold text-dark"></div>
                        </div>
                    </div>
                </div>


                <!-- Loan Details -->
                <div class="border rounded-3 shadow-sm p-4 mb-1 bg-white">
                    <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                        <i class="fas fa-hand-holding-usd text-success me-2 fs-5"></i>
                        <h6 class="mb-0 text-dark fw-semibold text-uppercase">Loan Application Details</h6>
                    </div>

                    <div class="row g-3 text-sm text-dark">
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Application No</div>
                            <div id="application_number" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Requested Amount</div>
                            <div>₹<span id="requested_amount" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Asset Type</div>
                            <div id="asset_type" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Asset Value</div>
                            <div>₹<span id="asset_value" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Asset Paid</div>
                            <div>₹<span id="asset_paid" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Eligible Amount</div>
                            <div>₹<span id="eligible_amount" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Market</div>
                            <div id="market_name" class="fw-semibold text-dark"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="fw-medium text-muted">Associate</div>
                            <div id="associated_name" class="fw-semibold text-dark"></div>
                        </div>
                    </div>
                </div>


                <!-- Approval Details -->
                <div id="approval_summary" class="border rounded-3 shadow-sm p-4 mb-1 bg-white">
                    <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                        <i class="fas fa-check-circle text-info me-2 fs-5"></i>
                        <h6 class="mb-0 text-dark fw-semibold text-uppercase">Approval Summary</h6>
                    </div>

                    <div class="row g-3 text-sm text-dark">
                        <div class="col-md-2">
                            <div class="fw-medium text-muted">Status</div>
                            <span id="loan_status" class="badge bg-info bg-opacity-75 text-white px-3 py-1 rounded-pill fw-semibold small text-uppercase"></span>
                        </div>
                        <div class="col-md-2">
                            <div class="fw-medium text-muted">Approved Amount</div>
                            <div>₹<span id="approved_amount" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-2">
                            <div class="fw-medium text-muted">Interest Rate</div>
                            <div><span id="interest_rate" class="fw-semibold text-dark"></span>%</div>
                        </div>
                        <div class="col-md-2">
                            <div class="fw-medium text-muted">EMI</div>
                            <div>₹<span id="emi_amount" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-2">
                            <div class="fw-medium text-muted">No. of EMIs</div>
                            <div><span id="emi_no" class="fw-semibold text-dark"></span></div>
                        </div>
                        <div class="col-md-2">
                            <div class="fw-medium text-muted">Total Payable</div>
                            <div>₹<span id="total_payable" class="fw-semibold text-dark"></span></div>
                        </div>
                    </div>
                </div>


                <form id="loanActionForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div id="approval_pending" class="mb-4 p-4 border rounded-3 shadow-sm bg-white" style="display: none;">
                        <!-- Header -->
                        <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                            <i class="fas fa-hourglass-half text-warning me-2 fs-5"></i>
                            <h6 class="mb-0 text-uppercase text-muted fw-semibold">Approval Pending</h6>
                        </div>

                        <p class="text-muted small mb-4">
                            Your application is still pending. Approval details will appear once approved.
                        </p>

                        <input type="hidden" id="rdPlanId" value="" />
                        <input type="hidden" id="ApplicationId" name="applicationId" value="" />

                        <!-- Approval Inputs -->
                        <div class="row g-3">
                            <!-- Approval Amount -->
                            <div class="col-md-4">
                                <label for="approvalAmount" class="form-label fw-semibold">Approval Amount</label>
                                <input type="number" step="0.01" class="form-control" id="approvalAmount" name="approval_amount"
                                    placeholder="Enter approval amount" />
                            </div>

                            <!-- EMI Type -->
                            <div class="col-md-4">
                                <label for="emiType" class="form-label fw-semibold">EMI Type</label>
                                <select class="form-select" id="emiType" name="emi_type">
                                    <option value="daily">Daily</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="annually">Annually</option>
                                </select>
                            </div>

                            <!-- Button -->
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-primary w-100" id="checkEmiButton">
                                    <i class='bx bx-calculator me-1'></i> Check Amount & EMIs
                                </button>
                            </div>
                        </div>

                        <!-- Result Summary -->
                        <div class="row g-4 mt-4">
                            <div class="col-md-3">
                                <div class="small text-muted fw-medium">Loan Amount</div>
                                <div id="loanApprovalAmounts" class="fs-6 fw-semibold text-dark"></div>
                            </div>
                            <div class="col-md-2">
                                <div class="small text-muted fw-medium">Interest %</div>
                                <div id="interestPercentage" class="fs-6 fw-semibold text-dark"></div>
                            </div>
                            <div class="col-md-2">
                                <div class="small text-muted fw-medium">EMI Amount</div>
                                <div id="emiAmount" class="fs-6 fw-semibold text-dark"></div>
                            </div>
                            <div class="col-md-2">
                                <div class="small text-muted fw-medium">No. of EMIs</div>
                                <div id="emiCount" class="fs-6 fw-semibold text-dark"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="small text-muted fw-medium">Total Payable</div>
                                <div id="payableAmount" class="fs-6 fw-semibold text-dark"></div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

            <!-- Modal Footer -->
         <div class="modal-footer bg-light rounded-bottom px-4 py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
    
    <!-- Left: Export PDF -->
    <button class="btn btn-outline-primary d-flex align-items-center" onclick="exportPDF()">
        <i class="fas fa-file-pdf me-2 text-danger fs-5"></i>
        <span>Export PDF</span>
    </button>

    <!-- Right: Action Buttons -->
    <div class="d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-danger d-none d-flex align-items-center px-3" id="rejectBtn" onclick="submitLoanAction('reject')">
            <i class="fas fa-times-circle me-2"></i> Reject
        </button>
                                         
        <button type="button" class="btn btn-success d-none d-flex align-items-center px-3" id="approveBtn" onclick="submitLoanAction('approve')">
            <i class="fas fa-check-circle me-2"></i> Approve
        </button>
        

        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">
            <i class="fas fa-times me-2"></i> Close
        </button>
    </div>
</div>


        </div>
    </div>

</div>
<!---end of the mdoel showing the data --->


<!-- Reject Reason Modal -->
<div class="modal fade" id="rejectReasonModal" tabindex="-1" aria-labelledby="rejectReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="rejectReasonForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectReasonModalLabel">Reject Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="loan_id" id="rejectLoanId">
                    <div class="mb-3">
                        <label for="reject_reason" class="form-label">Please enter reason for rejection:</label>
                        <textarea name="reject_reason" id="reject_reason" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="rejectSubmitBtn">
                        <span class="btn-text">Submit Rejection</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end of the section -->


<!-- Document Verification Modal -->
<div class="modal fade" id="documentVerificationModal" tabindex="-1" aria-labelledby="documentVerificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="documentVerificationModalLabel">Document Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="documentCards">
          <!-- Cards will be injected here dynamically -->
        </div>

        <!-- Extra Document Upload Section -->
        <hr>
        <h6>Add Additional Document</h6>
        <form id="extraDocumentForm">
          <div class="row g-2">
            <div class="col-md-4">
              <select class="form-select" name="extra_type" id="extraDocType" required>
                <option value="">Select Document Type</option>
                <option value="salary_slip">Salary Slip</option>
                <option value="income_proof">Income Proof</option>
              </select>
            </div>
            <div class="col-md-5">
              <input type="file" class="form-control" name="extra_file" id="extraDocFile" required>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-success w-100">Upload</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--end of the section okay -->


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

                //buttons 
                const approveBtn = document.getElementById('approveBtn');
                const rejectBtn = document.getElementById('rejectBtn');

                //set input values 
                document.getElementById('rdPlanId').value = data.plan_id;
                document.getElementById('ApplicationId').value = data.id;

                if (data.application_status === 'rejected') {
                    rejectBtn?.classList.add('d-none'); // Hide the button
                } else {
                    rejectBtn?.classList.remove('d-none'); // Show it
                }

                if (data.application_status !== 'pending') {
                    // Show approval_summary section
                    document.getElementById('approval_summary').style.display = 'block';
                    document.getElementById('approval_pending').style.display = 'none';
                    
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

                    // rejectBtn?.classList.remove('d-none');
                    
                    
                } else {
                    // Show the pending section instead

                    document.getElementById('approval_summary').style.display = 'none';
                    document.getElementById('approval_pending').style.display = 'block';
                   

                     // Hide the approve and reject buttons
                   approveBtn?.classList.remove('d-none');
                   rejectBtn?.classList.remove('d-none');

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

            // Submit the approve form directly
            const approveBtn = document.getElementById('approveBtn');
            approveBtn.disabled = true;
            approveBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...`;

            const form = document.getElementById('loanActionForm');
            form.action = `/loan-ad-application/${loanId}/approve`;
            form.submit();
        }

        if (actionType === 'reject') {
            // Open reject reason modal
            document.getElementById('rejectLoanId').value = loanId;
            const modal = new bootstrap.Modal(document.getElementById('rejectReasonModal'));
            modal.show();
        }
    }

    document.getElementById('rejectReasonForm').addEventListener('submit', function (e) {
        e.preventDefault();

            const loanId = document.getElementById('rejectLoanId').value;
            const reason = document.getElementById('reject_reason').value.trim();

            if (!reason) {
                alert("Please enter a rejection reason.");
                return;
            }

            // Loading animation
            const submitBtn = document.getElementById('rejectSubmitBtn');
            submitBtn.querySelector('.btn-text').classList.add('d-none');
            submitBtn.querySelector('.spinner-border').classList.remove('d-none');
            submitBtn.disabled = true;

            // Create a temporary form and submit manually
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/loan-ad-application/${loanId}/reject`;

            const csrf = document.querySelector('input[name="_token"]').cloneNode();
            form.appendChild(csrf);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);

            const reasonInput = document.createElement('input');
            reasonInput.type = 'hidden';
            reasonInput.name = 'reject_reason';
            reasonInput.value = reason;
            form.appendChild(reasonInput);

            document.body.appendChild(form);
            form.submit();
    });
    
    //send for document verification 

    function confirmSendForVerification(form) {
        if (!confirm("Send this application for document verification?")) return false;

        const button = form.querySelector("button[type='submit']");
        const icon = button.querySelector(".btn-text");
        const spinner = button.querySelector(".spinner-border");

        icon.classList.add('d-none');
        spinner.classList.remove('d-none');
        button.disabled = true;

        return true;
    }

   
//Document handeleing



</script>

@endsection