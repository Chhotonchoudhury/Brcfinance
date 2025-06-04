@extends('layouts/app')
@section('title') Loan Against Deposit Store @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Plans</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan AD Plans</li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('loanAD.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('loanAD.form', $plan->id ?? '') }}" id="DDstore" method="POST">
        @csrf

        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($plan->id)) Update @else Add @endif Loan Against Deposit Plan
                </div>
            </div>

            <!-- Plan Code & Name -->
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
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

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
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

                <!-- Deposit Type -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('deposit_type') is-invalid @enderror"
                                name="deposit_type">
                                <option value="" disabled selected>Select Deposit Type</option>
                                <option value="FD" {{ old('deposit_type', $plan->deposit_type ?? '') == 'FD' ?
                                    'selected' : '' }}>Fixed Deposit (FD)</option>
                                <option value="RD" {{ old('deposit_type', $plan->deposit_type ?? '') == 'RD' ?
                                    'selected' : '' }}>Recurring Deposit (RD)</option>
                                <option value="MIS" {{ old('deposit_type', $plan->deposit_type ?? '') == 'MIS' ?
                                    'selected' : '' }}>Monthly Income Scheme (MIS)</option>
                            </select>
                            <span class="input-group-text"><i class="icon-archive"></i></span>
                        </div>
                        <div class="field-placeholder">Deposit Type <span class="text-danger">*</span></div>
                        @error('deposit_type') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('interest_rate') is-invalid @enderror" type="number"
                                step="0.01" name="interest_rate"
                                value="{{ old('interest_rate', $plan->interest_rate ?? '') }}">
                            <span class="input-group-text"><i class="icon-percent"></i></span>
                        </div>
                        <div class="field-placeholder">Loan Interest Rate (%) <span class="text-danger">*</span></div>
                        @error('interest_rate') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Interest Rate & Tenure -->
            <div class="row gutters">


                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('tenure_months') is-invalid @enderror" type="number"
                                name="tenure_months" value="{{ old('tenure_months', $plan->tenure_months ?? '') }}">
                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                        </div>
                        <div class="field-placeholder">Loan Tenure (Months) <span class="text-danger">*</span></div>
                        @error('tenure_months') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ltv_ratio') is-invalid @enderror" type="number"
                                step="0.01" name="ltv_ratio" value="{{ old('ltv_ratio', $plan->ltv_ratio ?? 75) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Loan-to-Value Ratio (%)</div>
                        @error('ltv_ratio') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('min_loan_amount') is-invalid @enderror" type="number"
                                step="0.01" name="min_loan_amount"
                                value="{{ old('min_loan_amount', $plan->min_loan_amount ?? '') }}">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Minimum Loan Amount <span class="text-danger">*</span></div>
                        @error('min_loan_amount') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('max_loan_amount') is-invalid @enderror" type="number"
                                step="0.01" name="max_loan_amount"
                                value="{{ old('max_loan_amount', $plan->max_loan_amount ?? '') }}">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Maximum Loan Amount</div>
                        @error('max_loan_amount') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>


            </div>

            <!-- Loan Amount & EMI Type -->
            <div class="row gutters">
                <!-- Processing Fee -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('processing_fee') is-invalid @enderror" type="number"
                                step="0.01" name="processing_fee"
                                value="{{ old('processing_fee', $plan->processing_fee ?? 0) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Processing Fee</div>
                        @error('processing_fee') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('emi_type') is-invalid @enderror" name="emi_type">
                                <option value="daily" {{ old('emi_type', $plan->emi_type ?? '') == 'daily' ?
                                    'selected' : '' }}>Daily</option>
                                <option value="monthly" {{ old('emi_type', $plan->emi_type ?? '') == 'monthly' ?
                                    'selected' : '' }}>Monthly</option>
                                <option value="quarterly" {{ old('emi_type', $plan->emi_type ?? '') == 'quarterly' ?
                                    'selected' : '' }}>Quarterly</option>
                                <option value="annually" {{ old('emi_type', $plan->emi_type ?? '') == 'annually' ?
                                    'selected' : '' }}>Annually</option>
                            </select>
                            <span class="input-group-text"><i class="icon-clock"></i></span>
                        </div>
                        <div class="field-placeholder">EMI Type</div>
                        @error('emi_type') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Prepayment Lock-in Period (Months) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('prepayment_lockin_period_months') is-invalid @enderror"
                                type="number" name="prepayment_lockin_period_months"
                                value="{{ old('prepayment_lockin_period_months', $plan->prepayment_lockin_period_months ?? 4) }}">
                            <span class="input-group-text">Months</span>
                        </div>
                        <div class="field-placeholder">Prepayment Lock-in Period</div>
                        @error('prepayment_lockin_period_months')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Prepayment Charges -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('prepayment_charges') is-invalid @enderror" type="number"
                                step="0.01" name="prepayment_charges"
                                value="{{ old('prepayment_charges', $plan->prepayment_charges ?? 0) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Prepayment Charges</div>
                        @error('prepayment_charges') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Late Payment Penalty -->
                {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('late_payment_penalty') is-invalid @enderror"
                                type="number" step="0.01" name="late_payment_penalty"
                                value="{{ old('late_payment_penalty', $plan->late_payment_penalty ?? 0) }}">
                            <span class="input-group-text">₹</span>
                        </div>
                        <div class="field-placeholder">Late Payment Penalty</div>
                        @error('late_payment_penalty') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div> --}}
            </div>

            <div class="row gutters">

                <!-- Late Payment Daily Fine Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('late_payment_daily_fine_rate') is-invalid @enderror"
                                type="number" step="0.001" name="late_payment_daily_fine_rate"
                                value="{{ old('late_payment_daily_fine_rate', $plan->late_payment_daily_fine_rate ?? 0.1) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Late Payment Daily Fine Rate</div>
                        @error('late_payment_daily_fine_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Late Payment Fine Start After Days -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input
                                class="form-control @error('late_payment_fine_start_after_days') is-invalid @enderror"
                                type="number" name="late_payment_fine_start_after_days"
                                value="{{ old('late_payment_fine_start_after_days', $plan->late_payment_fine_start_after_days ?? 0) }}">
                            <span class="input-group-text">Days</span>
                        </div>
                        <div class="field-placeholder">Fine Starts After (Days)</div>
                        @error('late_payment_fine_start_after_days')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Stamp Duty Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('stamp_duty_rate') is-invalid @enderror" type="number"
                                step="0.01" name="stamp_duty_rate"
                                value="{{ old('stamp_duty_rate', $plan->stamp_duty_rate ?? 0) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Stamp Duty Rate</div>
                        @error('stamp_duty_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Insurance Rate -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('insurance_rate') is-invalid @enderror" type="number"
                                step="0.01" name="insurance_rate"
                                value="{{ old('insurance_rate', $plan->insurance_rate ?? 0) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="field-placeholder">Insurance Rate</div>
                        @error('insurance_rate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <!-- Grace Period -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('grace_period_days') is-invalid @enderror" type="number"
                                name="grace_period_days"
                                value="{{ old('grace_period_days', $plan->grace_period_days ?? 0) }}">
                            <span class="input-group-text">Days</span>
                        </div>
                        <div class="field-placeholder">Grace Period (Days)</div>
                        @error('grace_period_days') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="1" {{ old('status', $plan->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $plan->status ?? 1) == 0 ? 'selected' : ''
                                    }}>Inactive</option>
                            </select>
                            <span class="input-group-text"><i class="icon-check"></i></span>
                        </div>
                        <div class="field-placeholder">Status</div>
                        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
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