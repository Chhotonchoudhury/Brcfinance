@extends('layouts/app')
@section('title') Agent Store @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Company</a></li>
                <li class="breadcrumb-item active" aria-current="page">Branch</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('agent.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('agent.save', $agent->id ?? '') }}" id="store" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($agent->id)) Update @endif General info</div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <!-- Branch -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select js-states select2 @error('branch_id') is-invalid @enderror"
                                id="select2" name="branch_id">
                                <option value="" {{ old('branch_id', $agent->branch_id ?? '') == '' ? 'selected' :
                                    '' }}>Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $agent->branch_id ?? '') ==
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
                <!-- Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                value="{{ old('name', $agent->name ?? '') }}" required>
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
                <!-- Email -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                value="{{ old('email', $agent->email ?? '') }}" required>
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

                <!--joining date-->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('joining_date') is-invalid @enderror" type="date"
                                name="joining_date"
                                value="{{ old('joining_date',   isset($agent) && $agent->joining_date ? $agent->joining_date->format('Y-m-d') : '') }}"
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
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Phone Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                                value="{{ old('phone', $agent->phone ?? '') }}" required>
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
                <!-- Gender -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="" {{ old('gender', $agent->gender ?? '') == '' ? 'selected' : ''
                                    }}>Select Gender</option>
                                <option value="Male" {{ old('gender', $agent->gender ?? '') == 'Male' ? 'selected' :
                                    '' }}>Male</option>
                                <option value="Female" {{ old('gender', $agent->gender ?? '') == 'Female' ?
                                    'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $agent->gender ?? '') == 'Other' ? 'selected'
                                    : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Gender <span class="text-danger">*</span></div>
                        @error('gender')
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
                                value="{{ old('date_of_birth', isset($agent) && $agent->date_of_birth ? $agent->date_of_birth->format('Y-m-d') : '') }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Date of Birth <span class="text-danger">*</span></div>
                        @error('date_of_birth')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Active Status -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select @error('is_active') is-invalid @enderror" name="is_active"
                                required>
                                <option value="1" {{ old('is_active', $agent->is_active ?? 1) == 1 ? 'selected' : ''
                                    }}>Active</option>
                                <option value="0" {{ old('is_active', $agent->is_active ?? 1) == 0 ? 'selected' : ''
                                    }}>Inactive</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        @error('is_active')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <!-- Row end -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($agent->id)) Update @endif Proof & Details</div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <!-- Aadhaar Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('aadhaar_number') is-invalid @enderror" type="text"
                                name="aadhaar_number" value="{{ old('aadhaar_number', $agent->aadhaar_number ?? '') }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
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
                                name="pan_number" value="{{ old('pan_number', $agent->pan_number ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
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
                        <div class="field-placeholder">Upload Photo</div>
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
                        <div class="field-placeholder">Upload Signature</div>
                        @error('signature')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">

                <!-- Commission Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('commission_rate') is-invalid @enderror" type="number"
                                step="0.01" name="commission_rate"
                                value="{{ old('commission_rate', $agent->commission_rate ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Commission Rate (%) <span class="text-danger">*</span></div>
                        @error('commission_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city"
                                value="{{ old('city', $agent->city ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-location"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">City <span class="text-danger">*</span></div>
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
                                value="{{ old('state', $agent->state ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-location"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">State <span class="text-danger">*</span></div>
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('address') is-invalid @enderror" type="text"
                                name="address" value="{{ old('address', $agent->address ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-location"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Permanent Address <span class="text-danger">*</span></div>
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row end -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($agent->id)) Update @endif Bank Details</div>
            </div>


            <!-- Row start -->
            <div class="row gutters">
                <!-- Bank Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('bank_name') is-invalid @enderror" type="text"
                                name="bank_name" value="{{ old('bank_name', $agent->bank_name ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-bank"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Bank Name <span class="text-danger">*</span></div>
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
                                name="account_number" value="{{ old('account_number', $agent->account_number ?? '') }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Account Number <span class="text-danger">*</span></div>
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
                                name="ifsc_code" value="{{ old('ifsc_code', $agent->ifsc_code ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-code"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">IFSC Code <span class="text-danger">*</span></div>
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
                                name="branch_name" value="{{ old('branch_name', $agent->branch_name ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-branch"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Branch Name <span class="text-danger">*</span></div>
                        @error('branch_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->


            @if(!isset($agent))
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
                <span id="buttonText">@if(isset($agent->id)) Update @else Submit @endif </span>
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

@endsection