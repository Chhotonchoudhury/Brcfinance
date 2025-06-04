@extends('layouts.app')

@section('title') Savings Account List @endsection

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
            <div class="d-flex justify-content-between align-items-center bg-light w-100" style="height: 40px;">
                <div class="ms-2">
                    <h6 class="m-0">All Savings Accounts</h6>
                </div>
                <div class="me-2">
                    @if(hasRolePermission('savingsAC-create'))
                    <a href="{{ route('sa.create') }}" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"> </i> New Savings Account
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                            role="status"></span>
                    </a>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Left side: Search Form -->
                        <form method="GET" action="{{ route('sa.index') }}" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}"
                                placeholder="Search savings accounts..."
                                style="width: auto; min-height:30px; max-width: 300px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <i class="icon icon-search1 me-1"></i> Search
                            </button>
                        </form>

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            @if(hasRolePermission('savingsAC-data-export'))
                            <button id="export-print" class="btn btn-outline-success btn-sm ms-2" title="Print"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <span class="icon-printer"></span> Print
                            </button>
                            @endif
                        </div>
                    </div>

                    <table id="account-table" class="table table-bordered table-striped table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Plan Name</th>
                                <th>Account Number</th>
                                <th>Member Name</th>
                                <th>Member Code</th>
                                <th>Avilable Balance</th>
                                <th>AC status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($accounts as $account)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $account->branch->branch_name }}</td>
                                <td>{{ $account->savingsPlan->plan_name }}</td>
                                <td><a href="{{ route('sa.profile',$account->id) }}">{{ $account->account_number
                                        }}</a></td>
                                <td>{{ $account->member->first_name }} {{ $account->member->last_name }}</td>
                                <td>{{ $account->member->member_code }}</td>
                                <td>{{ number_format($account->balance, 2) }}</td>

                                <td>
                                    @if ($account->account_status === 'active')
                                    <span class="badge bg-success">Active</span>
                                    @elseif ($account->account_status === 'inactive')
                                    <span class="badge bg-danger">Inactive</span>
                                    @elseif ($account->account_status === 'on_hold')
                                    <span class="badge bg-warning">On Hold</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="td-actions">
                                        @if(hasRolePermission('savingsAC-profile-view'))
                                        <!-- View Button (Eye Icon) -->
                                        <a href="{{ route('sa.profile',$account->id) }}" class="icon green"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </a>
                                        @endif
                                        <!-- Edit Button (Pencil Icon) -->

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No savings accounts found.</td>
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


@endsection

@section('script')
<script>
    // For printing the Savings Account table content
    setupPrintButton('export-print', 'account-table');
</script>
@endsection