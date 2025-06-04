@extends('layouts.app')

@section('title')
{{ isset($marketCode) ? 'Update Market Code' : 'Create Market Code' }}
@endsection

@section('content')
<div class="row gutters mb-2">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('marketcode.index') }}">Market Codes</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($marketCode) ? 'Edit' : 'Create' }}</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 text-end">

        <a href="{{ route('marketcode.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
            onclick="showLoadingEffect(event)">
            <span class="icon-arrow-left"></span> Back
            <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
            </span>

        </a>
    </div>
</div>

<div class="card">
    <form action="{{ route('marketcode.save', $marketCode->id ?? '') }}" method="POST" id="marketCodeForm">
        @csrf

        <div class="card-body">
            <div class="form-section-header">
                {{ isset($marketCode) ? 'Update' : 'Create' }} Market Code
            </div>

            <div class="row gutters">
                <!-- Code -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                            value="{{ old('code', $marketCode->code ?? '') }}" required>
                        <div class="field-placeholder">Code <span class="text-danger">*</span></div>
                        @error('code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Area Name -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="text" name="area_name"
                            class="form-control @error('area_name') is-invalid @enderror"
                            value="{{ old('area_name', $marketCode->area_name ?? '') }}" required>
                        <div class="field-placeholder">Area Name <span class="text-danger">*</span></div>
                        @error('area_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Pincode -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror"
                            value="{{ old('pincode', $marketCode->pincode ?? '') }}" required>
                        <div class="field-placeholder">Pincode <span class="text-danger">*</span></div>
                        @error('pincode')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- District -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="text" name="district" class="form-control @error('district') is-invalid @enderror"
                            value="{{ old('district', $marketCode->district ?? '') }}">
                        <div class="field-placeholder">District</div>
                        @error('district')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- State -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror"
                            value="{{ old('state', $marketCode->state ?? '') }}">
                        <div class="field-placeholder">State</div>
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Country -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                            value="{{ old('country', $marketCode->country ?? 'India') }}" required>
                        <div class="field-placeholder">Country <span class="text-danger">*</span></div>
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- Latitude -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="number" step="0.000001" name="latitude"
                            class="form-control @error('latitude') is-invalid @enderror"
                            value="{{ old('latitude', $marketCode->latitude ?? '') }}">
                        <div class="field-placeholder">Latitude</div>
                        @error('latitude')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Longitude -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <input type="number" step="0.000001" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror"
                            value="{{ old('longitude', $marketCode->longitude ?? '') }}">
                        <div class="field-placeholder">Longitude</div>
                        @error('longitude')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-4">
                    <div class="field-wrapper">
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $marketCode->status ?? 1) == 1 ? 'selected' : ''
                                }}>Active</option>
                            <option value="0" {{ old('status', $marketCode->status ?? 1) == 0 ? 'selected' : ''
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
                <span id="SVbuttonText">@if(isset($marketCode->id)) Update @else Submit @endif </span>
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