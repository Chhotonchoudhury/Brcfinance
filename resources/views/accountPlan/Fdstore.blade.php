@extends('layouts/app')
@section('title') Savings Account Plan Store @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Savings plan</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('fd.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('fd.save', $plan->id ?? '') }}" id="SVstore" method="POST">
        @csrf

        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($plan->id)) Update @endif FD Plan Details</div>
            </div>

            <!-- Plan Code -->
            <div class="row gutters">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('plan_code') is-invalid @enderror" type="text"
                                name="plan_code" value="{{ old('plan_code', $plan->plan_code ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-hash"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Plan Code <span class="text-danger">*</span></div>
                        @error('plan_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Plan Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('plan_name') is-invalid @enderror" type="text"
                                name="plan_name" value="{{ old('plan_name', $plan->plan_name ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-domain"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Plan Name <span class="text-danger">*</span></div>
                        @error('plan_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Min Amount -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('min_amount') is-invalid @enderror" type="number"
                                step="0.01" name="min_amount" value="{{ old('min_amount', $plan->min_amount ?? '') }}">
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Amount <span class="text-danger">*</span></div>
                        @error('min_amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Lock-in Period -->
            <div class="row gutters">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('lockin_period') is-invalid @enderror"
                                name="lockin_period">
                                <option value="">Select Lock-in Period</option>
                                <option value="1 Year" {{ old('lockin_period', $plan->lockin_period ?? '') == '1
                                    Year' ? 'selected' : '' }}>1 Year</option>
                                <option value="2 Years" {{ old('lockin_period', $plan->lockin_period ?? '') == '2
                                    Years' ? 'selected' : '' }}>2 Years</option>
                                <option value="3 Years" {{ old('lockin_period', $plan->lockin_period ?? '') == '3
                                    Years' ? 'selected' : '' }}>3 Years</option>
                                <option value="5 Years" {{ old('lockin_period', $plan->lockin_period ?? '') == '5
                                    Years' ? 'selected' : '' }}>5 Years</option>
                                <option value="10 Years" {{ old('lockin_period', $plan->lockin_period ?? '') == '10
                                    Years' ? 'selected' : '' }}>10 Years</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Lock-in Period <span class="text-danger">*</span></div>
                        @error('lockin_period')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Senior Citizen Interest Rate -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input
                                class="form-control @error('senior_citizen_annual_interest_rate') is-invalid @enderror"
                                type="number" step="0.01" name="senior_citizen_annual_interest_rate"
                                value="{{ old('senior_citizen_annual_interest_rate', $plan->senior_citizen_annual_interest_rate ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Senior Citizen Annual Interest Rate (%)</div>
                        @error('senior_citizen_annual_interest_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Annual Interest Rate -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('annual_interest_rate') is-invalid @enderror"
                                type="number" step="0.01" name="annual_interest_rate"
                                value="{{ old('annual_interest_rate', $plan->annual_interest_rate ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-percent"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Annual Interest Rate (%) <span class="text-danger">*</span>
                        </div>
                        @error('annual_interest_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Interest Lock-in Period -->
            <div class="row gutters">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('interest_lockin_period') is-invalid @enderror"
                                name="interest_lockin_period">
                                <option value="">Select Interest Lock-in Period</option>
                                <option value="1 Year" {{ old('interest_lockin_period', $plan->
                                    interest_lockin_period ?? '') == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                <option value="2 Years" {{ old('interest_lockin_period', $plan->
                                    interest_lockin_period ?? '') == '2 Years' ? 'selected' : '' }}>2 Years</option>
                                <option value="3 Years" {{ old('interest_lockin_period', $plan->
                                    interest_lockin_period ?? '') == '3 Years' ? 'selected' : '' }}>3 Years</option>
                                <option value="5 Years" {{ old('interest_lockin_period', $plan->
                                    interest_lockin_period ?? '') == '5 Years' ? 'selected' : '' }}>5 Years</option>
                                <option value="10 Years" {{ old('interest_lockin_period', $plan->
                                    interest_lockin_period ?? '') == '10 Years' ? 'selected' : '' }}>10 Years
                                </option>
                            </select>
                        </div>
                        <div class="field-placeholder">Interest Lock-in Period</div>
                        @error('interest_lockin_period')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Tenure Type -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('tenure_type') is-invalid @enderror" name="tenure_type">
                                <option value="month" {{ old('tenure_type', $plan->tenure_type ?? '') == 'month' ?
                                    'selected' : '' }}>Month</option>
                                <option value="year" {{ old('tenure_type', $plan->tenure_type ?? '') == 'year' ?
                                    'selected' : '' }}>Year</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Tenure Type <span class="text-danger">*</span></div>
                        @error('tenure_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tenure Value -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('tenure_value') is-invalid @enderror" type="number"
                                name="tenure_value" value="{{ old('tenure_value', $plan->tenure_value ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-calendar_today"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Tenure Value <span class="text-danger">*</span></div>
                        @error('tenure_value')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Interest Payout -->
            <div class="row gutters">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('interest_payout') is-invalid @enderror"
                                name="interest_payout" required>
                                <option value="Monthly" {{ old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Yearly" {{ old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Yearly' ? 'selected' : '' }}>Yearly</option>
                                <option value="Quarterly" {{ old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Interest Payout Frequency <span class="text-danger">*</span>
                        </div>
                        @error('interest_payout')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Active/Deactive -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('active') is-invalid @enderror" name="active" required>
                                <option value="1" {{ old('active', $plan->active ?? 1) == 1 ? 'selected' : ''
                                    }}>Active</option>
                                <option value="0" {{ old('active', $plan->active ?? 1) == 0 ? 'selected' : ''
                                    }}>Deactive</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-priority_high"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        @error('active')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="SVsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="SVbuttonText">@if(isset($plan->id)) Update @else Submit @endif </span>
                <span id="SVloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
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
    new FormSubmitHandler('SVstore', 'SVsubmitButton', 'SVbuttonText', 'SVloadingSpinner');
</script>

@endsection