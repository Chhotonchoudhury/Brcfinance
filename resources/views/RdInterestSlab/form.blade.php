@extends('layouts.app')

@section('title')
{{ isset($rdInterestSlab) ? 'Update Interest Slab' : 'Create Interest Slab' }}
@endsection

@section('content')
<div class="row gutters mb-2">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('rd-interest-slab.index') }}">Interest Slabs</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($rdInterestSlab) ? 'Edit' : 'Create' }}
                </li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 text-end">

        <a href="{{ route('rd-interest-slab.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
            onclick="showLoadingEffect(event)">
            <span class="icon-arrow-left"></span> Back
            <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
            </span>

        </a>
    </div>
</div>

<div class="card">
    <form action="{{ route('rd-interest-slab.save', $rdInterestSlab->id ?? '') }}" method="POST" id="marketCodeForm">
        @csrf

        <div class="card-body">
            <div class="form-section-header">
                {{ isset($rdInterestSlab) ? 'Update' : 'Create' }} RD Interest Slab
            </div>

            <div class="row gutters">
                <!-- Minimum Days -->
                <div class="col-md-2">
                    <div class="field-wrapper">
                        <input type="number" name="min_days"
                            class="form-control @error('min_days') is-invalid @enderror"
                            value="{{ old('min_days', $rdInterestSlab->min_days ?? '') }}" required>
                        <div class="field-placeholder">Minimum Days <span class="text-danger">*</span></div>
                        @error('min_days')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Maximum Days -->
                <div class="col-md-2">
                    <div class="field-wrapper">
                        <input type="number" name="max_days"
                            class="form-control @error('max_days') is-invalid @enderror"
                            value="{{ old('max_days', $rdInterestSlab->max_days ?? '') }}" required>
                        <div class="field-placeholder">Maximum Days <span class="text-danger">*</span></div>
                        @error('max_days')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Interest Percentage -->
                <div class="col-md-3">
                    <div class="field-wrapper">
                        <input type="number" name="percentage"
                            class="form-control @error('percentage') is-invalid @enderror"
                            value="{{ old('percentage', $rdInterestSlab->percentage ?? '') }}" required step="0.01">
                        <div class="field-placeholder">Interest Percentage % <span class="text-danger">*</span></div>
                        @error('percentage')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Remarks -->
                <div class="col-md-3">
                    <div class="field-wrapper">
                        <select name="remarks" class="form-control @error('remarks') is-invalid @enderror" required>
                            <option value="">Select Remarks</option>
                            @php $selectedRemarks = old('remarks', $rdInterestSlab->remarks ?? '') @endphp

                            <option value="Free Maturity" {{ $selectedRemarks=='Free Maturity' ? 'selected' : '' }}>Free
                                Maturity</option>
                            <option value="Pre Maturity" {{ $selectedRemarks=='Pre Maturity' ? 'selected' : '' }}>Pre
                                Maturity</option>
                            <option value="Full Maturity" {{ $selectedRemarks=='Full Maturity' ? 'selected' : '' }}>Full
                                Maturity</option>

                        </select>
                        <div class="field-placeholder">Remarks <span class="text-danger">*</span></div>
                        @error('remarks')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <div class="field-wrapper">
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $rdInterestSlab->status ?? 1) == 1 ? 'selected' : ''
                                }}>Active</option>
                            <option value="0" {{ old('status', $rdInterestSlab->status ?? 1) == 0 ? 'selected' : ''
                                }}>Inactive</option>
                        </select>
                        <div class="field-placeholder">Status <span class="text-danger">*</span></div>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="SVsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="SVbuttonText">@if(isset($rdInterestSlab->id)) Update @else Submit @endif </span>
                <span id="SVloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
                    <span class="visually-hidden">Submitting...</span>
                </span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('script')

<script>
    new FormSubmitHandler('marketCodeForm', 'SVsubmitButton', 'SVbuttonText', 'SVloadingSpinner');
</script>

@endsection