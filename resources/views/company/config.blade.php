@extends('layouts/app')
@section('title') Company Update @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Company</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('company.view') }}" class="btn btn-sm btn-outline-dark rounded-pill"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('company.store') }}" id="store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">General Info </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                value="{{ old('name' , optional($company)->name) }}">
                            <span class="input-group-text">
                                <i class="icon-domain"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Company Name <span class="text-danger">*</span></div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <!-- Field wrapper end -->
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <!-- Field wrapper start for Email -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                value="{{ old('email', optional($company)->email) }}" required>
                            <span class="input-group-text">
                                <i class="icon-mail"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Email Address <span class="text-danger">*</span></div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Email -->
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <!-- Field wrapper start for Phone -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                                value="{{ old('phone', optional($company)->phone) }}" required minlength="10"
                                maxlength="15" pattern="^\+?[0-9\s\-\(\)]*$" placeholder="e.g., +91 9958000000">
                            <span class="input-group-text">
                                <i class="icon-phone"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Phone Number <span class="text-danger">*</span></div>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Phone -->
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <!-- Field wrapper start for Location -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('location') is-invalid @enderror" type="text"
                                name="location" value="{{ old('location', optional($company)->location) }}" required>
                            <span class="input-group-text">
                                <i class="icon-location-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Location <span class="text-danger">*</span></div>
                        @error('location')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Location -->
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Important Info</div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                    <!-- Field wrapper start for Incorporation Date -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('incorp_date') is-invalid @enderror" type="date"
                                name="incorp_date" value="{{ old('incorp_date', optional($company)->incorp_date) }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Incorporation Date <span class="text-danger">*</span></div>
                        @error('incorp_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Incorporation Date -->

                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                    <!-- Field wrapper start for CIN Label -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('cin_label') is-invalid @enderror" type="text"
                                name="cin_label" value="{{ old('cin_label', optional($company)->cin_label) }}"
                                maxlength="21">
                            <span class="input-group-text">
                                <i class="icon-layout"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">CIN Label</div>
                        @error('cin_label')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for CIN Label -->

                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                    <!-- Field wrapper start for PAN -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('pan') is-invalid @enderror" type="text" name="pan"
                                value="{{ old('pan', optional($company)->pan) }}" maxlength="10"
                                pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" placeholder="ABCDE1234F">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">PAN <span class="text-danger">*</span></div>
                        @error('pan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for PAN -->

                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                    <!-- Field wrapper start for GST No -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('gst_no') is-invalid @enderror" type="text" name="gst_no"
                                value="{{ old('gst_no', optional($company)->gst_no) }}" maxlength="15"
                                pattern="^[0-9A-Z]{15}$" placeholder="GSTIN: 123ABC4567X1Z2">
                            <span class="input-group-text">
                                <i class="icon-file"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">GST No <span class="text-danger">*</span></div>
                        @error('gst_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for GST No -->

                </div>
            </div>

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Basics Info</div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start for Category -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('category') is-invalid @enderror" type="text"
                                name="category" value="{{ old('category', optional($company)->category) }}">
                            <span class="input-group-text">
                                <i class="icon-tag"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Category</div>
                        @error('category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Category -->
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start for Class -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('class') is-invalid @enderror" type="text" name="class"
                                value="{{ old('class', optional($company)->class) }}">
                            <span class="input-group-text">
                                <i class="icon-layers"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Class</div>
                        @error('class')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Class -->
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start for Country -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('country') is-invalid @enderror" type="text"
                                name="country" value="{{ old('country', optional($company)->country) }}">
                            <span class="input-group-text">
                                <i class="icon-globe"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Country</div>
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Country -->
                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                    <!-- Field wrapper start for Authorized Capital -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('authorized_capital') is-invalid @enderror" type="number"
                                name="authorized_capital"
                                value="{{ old('authorized_capital', optional($company)->authorized_capital) }}"
                                step="0.01" min="0">
                            <span class="input-group-text">
                                <i class="icon-dollar-sign"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Authorized Capital <span class="text-danger">*</span></div>
                        @error('authorized_capital')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Authorized Capital -->

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start for Paid Up Capital -->
                    <div class="field-wrapper">

                        <div class="input-group">
                            <input class="form-control @error('paid_up_capital') is-invalid @enderror" type="number"
                                name="paid_up_capital"
                                value="{{ old('paid_up_capital', optional($company)->paid_up_capital) }}" step="0.01"
                                min="0">
                            <span class="input-group-text">
                                <i class="icon-dollar-sign"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Paid Up Capital <span class="text-danger">*</span></div>
                        @error('paid_up_capital')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <!-- Field wrapper end for Paid Up Capital -->
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start for Shares Nominal Value -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('shares_nominal_value') is-invalid @enderror"
                                type="number" name="shares_nominal_value"
                                value="{{ old('shares_nominal_value', optional($company)->shares_nominal_value) }}"
                                step="0.01" min="0">
                            <span class="input-group-text">
                                <i class="icon-briefcase"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Shares Nominal Value <span class="text-danger">*</span></div>
                        @error('shares_nominal_value')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Shares Nominal Value -->
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <!-- Field wrapper start for About -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <textarea class="form-control @error('about') is-invalid @enderror" name="about"
                                rows="4">{{ old('about', optional($company)->about) }}</textarea>
                            <span class="input-group-text">
                                <i class="icon-lines"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">About</div>
                        @error('about')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for About -->
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <!-- Field wrapper start for Address -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                rows="4">{{ old('address', optional($company)->address) }}</textarea>
                            <span class="input-group-text">
                                <i class="icon-location-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Address</div>
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Field wrapper end for Address -->
                </div>

            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Logos </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <!-- Field wrapper start for Company Logo -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('company_logo') is-invalid @enderror" type="file"
                                name="company_logo" accept="image/*" id="companyLogoInput"
                                onchange="previewImage(event, 'companyLogoPreview', 'companyLogoPreviewContainer')">
                            <span class="input-group-text">
                                <i class="icon-image"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Company Logo <span class="text-danger">*</span></div>
                        @error('company_logo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Preview area for Company Logo -->
                        <div id="companyLogoPreviewContainer" class="mt-2" style="display: none;">
                            <img id="companyLogoPreview" src="" alt="Company Logo Preview"
                                style="max-width: 150px; max-height: 150px;">
                        </div>

                        <!-- Default image (if any) or placeholder for Company Logo -->
                        @if($company && $company->company_logo)
                        <div id="companyLogoPreviewContainer" class="mt-2">
                            <img id="companyLogoPreview" src="{{ asset('storage/'.$company->company_logo) }}"
                                alt="Company Logo" style="max-width: 150px; max-height: 150px;">
                        </div>
                        @else
                        <div id="companyLogoPreviewContainer" class="mt-2" style="display: none;">
                            <img id="companyLogoPreview" src="" alt="Company Logo Preview"
                                style="max-width: 150px; max-height: 150px;">
                        </div>
                        @endif
                    </div>
                    <!-- Field wrapper end for Company Logo -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <!-- Field wrapper start for Favicon -->
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('favicon') is-invalid @enderror" type="file"
                                name="favicon" accept="image/*" id="faviconInput"
                                onchange="previewImage(event, 'faviconPreview', 'faviconPreviewContainer')">
                            <span class="input-group-text">
                                <i class="icon-image"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Favicon <span class="text-danger">*</span></div>
                        @error('favicon')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Preview area for Favicon -->
                        <div id="faviconPreviewContainer" class="mt-2" style="display: none;">
                            <img id="faviconPreview" src="" alt="Favicon Preview"
                                style="max-width: 50px; max-height: 50px;">
                        </div>

                        <!-- Default image (if any) or placeholder for Favicon -->
                        @if($company && $company->favicon)
                        <div id="faviconPreviewContainer" class="mt-2">
                            <img id="faviconPreview" src="{{ asset('storage/'.$company->favicon) }}" alt="Favicon"
                                style="max-width: 50px; max-height: 50px;">
                        </div>
                        @else
                        <div id="faviconPreviewContainer" class="mt-2" style="display: none;">
                            <img id="faviconPreview" src="" alt="Favicon Preview"
                                style="max-width: 50px; max-height: 50px;">
                        </div>
                        @endif
                    </div>
                    <!-- Field wrapper end for Favicon -->
                </div>

            </div>
            <hr>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <button class="btn btn-sm btn-outline-primary rounded-pill " id="submitButton" type="submit"> <span
                        class="icon-save2"></span> <span id="buttonText"> Submit </span>
                    <span id="loadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                </button>
            </div>
        </div>
        <!-- Row end -->
    </form>

</div>
</div>

@endsection

@section('script')

<script>
    new FormSubmitHandler('store', 'submitButton', 'buttonText', 'loadingSpinner');
</script>

@endsection