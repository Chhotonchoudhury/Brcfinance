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
            <a href="{{ route('saving.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('saving.save', $plan->id ?? '') }}" id="SVstore" method="POST">
        @csrf

        <div class="card-body">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header"> @if(isset($plan->id)) Update @endif Plan Details</div>
            </div>

            <!-- Plan Name -->
            <!-- Row start -->
            <div class="row gutters">
                <!-- Plan Code -->
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
                <!-- Min Opening Balance -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('min_opening_balance') is-invalid @enderror" type="number"
                                step="0.01" name="min_opening_balance"
                                value="{{ old('min_opening_balance', $plan->min_opening_balance ?? '') }}">
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Opening Balance <span class="text-danger">*</span></div>
                        @error('min_opening_balance')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Min Average Balance -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('min_avg_balance') is-invalid @enderror" type="number"
                                step="0.01" name="min_avg_balance"
                                value="{{ old('min_avg_balance', $plan->min_avg_balance ?? '') }}" required>
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Average Balance <span class="text-danger">*</span></div>
                        @error('min_avg_balance')
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
                                value="{{ old('annual_interest_rate', $plan->annual_interest_rate ?? '') }}" required>
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
                <!-- Senior Citizen Annual Interest Rate -->
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
            </div>
            <!-- Row end -->


            <!-- Row start -->
            <div class="row gutters">
                <!-- Interest Payout Frequency -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('interest_payout') is-invalid @enderror"
                                name="interest_payout" required>
                                <option value="Monthly" {{ old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Yearly" {{ old('interest_payout', $plan->interest_payout ?? '') ==
                                    'Yearly' ? 'selected' : '' }}>Yearly</option>
                                <option value="Half Yearly" {{ old('interest_payout', $plan->interest_payout ?? '')
                                    == 'Half Yearly' ? 'selected' : '' }}>Half Yearly</option>
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
                <!-- Lock-in Amount -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('lock_in_amount') is-invalid @enderror" type="number"
                                step="0.01" name="lock_in_amount"
                                value="{{ old('lock_in_amount', $plan->lock_in_amount ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-lock"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Lock-in Amount <span class="text-danger">*</span></div>
                        @error('lock_in_amount')
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
            <!-- Row end -->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($plan->id)) Update @endif Plan Charges</div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <!-- Min Monthly Avg Balance Charge -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('min_monthly_avg_balance_charge') is-invalid @enderror"
                                type="number" name="min_monthly_avg_balance_charge"
                                value="{{ old('min_monthly_avg_balance_charge', $plan->min_monthly_avg_balance_charge ?? '') }}"
                                required>
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Min Monthly Avg Balance Charge <span class="text-danger">*</span>
                        </div>
                        @error('min_monthly_avg_balance_charge')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- SMS Charge Frequency -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('sms_charge_frequency') is-invalid @enderror"
                                name="sms_charge_frequency" required>
                                <option value="Monthly" {{ old('sms_charge_frequency', $plan->sms_charge_frequency
                                    ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Yearly" {{ old('sms_charge_frequency', $plan->sms_charge_frequency ??
                                    '') == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-message"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">SMS Charge Frequency <span class="text-danger">*</span></div>
                        @error('sms_charge_frequency')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- SMS Charge -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('sms_charge') is-invalid @enderror" type="number"
                                step="0.01" name="sms_charge" value="{{ old('sms_charge', $plan->sms_charge ?? '') }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-message"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">SMS Charge <span class="text-danger">*</span></div>
                        @error('sms_charge')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Card Charges Frequency -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('card_charge_frequency') is-invalid @enderror"
                                name="card_charge_frequency" required>
                                <option value="Monthly" {{ old('card_charge_frequency', $plan->card_charge_frequency
                                    ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="Yearly" {{ old('card_charge_frequency', $plan->card_charge_frequency
                                    ?? '') == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Card Charge Frequency <span class="text-danger">*</span>
                        </div>
                        @error('card_charge_frequency')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Card Charge -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('card_charge') is-invalid @enderror" type="number"
                                step="0.01" name="card_charge"
                                value="{{ old('card_charge', $plan->card_charge ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Card Charge <span class="text-danger">*</span></div>
                        @error('card_charge')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Free IFSC Collection Per Month -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('free_ifsc_collection_per_month') is-invalid @enderror"
                                type="number" name="free_ifsc_collection_per_month"
                                value="{{ old('free_ifsc_collection_per_month', $plan->free_ifsc_collection_per_month ?? 0) }}"
                                required>
                            <span class="input-group-text">
                                <i class="icon-repeat"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Free IFSC Collection Per Month</div>
                        @error('free_ifsc_collection_per_month')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

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