@extends('layouts/app')
@section('title') DD Account Plan Store @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">DD plan</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('dd.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('dd.save', $plan->id ?? '') }}" id="DDstore" method="POST">
        @csrf




        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($plan->id)) Update @else Add @endif DD Plan Details</div>
            </div>

            <!-- Plan Code -->
            <div class="row gutters">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('plan_code') is-invalid @enderror" type="text"
                                name="plan_code" value="{{ old('plan_code', $plan->plan_code ?? '') }}">
                            <span class="input-group-text"><i class="icon-hash"></i></span>
                        </div>
                        <div class="field-placeholder">Plan Code <span class="text-danger">*</span></div>
                        @error('plan_code') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Plan Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('plan_name') is-invalid @enderror" type="text"
                                name="plan_name" value="{{ old('plan_name', $plan->plan_name ?? '') }}">
                            <span class="input-group-text"><i class="icon-domain"></i></span>
                        </div>
                        <div class="field-placeholder">Plan Name <span class="text-danger">*</span></div>
                        @error('plan_name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Minimum Amount -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('minimum_amount') is-invalid @enderror" type="number"
                                name="minimum_amount" value="{{ old('minimum_amount', $plan->minimum_amount ?? '') }}">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Minimum Amount <span class="text-danger">*</span></div>
                        @error('minimum_amount') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Lock-in Period & Interest Rates -->
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('lock_in_period') is-invalid @enderror"
                                name="lock_in_period">
                                <option value="" disabled selected>Select Lock-in Period</option>
                                <option value="3" {{ old('lock_in_period', $plan->lock_in_period ?? '') == 3 ?
                                    'selected' : '' }}>3 Months</option>
                                <option value="6" {{ old('lock_in_period', $plan->lock_in_period ?? '') == 6 ?
                                    'selected' : '' }}>6 Months</option>
                                <option value="12" {{ old('lock_in_period', $plan->lock_in_period ?? '') == 12 ?
                                    'selected' : '' }}>12 Months</option>
                                <option value="24" {{ old('lock_in_period', $plan->lock_in_period ?? '') == 24 ?
                                    'selected' : '' }}>24 Months</option>
                                <option value="36" {{ old('lock_in_period', $plan->lock_in_period ?? '') == 36 ?
                                    'selected' : '' }}>36 Months</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Lock-in Period (Months) <span class="text-danger">*</span>
                        </div>
                        @error('lock_in_period')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('annual_interest_rate') is-invalid @enderror"
                                type="number" step="0.01" name="annual_interest_rate"
                                value="{{ old('annual_interest_rate', $plan->annual_interest_rate ?? '') }}">
                            <span class="input-group-text"><i class="icon-percent"></i></span>
                        </div>
                        <div class="field-placeholder">Annual Interest Rate (%) <span class="text-danger">*</span>
                        </div>
                        @error('annual_interest_rate') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input
                                class="form-control @error('senior_citizen_annual_interest_rate') is-invalid @enderror"
                                type="number" step="0.01" name="senior_citizen_annual_interest_rate"
                                value="{{ old('senior_citizen_annual_interest_rate', $plan->senior_citizen_annual_interest_rate ?? '') }}">
                            <span class="input-group-text"><i class="icon-percent"></i></span>
                        </div>
                        <div class="field-placeholder">Senior Citizen Interest Rate (%)</div>
                        @error('senior_citizen_annual_interest_rate') <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Ladies Annual Interest Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ladies_annual_interest_rate') is-invalid @enderror"
                                type="number" step="0.01" name="ladies_annual_interest_rate"
                                value="{{ old('ladies_annual_interest_rate', $plan->ladies_annual_interest_rate ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Ladies Annual Interest Rate (%)</div>
                        @error('ladies_annual_interest_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row gutters">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('interest_lock_in_period') is-invalid @enderror"
                                name="interest_lock_in_period">
                                <option value="" disabled selected>Interest Lock-in Period</option>
                                <option value="3" {{ old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 3 ?
                                    'selected' : '' }}>3 Months</option>
                                <option value="6" {{ old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 6 ?
                                    'selected' : '' }}>6 Months</option>
                                <option value="12" {{ old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 12 ?
                                    'selected' : '' }}>12 Months</option>
                                <option value="24" {{ old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 24 ?
                                    'selected' : '' }}>24 Months</option>
                                <option value="36" {{ old('interest_lock_in_period', $plan->interest_lock_in_period
                                    ?? '') == 36 ?
                                    'selected' : '' }}>36 Months</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder"> Interest Lock-in Period (Months) <span
                                class="text-danger">*</span>
                        </div>
                        @error('interest_lock_in_period')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tenure Type and Value -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <!-- Tenure Type Dropdown -->
                            <select class="form-control @error('tenure_type') is-invalid @enderror" name="tenure_type">
                                <option value="days" {{ old('tenure_type', $plan->tenure_type ?? 'days') == 'days' ?
                                    'selected' : '' }}>Days</option>
                                <option value="months" {{ old('tenure_type', $plan->tenure_type ?? 'days') ==
                                    'months' ? 'selected' : '' }}>Months</option>
                                <option value="years" {{ old('tenure_type', $plan->tenure_type ?? 'days') == 'years'
                                    ? 'selected' : '' }}>Years</option>
                            </select>
                            <span class="input-group-text">Type</span>

                            <!-- Tenure Value Input -->
                            <input class="form-control @error('tenure_value') is-invalid @enderror" type="number"
                                name="tenure_value" value="{{ old('tenure_value', $plan->tenure_value ?? '') }}"
                                placeholder="Enter Tenure Value">
                            <span class="input-group-text">Value</span>
                        </div>
                        <div class="field-placeholder">Tenure <span class="text-danger">*</span></div>
                        @error('tenure_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('tenure_value')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- RD/DD Frequency -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('rd_dd_frequency') is-invalid @enderror"
                                name="rd_dd_frequency">
                                <option value="" disabled selected>Select Frequency</option>
                                <option value="daily" {{ old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="monthly" {{ old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="quarterly" {{ old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                <option value="annually" {{ old('rd_dd_frequency', $plan->rd_dd_frequency ?? '') ==
                                    'annually' ? 'selected' : '' }}>Annually</option>
                            </select>
                            <span class="input-group-text">Frequency</span>
                        </div>
                        <div class="field-placeholder">RD/DD Frequency</div>
                        @error('rd_dd_frequency') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Interest Compounding Interval -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('interest_compounding_interval') is-invalid @enderror"
                                name="interest_compounding_interval">
                                <option value="" disabled selected>Select Interval</option>
                                <option value="monthly" {{ old('interest_compounding_interval', $plan->
                                    interest_compounding_interval ?? '') == 'monthly' ? 'selected' : '' }}>Monthly
                                </option>
                                <option value="quarterly" {{ old('interest_compounding_interval', $plan->
                                    interest_compounding_interval ?? '') == 'quarterly' ? 'selected' : ''
                                    }}>Quarterly</option>
                                <option value="annually" {{ old('interest_compounding_interval', $plan->
                                    interest_compounding_interval ?? '') == 'annually' ? 'selected' : '' }}>Annually
                                </option>
                            </select>
                            <span class="input-group-text">Interval</span>
                        </div>
                        <div class="field-placeholder">Interest Compounding Interval</div>
                        @error('interest_compounding_interval') <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Cancellation Charge -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('cancellation_charge') is-invalid @enderror" type="number"
                                step="0.01" name="cancellation_charge"
                                value="{{ old('cancellation_charge', $plan->cancellation_charge ?? '') }}"
                                placeholder="Enter Cancellation Charge">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Cancellation Charge</div>
                        @error('cancellation_charge') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Penal Charge -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('penal_charge') is-invalid @enderror" type="number"
                                step="0.01" name="penal_charge"
                                value="{{ old('penal_charge', $plan->penal_charge ?? '') }}"
                                placeholder="Enter Penal Charge">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Penal Charge</div>
                        @error('penal_charge') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('is_active') is-invalid @enderror" name="is_active">
                                <option value="1" {{ old('is_active', $plan->is_active ?? 1) == 1 ? 'selected' : ''
                                    }}>Active</option>
                                <option value="0" {{ old('is_active', $plan->is_active ?? 1) == 0 ? 'selected' : ''
                                    }}>Inactive</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        @error('is_active') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>


                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skip_sunday" id="skipSunday" value="1" {{
                            old('skip_sunday', $plan->skip_sunday ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="skipSunday">Skip Sunday</label>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skip_saturday" id="skipSaturday" value="1"
                            {{ old('skip_saturday', $plan->skip_saturday ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="skipSaturday">Skip Saturday</label>
                    </div>
                </div>


            </div>


        </div>

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="DDsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="DDbuttonText">@if(isset($plan->id)) Update @else Submit @endif</span>
                <span id="DDloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
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
    new FormSubmitHandler('DDstore', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>

@endsection