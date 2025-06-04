@extends('layouts/app')
@section('title') Branch Storeing @endsection


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
            <a href="{{ route('company.branch') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('company.branch.form', $branch->id ?? '') }}" id="store" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">Create a New Branch</div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <!-- Branch Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('branch_name') is-invalid @enderror" type="text"
                                name="branch_name" value="{{ old('branch_name', $branch->branch_name ?? '')}}" required>
                            <span class="input-group-text">
                                <i class="icon-domain"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Branch Name <span class="text-danger">*</span></div>
                        @error('branch_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Branch Code -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('branch_code') is-invalid @enderror" type="text"
                                name="branch_code" value="{{ old('branch_code', $branch->branch_code ?? '') }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-hash"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Branch Code <span class="text-danger">*</span></div>
                        @error('branch_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Opening Date -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('opening_date') is-invalid @enderror" type="date"
                                name="opening_date" value="{{ old('opening_date', $branch->opening_date ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Opening Date</div>
                        @error('opening_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- IFSC Code -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ifsc_code') is-invalid @enderror" type="text"
                                name="ifsc_code" value="{{ old('ifsc_code', $branch->ifsc_code ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-hash"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">IFSC Code <span class="text-danger">*</span></div>
                        @error('ifsc_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Contact Email -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('contact_email') is-invalid @enderror" type="email"
                                name="contact_email" value="{{ old('contact_email', $branch->contact_email ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-email"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Contact Email <span class="text-danger">*</span></div>
                        @error('contact_email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Contact Number -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('contact_no') is-invalid @enderror" type="text"
                                name="contact_no" value="{{ old('contact_no', $branch->contact_no ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-phone1"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Contact Number <span class="text-danger">*</span></div>
                        @error('contact_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Address 1 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('address1') is-invalid @enderror" type="text"
                                name="address1" value="{{ old('address1', $branch->address1 ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-map-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Address Line 1 <span class="text-danger">*</span></div>
                        @error('address1')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Address 2 -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('address2') is-invalid @enderror" type="text"
                                name="address2" value="{{ old('address2', $branch->address2 ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-map-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Address Line 2</div>
                        @error('address2')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- City -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city"
                                value="{{ old('city', $branch->city ?? '') }}">
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
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- State -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('state') is-invalid @enderror" type="text" name="state"
                                value="{{ old('state', $branch->state ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-location-pin"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">State <span class="text-danger">*</span></div>
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Pincode -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('pincode') is-invalid @enderror" type="text"
                                name="pincode" value="{{ old('pincode', $branch->pincode ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-number"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Pincode <span class="text-danger">*</span></div>
                        @error('pincode')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Country -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('country') is-invalid @enderror" type="text"
                                name="country" value="{{ old('country', $branch->country ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-globe"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Country <span class="text-danger">*</span></div>
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Notes -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <textarea class="form-control @error('notes') is-invalid @enderror"
                            name="notes">{{ old('notes', $branch->notes ?? '') }}</textarea>
                        <div class="field-placeholder">Remarks</div>
                        @error('notes')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Payment Service -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select @error('payment_service') is-invalid @enderror"
                                name="payment_service">
                                <option value="1" {{ old('payment_service', $branch->payment_service ?? null) == 1
                                    ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('payment_service', $branch->payment_service ?? null) == 0
                                    ? 'selected' : '' }}>Deactivated</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Payment Service (Recharge) <span class="text-danger">*</span>
                        </div>
                        @error('payment_service')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Transfer Service -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-select @error('transfer_service') is-invalid @enderror"
                                name="transfer_service">
                                <option value="1" {{ old('transfer_service', $branch->transfer_service ?? null) ==
                                    1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('transfer_service', $branch->transfer_service ?? null) ==
                                    0 ? 'selected' : '' }}>Deactivated</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Transfer Service (NEFT/IMPS) <span class="text-danger">*</span>
                        </div>
                        @error('transfer_service')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Status -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                    name="status" value="1" {{ old('status', $branch->status ?? null) == 1 ?
                                'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio"
                                    name="status" value="0" {{ old('status', $branch->status ?? null) == 0 ?
                                'checked' : '' }}>
                                <label class="form-check-label">Deactivated</label>
                            </div>
                        </div>
                        <div class="field-placeholder">Status</div>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <hr>

            <!-- Submit Button -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button class="btn btn-sm btn-primary py-1 px-2" type="submit">Submit</button>
                </div>
            </div>
        </div>





    </form>

</div>
</div>

@endsection

@section('script')

<script>
    new FormSubmitHandler('store', 'submitButton', 'buttonText', 'loadingSpinner');
</script>

@endsection