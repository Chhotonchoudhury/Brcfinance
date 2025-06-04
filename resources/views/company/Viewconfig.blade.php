@extends('layouts/app')
@section('title') Company @endsection

{{-- @section('loading')
<div id="loading-wrapper">
    <div class="spinner-border"></div>
    Loading...
</div>
@endsection --}}

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!-- Content wrapper start -->


<div class="row gutters">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Company</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->

        <div class="d-flex justify-content-end">
            @if(hasRolePermission('company-edit'))
            <a href="{{ route('company.edit') }}" class="btn btn-sm btn-outline-danger rounded-pill"
                onclick="showLoadingEffect(event)">
                <i class="icon-edit"></i> Edit
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>
            </a>
            @endif
        </div>

    </div>
</div>
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="profile-header">
            {{-- <h1>Welcome to the Company Profile</h1> --}}
            <h1>Welcome, {{ $company->name ?? 'N/A' }}</h1>
            <div class="profile-header-content">
                <div class="profile-header-tiles">
                    <div class="row gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="profile-tile">
                                <span class="icon">
                                    <i class="icon-home2"></i>
                                </span>
                                <h6>Company Name - <span>{{ $company->name ?? 'N/A' }}</span></h6>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="profile-tile">
                                <span class="icon">
                                    <i class="icon-map-pin"></i>
                                </span>
                                <h6>Location - <span>{{ $company->location ?? 'N/A' }}</span></h6>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="profile-tile">
                                <span class="icon">
                                    <i class="icon-phone1"></i>
                                </span>
                                <h6>Phone - <span>{{ $company->phone ?? 'N/A' }}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-avatar-tile">
                    <img src="{{ $company && $company->company_logo ? asset('storage/' . $company->company_logo) : asset('assetsDashboard/img/logo.png') }}"
                        class="img-fluid rounded-circle" alt="Company Logo" style="" />


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->
<!-- Row start -->
<div class="row gutters">

    <!-- General Info Card -->
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header rounded-top p-3 border-bottom">
                <h6 class="mb-0"><span class="icon-list2 me-2"></span>@can('company-view') General Info @endcan</h6>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong class="h6">Email:</strong>
                        <p class="text-muted mb-0">{{ $company->email ?? 'N/A' }}</p>
                    </li>
                    <li class="mb-3">
                        <strong class="h6">CIN Label:</strong>
                        <p class="text-muted mb-0">{{ $company->cin_label ?? 'N/A' }}</p>
                    </li>

                    <li class="mb-3">
                        <strong class="h6">About:</strong>
                        <p class="text-muted mb-0">{{ $company->about ?? 'No information available' }}</p>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!-- Company Info Card -->
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header rounded-top p-3 border-bottom">
                <h6 class="mb-0"><span class="icon-card_membership me-2"></span> Company Info</h6>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong class="h6">PAN No:</strong>
                        <p class="text-muted mb-0">{{ $company->pan ?? 'N/A' }}</p>
                    </li>

                    <li class="mb-3">
                        <strong class="h6">GST Number:</strong>
                        <p class="text-muted mb-0">{{ $company->gst_no ?? 'N/A' }}</p>
                    </li>
                    <li class="mb-3">
                        <strong class="h6">Incorporation Date:</strong>
                        <p class="text-muted mb-0">
                            {{ $company && $company->incorp_date != null ?
                            \Carbon\Carbon::parse($company->incorp_date)->format('d M, Y') : 'N/A' }}
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Share Info Card -->
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header rounded-top p-3 border-bottom">
                <h6 class="mb-0"><span class="icon-area-graph me-2"></span> Capitals Info</h6>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong class="h6">Authorized Capital:</strong>
                        <p class="text-muted mb-0">{{ $company->authorized_capital ?? 'N/A' }}</p>
                    </li>
                    <li class="mb-3">
                        <strong class="h6">Paid-Up Capital:</strong>
                        <p class="text-muted mb-0">{{ $company->paid_up_capital ?? 'N/A' }}</p>
                    </li>
                    <li class="mb-3">
                        <strong class="h6">Shares Nominal Value:</strong>
                        <p class="text-muted mb-0">{{ $company->shares_nominal_value ?? 'N/A' }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- Row end -->

<!-- Row start for Share Ranges and Share Info -->
<div class="row gutters">
    <!-- Share Ranges Card (Left side) -->
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header rounded-top p-3 border-bottom">
                <h6 class="mb-0"><span class="icon-pie-chart me-2"></span> Share Ranges</h6>
            </div>
            <div class="card-body p-4">
                <!-- Share Ranges Table -->
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>User Type</th>
                            <th>Number of Shares</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Director</td>
                            <td contenteditable="true" class="editable" data-type="num_shares">
                                {{ $shareRanges['Director']['num_shares'] }}
                            </td>
                            <td>
                                <select class="status-select" data-type="active">
                                    <option value="1" {{ $shareRanges['Director']['active'] ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ !$shareRanges['Director']['active'] ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Promoter</td>
                            <td contenteditable="true" class="editable" data-type="num_shares">
                                {{ $shareRanges['Promoter']['num_shares'] }}
                            </td>
                            <td>
                                <select class="status-select" data-type="active">
                                    <option value="1" {{ $shareRanges['Promoter']['active'] ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ !$shareRanges['Promoter']['active'] ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Member</td>
                            <td contenteditable="true" class="editable" data-type="num_shares">
                                {{ $shareRanges['Member']['num_shares'] }}
                            </td>
                            <td>
                                <select class="status-select" data-type="active">
                                    <option value="1" {{ $shareRanges['Member']['active'] ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ !$shareRanges['Member']['active'] ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Employee</td>
                            <td contenteditable="true" class="editable" data-type="num_shares">
                                {{ $shareRanges['Employee']['num_shares'] }}
                            </td>
                            <td>
                                <select class="status-select" data-type="active">
                                    <option value="1" {{ $shareRanges['Employee']['active'] ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ !$shareRanges['Employee']['active'] ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Agent</td>
                            <td contenteditable="true" class="editable" data-type="num_shares">
                                {{ $shareRanges['Agent']['num_shares'] }}
                            </td>
                            <td>
                                <select class="status-select" data-type="active">
                                    <option value="1" {{ $shareRanges['Agent']['active'] ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ !$shareRanges['Agent']['active'] ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    @if(hasRolePermission('company-shares-update'))
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-sm btn-outline-primary py-1 px-2"
                                    id="updateShareRanges">
                                    <i class="icon-save"></i> Save Changes
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                    @endif

                </table>
            </div>
        </div>
    </div>



    <!-- Share Capital Info Card (Right side) -->
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <div class="card shadow-sm">
            <div class="card-header rounded-top p-3 border-bottom">
                <h6 class="mb-0"><span class="icon-pie-chart me-2"></span> Capital Info</h6>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong class="h6">Total Issued Shares:</strong>
                        <p class="text-muted mb-0">{{ $authorizedCapital->issued_shares ?? 'N/A' }} shares</p>
                    </li>
                    <li class="mb-3">
                        <strong class="h6">Available Shares:</strong>
                        <p class="text-muted mb-0">{{ $authorizedCapital->available_shares ?? 'N/A' }} shares</p>
                    </li>
                    <li class="mb-3">
                        <strong class="h6">Total Paid-Up Capital:</strong>
                        <p class="text-muted mb-0">{{ $authorizedCapital->paid_up_capital ?? 'N/A' }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->


@endsection

@section('script')
@if(hasRolePermission('company-shares-update'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const saveButton = document.getElementById('updateShareRanges');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let isTableModified = false;

        saveButton.style.display = 'none';

        function showSaveButton() {
            if (!isTableModified) {
                isTableModified = true;
                saveButton.style.display = 'inline-block';
            }
        }

        document.querySelectorAll('.editable').forEach(cell => {
            cell.addEventListener('input', () => {
                showSaveButton();
            });
        });

        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', () => {
                showSaveButton();
            });
        });

        saveButton.addEventListener('click', function (event) {
            event.preventDefault();
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="icon-loader"></i> Updating...';

            const shareRanges = [];
            document.querySelectorAll('tbody tr').forEach(row => {
                const userType = row.querySelector('td:first-child').textContent.trim();
                const numShares = parseInt(row.querySelector('[data-type="num_shares"]').textContent.trim(), 10);
                const active = parseInt(row.querySelector('.status-select').value, 10);
                shareRanges.push({ user_type: userType, num_shares: numShares, active });
            });

            fetch(@json(route("share-ranges.update")), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ share_ranges: shareRanges }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Share ranges updated successfully!');
                    isTableModified = false;
                    saveButton.style.display = 'none';
                } else {
                    toastr.error('Error: Unable to update share ranges.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('An error occurred while updating share ranges.');
            })
            .finally(() => {
                saveButton.disabled = false;
                saveButton.innerHTML = '<i class="icon-save"></i> Save Changes';
            });
        });
    });
</script>
@endif

@endsection