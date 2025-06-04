@extends('layouts/app')
@section('title') Branches @endsection

{{-- @section('loading')
<div id="loading-wrapper">
    <div class="spinner-border"></div>
    Loading...
</div>
@endsection --}}

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
        /* Darker text color for better readability */
        background-color: #f0f0f0;
        /* Light grey background */
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #d1d1d1;
        /* Light border to give button-like appearance */
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
                    <h6 class="m-0">All Branches</h6>
                </div>
                <div class="me-2">
                    @if(hasRolePermission('branches-create'))
                    <a href="{{ route('company.branch.form') }}" onclick="showLoadingEffect(event)"
                        class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="icon-plus1"></i> New Branch
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                            role="status"></span>
                    </a>
                    @endif

                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <!-- Search Form with Export and Print Buttons on the Same Row -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <!-- Left side: Search Form -->
                        <form method="GET" action="{{ route('company.branch') }}" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}"
                                placeholder="Search branches..."
                                style="width: auto; min-height:30px; max-width: 300px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                <i class="icon icon-search1 me-1"></i>
                                Search</button>
                        </form>

                        <!-- Right side: Export Buttons -->
                        <div class="d-flex">
                            @if(hasRolePermission('branches-data-export'))
                            <button id="export-print" class="btn btn-outline-info btn-sm ms-2" title="Print">
                                <span class="icon-printer"></span> Print
                            </button>
                            <button id="export-pdf" class="btn btn-outline-danger btn-sm ms-2" title="Export PDF">
                                <span class="icon-save"></span> PDF
                            </button>
                            <button id="export-excel" class="btn btn-outline-success btn-sm ms-2" title="Export Excel">
                                <span class="icon-save2"></span> Excel
                            </button>
                            @endif

                        </div>
                    </div>
                    <table id="branch-table" class="table table-bordered table-striped  table-hover v-middle m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Code</th>
                                <th>Branch Name</th>
                                <th>Opeaning Date</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Pin Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->branch_code ?? 'N/A' }}</td>
                                <td>{{ $branch->branch_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($branch->opening_date)->format('d-m-Y') }}</td>
                                <td>{{ $branch->contact_no }}</td>
                                <td>{{ $branch->contact_email }}</td>
                                <td>{{ $branch->city }}</td>
                                <td>{{ $branch->pincode }}</td>
                                <td>
                                    @if ($branch->status == 1)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Deactivated</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="td-actions">
                                        <!-- View Button (Eye Icon) -->
                                        <a href="#" class="icon blue" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="View" data-bs-original-title="View Row">
                                            <i class="icon-eye"></i>
                                        </a>
                                        @if(hasRolePermission('branches-edit'))
                                        <!-- Edit Button (Pencil Icon) -->
                                        <a href="{{ route('company.branch.form', $branch->id) }}" class="icon green"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                            data-bs-original-title="Edit Row">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">No branches found.</td>
                            </tr>
                            @endforelse
                        </tbody>

                        {{--
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-between">
                            <div>
                                {{ $branches->appends(['search' => $search])->links() }}
                                <!-- Custom Pagination -->
                            </div>
                        </div> --}}
                    </table>
                </div>
            </div>

            <div class="card-footer" style="padding: 1%">
                <!-- Total Records -->
                <div class="footer-info">
                    Total Records : {{ $branches->total() }}
                </div>
                <!-- Pagination -->
                <div class="pagination-container">
                    {{ $branches->links('vendor.pagination.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

{{-- <script>
    new FormSubmitHandler('store', 'submitButton', 'buttonText', 'loadingSpinner');
</script> --}}

{{-- <script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#branch-table').DataTable(); // This applies DataTables functionality to all tables on the page
    });
</script> --}}

<script>
    // Example usage for the Agent table
   setupPrintButton('export-print', 'branch-table');
   
    document.getElementById('export-pdf').addEventListener('click', function () {
        window.location.href = "{{ route('branches.export.pdf') }}";
    });

    document.getElementById('export-excel').addEventListener('click', function () {
        window.location.href = '{{ route('branches.export.excel') }}';
    });
</script>


@endsection