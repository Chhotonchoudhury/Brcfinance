@extends('layouts/app')
@section('title') Employee store @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Company</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('employees.save', $employee->id ?? '') }}" id="store" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">
                    @if(isset($employee->id)) Update @else Add @endif Employee Info
                </div>
            </div>

            <!-- Row start -->
            <div class="row gutters">

                <!-- Branch -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control js-states select2 @error('branch_id') is-invalid @enderror"
                                id="select2" name="branch_id">
                                <option value="" {{ old('branch_id', $employee->branch_id ?? '') == '' ? 'selected'
                                    : '' }}>Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $employee->branch_id ?? '') ==
                                    $branch->id ? 'selected' : '' }}>
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


                <!-- Full Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                value="{{ old('name', $employee->name ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Full Name <span class="text-danger">*</span></div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="" {{ old('gender', $employee->gender ?? '') == '' ? 'selected' : ''
                                    }}>Select Gender</option>
                                <option value="Male" {{ old('gender', $employee->gender ?? '') == 'Male' ?
                                    'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $employee->gender ?? '') == 'Female' ?
                                    'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $employee->gender ?? '') == 'Other' ?
                                    'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Gender</div>
                        @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <!-- Joining Date -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('joining_date') is-invalid @enderror" type="date"
                                name="joining_date"
                                value="{{ old('joining_date', isset($employee) && $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') : '') }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Date of Enrolment <span class="text-danger">*</span></div>
                        @error('joining_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                value="{{ old('email', $employee->email ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-email"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Email Address <span class="text-danger">*</span></div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                                value="{{ old('phone', $employee->phone ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-phone"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Phone Number <span class="text-danger">*</span></div>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Date of Birth -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('date_of_birth') is-invalid @enderror" type="date"
                                name="date_of_birth"
                                value="{{ old('date_of_birth', isset($employee) && $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '') }}"
                                <span class="input-group-text">
                            <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Date of Birth</div>
                        @error('date_of_birth')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Is Active -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('is_active') is-invalid @enderror" name="is_active"
                                required>
                                <option value="1" {{ old('is_active', $employee->is_active ?? 1) == 1 ? 'selected' :
                                    '' }}>Active</option>
                                <option value="0" {{ old('is_active', $employee->is_active ?? 1) == 0 ? 'selected' :
                                    '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Active Status <span class="text-danger">*</span></div>
                        @error('is_active')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


            </div>
            <!-- Row end -->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">
                    @if(isset($employee->id)) Update @else Add @endif Proof & Details
                </div>
            </div>

            <div class="row gutters">
                <!-- Aadhaar Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('aadhaar_number') is-invalid @enderror" type="text"
                                name="aadhaar_number"
                                value="{{ old('aadhaar_number', $employee->aadhaar_number ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-documents"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Aadhaar Number <span class="text-danger">*</span></div>
                        @error('aadhaar_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- PAN Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('pan_number') is-invalid @enderror" type="text"
                                name="pan_number" value="{{ old('pan_number', $employee->pan_number ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-documents"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">PAN Number <span class="text-danger">*</span></div>
                        @error('pan_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Photo -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo"
                            accept="image/*">
                        <div class="field-placeholder">@if(isset($employee->id)) Upload @else Update @endif Photo
                        </div>
                        @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Photo -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input class="form-control @error('signature') is-invalid @enderror" type="file"
                            name="signature" accept="image/*">
                        <div class="field-placeholder">@if(isset($employee->id)) Upload @else update @endif
                            Signature
                        </div>
                        @error('signature')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('address') is-invalid @enderror" type="text"
                                name="address" value="{{ old('address', $employee->address ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-location"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Address</div>
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city"
                                value="{{ old('city', $employee->city ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-city"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">City</div>
                        @error('city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- State -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('state') is-invalid @enderror" type="text" name="state"
                                value="{{ old('state', $employee->state ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-map"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">State</div>
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Pincode -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('pincode') is-invalid @enderror" type="text"
                                name="pincode" value="{{ old('pincode', $employee->pincode ?? '') }}" maxlength="6">
                            <span class="input-group-text">
                                <i class="icon-postal"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Pincode</div>
                        @error('pincode')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">
                    @if(isset($employee->id)) Update @else Add @endif Employment Details
                </div>
            </div>

            <div class="row gutters">

                <!-- Job Title  -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control js-states select2 @error('job_title') is-invalid @enderror"
                                name="job_title" required>
                                <option value="" {{ old('job_title', $employee->job_title ?? '') == '' ? 'selected' : ''
                                    }}>
                                    Select Job Title
                                </option>
                                @php
                                $jobTitles = [
                                'Branch Manager',
                                'Assistant Manager',
                                'Loan Officer',
                                'Field Officer',
                                'Accountant',
                                'Cashier',
                                'Customer Service Executive',
                                'Recovery Agent',
                                'Marketing Executive',
                                'Data Entry Operator',
                                'Clerk',
                                'Auditor',
                                'IT Support',
                                ];
                                @endphp

                                @foreach($jobTitles as $title)
                                <option value="{{ $title }}" {{ old('job_title', $employee->job_title ?? '') == $title ?
                                    'selected' : '' }}>
                                    {{ $title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-placeholder">Designation <span class="text-danger">*</span></div>
                        @error('job_title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Job Position -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control js-states select2 @error('job_position') is-invalid @enderror"
                                name="job_position" required>
                                <option value="" {{ old('job_position', $employee->job_position ?? '') == '' ?
                                    'selected' : '' }}>
                                    Select Job Position
                                </option>
                                @php
                                $jobPositions = [
                                'Senior Manager',
                                'Operations Manager',
                                'Personal Loan Executive',
                                'Gold Loan Agent',
                                'Field Collection Agent',
                                'Field Verifier',
                                'Vault Cashier',
                                'Front Desk Cashier',
                                'Senior Accountant',
                                'Ledger Executive',
                                'Customer Relationship Officer',
                                'Data Entry Executive',
                                'Assistant Clerk',
                                'Audit Assistant',
                                'Support Staff',
                                ];
                                @endphp

                                @foreach($jobPositions as $position)
                                <option value="{{ $position }}" {{ old('job_position', $employee->job_position ?? '') ==
                                    $position ? 'selected' : '' }}>
                                    {{ $position }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-placeholder">Job Position <span class="text-danger">*</span></div>
                        @error('job_position')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Department -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control js-states select2 @error('department') is-invalid @enderror"
                                name="department" required>
                                <option value="" {{ old('department', $employee->department ?? '') == '' ? 'selected' :
                                    '' }}>
                                    Select Department
                                </option>
                                @php
                                $departments = [
                                'Operations',
                                'Finance',
                                'Loans',
                                'Recovery',
                                'Customer Service',
                                'IT & Support',
                                'Accounts',
                                'Administration',
                                'Marketing',
                                'Legal & Compliance',
                                'Audit',
                                'Human Resources',
                                'Cash Handling',
                                'Data Management',
                                ];
                                @endphp

                                @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ old('department', $employee->department ?? '') == $dept ?
                                    'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-placeholder">Department <span class="text-danger">*</span></div>
                        @error('department')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Employment Type -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('employment_type') is-invalid @enderror"
                            name="employment_type"
                            value="{{ old('employment_type', $employee->employment_type ?? '') }}" required>
                        <div class="field-placeholder">Employment Type <span class="text-danger">*</span></div>
                        @error('employment_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Start Date -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                            name="start_date" value="{{ old('start_date', $employee->start_date ?? '') }}" required>
                        <div class="field-placeholder">Start Date <span class="text-danger">*</span></div>
                        @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- End Date -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                            value="{{ old('end_date', $employee->end_date ?? '') }}">
                        <div class="field-placeholder">End Date</div>
                        @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">
                    @if(isset($employee->id)) Update @else Add @endif Salary Details
                </div>
            </div>

            <div class="row gutters">
                <!-- Base Salary -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01" class="form-control @error('base_salary') is-invalid @enderror"
                            name="base_salary" id="base_salary"
                            value="{{ old('base_salary', $employee->base_salary ?? '') }}" required>
                        <div class="field-placeholder">Base Salary <span class="text-danger">*</span></div>
                        @error('base_salary')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Provident Fund (PF) Amount -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01" class="form-control @error('pf_amount') is-invalid @enderror"
                            name="pf_amount" id="pf_amount" value="{{ old('pf_amount', $employee->pf_amount ?? '') }}">
                        <div class="field-placeholder">Provident Fund Amount</div>
                        @error('pf_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Employee State Insurance (ESI) Amount -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01" class="form-control @error('esi_amount') is-invalid @enderror"
                            name="esi_amount" id="esi_amount"
                            value="{{ old('esi_amount', $employee->esi_amount ?? '') }}">
                        <div class="field-placeholder">ESI Amount</div>
                        @error('esi_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- TDS Amount -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01" class="form-control @error('tds_amount') is-invalid @enderror"
                            name="tds_amount" id="tds_amount"
                            value="{{ old('tds_amount', $employee->tds_amount ?? '') }}">
                        <div class="field-placeholder">TDS Amount</div>
                        @error('tds_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Medical Allowance -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01"
                            class="form-control @error('medical_allowance') is-invalid @enderror"
                            name="medical_allowance" id="medical_allowance"
                            value="{{ old('medical_allowance', $employee->medical_allowance ?? '') }}">
                        <div class="field-placeholder">Medical Allowance</div>
                        @error('medical_allowance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Travel Allowance -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01"
                            class="form-control @error('travel_allowance') is-invalid @enderror" id="travel_allowance"
                            name="travel_allowance"
                            value="{{ old('travel_allowance', $employee->travel_allowance ?? '') }}">
                        <div class="field-placeholder">Travel Allowance</div>
                        @error('travel_allowance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Other Allowances -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01"
                            class="form-control @error('other_allowances') is-invalid @enderror" id="other_allowances"
                            name="other_allowances"
                            value="{{ old('other_allowances', $employee->other_allowances ?? '') }}">
                        <div class="field-placeholder">Other Allowances</div>
                        @error('other_allowances')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Gross Salary -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01"
                            class="form-control @error('gross_salary') is-invalid @enderror" id="gross_salary"
                            name="gross_salary" value="{{ old('gross_salary', $employee->gross_salary ?? '') }}"
                            readonly>
                        <div class="field-placeholder">Gross Salary</div>
                        @error('gross_salary')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Salary (Net Salary) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror"
                            id="salary" name="salary" value="{{ old('salary', $employee->salary ?? '') }}" readonly>
                        <div class="field-placeholder">Net Salary</div>
                        @error('salary')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>


            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">
                    @if(isset($employee->id)) Update @else Add @endif Bank Details
                </div>
            </div>

            <div class="row gutters">
                <!-- Bank Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('bank_name') is-invalid @enderror" type="text"
                                name="bank_name" value="{{ old('bank_name', $employee->bank_name ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-bank"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Bank Name</div>
                        @error('bank_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Account Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('account_number') is-invalid @enderror" type="text"
                                name="account_number"
                                value="{{ old('account_number', $employee->account_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Account Number</div>
                        @error('account_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- IFSC Code -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ifsc_code') is-invalid @enderror" type="text"
                                name="ifsc_code" value="{{ old('ifsc_code', $employee->ifsc_code ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-code"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">IFSC Code</div>
                        @error('ifsc_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Branch Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('branch_name') is-invalid @enderror" type="text"
                                name="branch_name" value="{{ old('branch_name', $employee->branch_name ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-branch"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Branch Name</div>
                        @error('branch_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row gutters mt-3">
                <!-- Bank Cheque 1 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('bank_cheque_1') is-invalid @enderror" type="text"
                                name="bank_cheque_1" value="{{ old('bank_cheque_1', $employee->bank_cheque_1 ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-docs"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Bank Cheque 1</div>
                        @error('bank_cheque_1')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bank Cheque 2 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('bank_cheque_2') is-invalid @enderror" type="text"
                                name="bank_cheque_2" value="{{ old('bank_cheque_2', $employee->bank_cheque_2 ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-docs"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Bank Cheque 2</div>
                        @error('bank_cheque_2')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bank Cheque 3 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('bank_cheque_3') is-invalid @enderror" type="text"
                                name="bank_cheque_3" value="{{ old('bank_cheque_3', $employee->bank_cheque_3 ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-docs"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Bank Cheque 3</div>
                        @error('bank_cheque_3')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">
                    @if(isset($employee->id)) Update @else Create @endif Authentication
                </div>
            </div>
            <div class="row gutters">

                <!-- Password -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" value="{{ old('password') }}">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Password</div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Confirm Password</div>
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>




                <!-- Roles -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('roles') is-invalid @enderror" name="roles" required>
                                <option value="">Assing Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if(old('roles', isset($employee) && $employee->user
                                    ? $employee->user->roles->first()->id ?? null
                                    : null) == $role->id)
                                    selected
                                    @endif>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-placeholder">Roles <span class="text-danger">*</span></div>
                        @error('roles')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row gutters">



                <!-- Weekly Login Permission -->
                @php
                $selectedDays = old('login_days', json_decode($employee->allowed_days ?? '[]', true));
                @endphp

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <label class="form-check-label" for="weekly-login-permission"></label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                                as $day)
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="login_days[]"
                                        value="{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}> {{ $day
                                    }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="field-placeholder">Select Days for Login <span class="text-danger">*</span></div>
                        @error('login_days')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Time Period for Login -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input type="time" class="form-control @error('login_start_time') is-invalid @enderror"
                                name="login_start_time"
                                value="{{ old('login_start_time', $employee->login_start_time ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-clock"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Login Start Time <span class="text-danger">*</span></div>
                        @error('login_start_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input type="time" class="form-control @error('login_end_time') is-invalid @enderror"
                                name="login_end_time"
                                value="{{ old('login_end_time', $employee->login_end_time ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-clock"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Login End Time <span class="text-danger">*</span></div>
                        @error('login_end_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



            </div>


            @if(!isset($employee->id))
            <!-- Row start -->
            <div class="row gutters">
                <!-- Form Section Header -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Uploading Center (optional)</div>
                </div>
            </div>
            <!-- Row start -->
            <div class="row gutters">
                <!-- Document Type & File Upload (initial row) -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="document-section">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <!-- Document Type Input -->
                            <input class="form-control @error('document_type[]') is-invalid @enderror" type="text"
                                name="document_type[]" placeholder="Document Type">
                            <span class="input-group-text">
                                <i class="icon-file"></i>
                            </span>
                            <!-- File Upload Input -->
                            <input class="form-control @error('document[]') is-invalid @enderror" type="file"
                                name="document[]">
                            <button type="button" id="add-document" class="btn btn-outline-primary btn-sm"
                                style="margin-left: 10px;">+</button>
                        </div>
                        @error('document_type[]')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('document[]')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror


                    </div>
                </div>
            </div>
            <!-- Row end -->
            @endif




        </div>
        <!-- Card body end -->

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="submitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="buttonText">@if(isset($employee->id)) Update @else Submit @endif </span>
                <span id="loadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
                    <span class="visually-hidden">Submitting...</span>
                </span>
            </button>
        </div>

    </form>
</div>
</div>

@endsection

@section('script')


<script>
    // JavaScript to dynamically add/remove document fields
    document.getElementById('add-document').addEventListener('click', function() {
        // Create a new row for document type and file input
        const newDocumentField = document.createElement('div');
        newDocumentField.classList.add('col-xl-12', 'col-lg-12', 'col-md-12', 'col-sm-12', 'col-12');
        newDocumentField.innerHTML = `
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="text" name="document_type[]" placeholder="Document Type" required>
                    <span class="input-group-text">
                        <i class="icon-file"></i>
                    </span>
                    <input class="form-control" type="file" name="document[]" required>
                    <!-- Remove Button -->
                    <button type="button" class="btn btn-danger remove-document btn-sm" style="margin-left: 10px;">-</button>
                </div>
            </div>
        `;
        
        // Append the new document field to the document section
        document.getElementById('document-section').appendChild(newDocumentField);
    
        // Attach event listener to the remove button for the newly added row
        newDocumentField.querySelector('.remove-document').addEventListener('click', function() {
            newDocumentField.remove();
        });
    });
</script>


<script>
    //
    new FormSubmitHandler('store', 'submitButton', 'buttonText', 'loadingSpinner');
</script>

<script>
    function calculateSalary() {
        let baseSalary = parseFloat(document.getElementById('base_salary').value) || 0;
        let pfAmount = parseFloat(document.getElementById('pf_amount').value) || 0;
        let esiAmount = parseFloat(document.getElementById('esi_amount').value) || 0;
        let tdsAmount = parseFloat(document.getElementById('tds_amount').value) || 0;
        let medicalAllowance = parseFloat(document.getElementById('medical_allowance').value) || 0;
        let travelAllowance = parseFloat(document.getElementById('travel_allowance').value) || 0;
        let otherAllowances = parseFloat(document.getElementById('other_allowances').value) || 0;

        // Gross = Base + All Allowances + All Deductions
        let grossSalary = baseSalary + medicalAllowance + travelAllowance + otherAllowances + pfAmount + esiAmount + tdsAmount;

        // Net Salary = Base + Allowances - Deductions
        let salary = (baseSalary + medicalAllowance + travelAllowance + otherAllowances) - (pfAmount + esiAmount + tdsAmount);

        document.getElementById('gross_salary').value = grossSalary.toFixed(2);
        document.getElementById('salary').value = salary.toFixed(2);
    }

    // Trigger calculation on input
    ['base_salary', 'pf_amount', 'esi_amount', 'tds_amount', 'medical_allowance', 'travel_allowance', 'other_allowances'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateSalary);
    });

    // Calculate on page load (for edit case)
    window.onload = function () {
        calculateSalary();
    };
</script>



@endsection