@extends('layouts/app')
@section('title') Member Store @endsection


@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Member</a></li>
                <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('member.index') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <form action="{{ route('member.save', $member->id ?? '') }}" id="Memberstore" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}


            <!-- General Info Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif General Info</div>
            </div>

            <!-- Row Start -->
            <div class="row gutters">
                <!-- Branch -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control js-states select2 @error('branch_id') is-invalid @enderror"
                                id="select2" name="branch_id">
                                <option value="" {{ old('branch_id', $member->branch_id ?? '') == '' ? 'selected' :
                                    '' }}>Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $member->branch_id ?? '') ==
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

                <!-- Agent / Employee / assosiacre  -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="" {{ old('user_id', $member->user_id ?? '') == '' ? 'selected' : ''
                                    }}>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $member->user_id ?? '') ==
                                    $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->user_type }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-placeholder">Agent / Employee / assosiate</div>
                        @error('user_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Enrollment Date -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('enrollment_date') is-invalid @enderror" type="date"
                                name="enrollment_date"
                                value="{{ old('enrollment_date', $member->enrollment_date ?? '') }}">
                        </div>
                        <div class="field-placeholder">Enrollment Date <span class="text-danger">*</span></div>
                        @error('enrollment_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!---application number--->
                @php
                    $nextApplicationNumber = \App\Models\Memeber::getNextApplicationNumber();
                @endphp
                
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('application_number') is-invalid @enderror" type="text"
                                name="application_number"
                                value="{{ old('application_number', $nextApplicationNumber) }}" required>
                            <span class="input-group-text">
                                #
                            </span>
                        </div>
                        <div class="field-placeholder">Application Number <span class="text-danger">*</span></div>
                        @error('application_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



            </div>
            <!-- Row End -->

            <!-- Row start -->
            <div class="row gutters">
                <!-- Title -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('title') is-invalid @enderror" name="title">
                                <option value="" {{ old('title', $member->title ?? '') == '' ? 'selected' : ''
                                    }}>Select Title</option>
                                <option value="Mr" {{ old('title', $member->title ?? '') == 'Mr' ? 'selected' : ''
                                    }}>Mr</option>
                                <option value="Mrs" {{ old('title', $member->title ?? '') == 'Mrs' ? 'selected' : ''
                                    }}>Mrs</option>
                                <option value="Miss" {{ old('title', $member->title ?? '') == 'Miss' ? 'selected' :
                                    '' }}>Miss</option>
                            </select>
                        </div>
                        <div class="field-placeholder">Title</div>
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- First Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text"
                                name="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">First Name <span class="text-danger">*</span></div>
                        @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Middle Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('middle_name') is-invalid @enderror" type="text"
                                name="middle_name" value="{{ old('middle_name', $member->middle_name ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Middle Name</div>
                        @error('middle_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text"
                                name="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" required>
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Last Name <span class="text-danger">*</span></div>
                        @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row Start -->
            <div class="row gutters">
                <!-- Gender -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="" {{ old('gender', $member->gender ?? '') == '' ? 'selected' : ''
                                    }}>Select Gender</option>
                                <option value="male" {{ old('gender', $member->gender ?? '') == 'male' ? 'selected'
                                    : '' }}>Male</option>
                                <option value="female" {{ old('gender', $member->gender ?? '') == 'female' ?
                                    'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $member->gender ?? '') == 'other' ?
                                    'selected' : '' }}>Other</option>
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
                                value="{{ old('date_of_birth', isset($member) && $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d') : '') }}"
                                required>

                        </div>
                        <div class="field-placeholder">Date of Birth <span class="text-danger">*</span></div>
                        @error('date_of_birth')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Father's Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('father_name') is-invalid @enderror" type="text"
                                name="father_name" value="{{ old('father_name', $member->father_name ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-person"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Father's Name</div>
                        @error('father_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Mother's Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('mother_name') is-invalid @enderror" type="text"
                                name="mother_name" value="{{ old('mother_name', $member->mother_name ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-person"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Mother's Name</div>
                        @error('mother_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Row End -->

            <!-- New Fields Row -->
            <div class="row gutters">
                <!-- Occupation -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('occupation') is-invalid @enderror" type="text"
                                name="occupation" value="{{ old('occupation', $member->occupation ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-card_travel"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Occupation</div>
                        @error('occupation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Monthly Income -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('monthly_income') is-invalid @enderror" type="number"
                                step="0.01" name="monthly_income"
                                value="{{ old('monthly_income', $member->monthly_income ?? '') }}">
                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Monthly Income</div>
                        @error('monthly_income')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Annual Income -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('annual_income') is-invalid @enderror" type="number"
                                step="0.01" name="annual_income"
                                value="{{ old('annual_income', $member->annual_income ?? '') }}">

                            <span class="input-group-text">
                                ₹
                            </span>
                        </div>
                        <div class="field-placeholder">Annual Income</div>
                        @error('annual_income')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <!-- Ex-Service Person -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('ex_service_person') is-invalid @enderror"
                                    type="checkbox" id="ex_service_person" name="ex_service_person" value="1" {{
                                    old('ex_service_person', $member->ex_service_person ?? '') ? 'checked' : '' }}>
                                <label class="form-check-label" for="ex_service_person">Ex-Service Person</label>
                            </div>
                        </div>
                        @error('ex_service_person')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="field-placeholder">Ex-Service Person</div>
                    </div>
                    <!-- Field wrapper end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- New Fields Row -->
            <div class="row gutters">

                <!-- Marital Status -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('marital_status') is-invalid @enderror"
                                    type="radio" id="single" name="marital_status" value="single" {{
                                    old('marital_status', $member->marital_status ?? '') == 'single' ? 'checked' :
                                '' }}>
                                <label class="form-check-label" for="single">Single</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('marital_status') is-invalid @enderror"
                                    type="radio" id="married" name="marital_status" value="married" {{
                                    old('marital_status', $member->marital_status ?? '') == 'married' ? 'checked' :
                                '' }}>
                                <label class="form-check-label" for="married">Married</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('marital_status') is-invalid @enderror"
                                    type="radio" id="divorced" name="marital_status" value="divorced" {{
                                    old('marital_status', $member->marital_status ?? '') == 'divorced' ? 'checked' :
                                '' }}>
                                <label class="form-check-label" for="divorced">Divorced</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('marital_status') is-invalid @enderror"
                                    type="radio" id="widowed" name="marital_status" value="widowed" {{
                                    old('marital_status', $member->marital_status ?? '') == 'widowed' ? 'checked' :
                                '' }}>
                                <label class="form-check-label" for="widowed">Widowed</label>
                            </div>
                        </div>
                        @error('marital_status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="field-placeholder">Marital Status</div>
                    </div>
                    <!-- Field wrapper end -->
                </div>


                <!-- Husband/Spouse Name -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('husband_spouse') is-invalid @enderror" type="text"
                                name="husband_spouse"
                                value="{{ old('husband_spouse', $member->husband_spouse ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-person"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Husband/Spouse Name</div>
                        @error('husband_spouse')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <!-- Row end -->

            <!-- General Info Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Phone & Email</div>
            </div>

            <!-- Email and Mobile Activation -->
            <div class="row gutters">

                <!-- Mobile Number -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('mobile_number') is-invalid @enderror" type="text"
                                name="mobile_number" value="{{ old('mobile_number', $member->mobile_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-phone"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Mobile Number</div>
                        @error('mobile_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Mobile Active Checkbox -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('mobile_is_active') is-invalid @enderror"
                                    type="checkbox" id="mobile_is_active" name="mobile_is_active" {{
                                    old('mobile_is_active', $member->mobile_is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobile_is_active">Mobile Active</label>
                            </div>
                        </div>
                        @error('mobile_is_active')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Email Address -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                value="{{ old('email', $member->email ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-mail"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Email Address</div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email Active Checkbox -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('email_is_active') is-invalid @enderror"
                                    type="checkbox" id="email_is_active" name="email_is_active" {{
                                    old('email_is_active', $member->email_is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_is_active">Email Active</label>
                            </div>
                        </div>
                        @error('email_is_active')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- General Info Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Identification Info</div>
            </div>


            <!-- Aadhaar, Voter ID, PAN, Ration Card, Meter, CI, and DL Number in Same Row -->
            <div class="row gutters">
                <!-- Aadhaar Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('aadhaar_number') is-invalid @enderror" type="text"
                                name="aadhaar_number"
                                value="{{ old('aadhaar_number', $member->aadhaar_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Aadhaar Number</div>
                        @error('aadhaar_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Voter ID -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('voter_id') is-invalid @enderror" type="text"
                                name="voter_id" value="{{ old('voter_id', $member->voter_id ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Voter ID</div>
                        @error('voter_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- PAN Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('pan_number') is-invalid @enderror" type="text"
                                name="pan_number" value="{{ old('pan_number', $member->pan_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">PAN Number</div>
                        @error('pan_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Ration Card Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ration_card_number') is-invalid @enderror" type="text"
                                name="ration_card_number"
                                value="{{ old('ration_card_number', $member->ration_card_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Ration Card Number</div>
                        @error('ration_card_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- Meter Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('meter_number') is-invalid @enderror" type="text"
                                name="meter_number" value="{{ old('meter_number', $member->meter_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Meter Number</div>
                        @error('meter_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CI Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ci_number') is-invalid @enderror" type="text"
                                name="ci_number" value="{{ old('ci_number', $member->ci_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-info"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">CI Number</div>
                        @error('ci_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CI Relation -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('ci_relation') is-invalid @enderror" type="text"
                                name="ci_relation" value="{{ old('ci_relation', $member->ci_relation ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">CI Relation</div>
                        @error('ci_relation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Driving License Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="input-group">
                            <input class="form-control @error('dl_number') is-invalid @enderror" type="text"
                                name="dl_number" value="{{ old('dl_number', $member->dl_number ?? '') }}">
                            <span class="input-group-text">
                                <i class="icon-credit-card"></i>
                            </span>
                        </div>
                        <div class="field-placeholder">Driving License Number</div>
                        @error('dl_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Correspondence Address Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Correspondence Address</div>
            </div>

            <!-- Correspondence Address Fields -->
            <div class="row gutters">
                <!-- Address Line 1 (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text"
                            class="form-control @error('correspondence_address_line1') is-invalid @enderror"
                            name="correspondence_address_line1" required
                            value="{{ old('correspondence_address_line1', $member->correspondence_address_line1 ?? '') }}">
                        <div class="field-placeholder">Address Line 1 <span class="text-danger">*</span></div>
                        @error('correspondence_address_line1')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address Line 2 -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text"
                            class="form-control @error('correspondence_address_line2') is-invalid @enderror"
                            name="correspondence_address_line2"
                            value="{{ old('correspondence_address_line2', $member->correspondence_address_line2 ?? '') }}">
                        <div class="field-placeholder">Address Line 2</div>
                        @error('correspondence_address_line2')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Para -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('para') is-invalid @enderror" name="para"
                            value="{{ old('para', $member->para ?? '') }}">
                        <div class="field-placeholder">Para</div>
                        @error('para')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Panchayat -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('panchayat') is-invalid @enderror"
                            name="panchayat" value="{{ old('panchayat', $member->panchayat ?? '') }}">
                        <div class="field-placeholder">Panchayat</div>
                        @error('panchayat')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- Ward -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('ward') is-invalid @enderror" name="ward"
                            value="{{ old('ward', $member->ward ?? '') }}">
                        <div class="field-placeholder">Ward</div>
                        @error('ward')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Area -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('area') is-invalid @enderror" name="area"
                            value="{{ old('area', $member->area ?? '') }}">
                        <div class="field-placeholder">Area</div>
                        @error('area')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Landmark (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('landmark') is-invalid @enderror" name="landmark"
                            required value="{{ old('landmark', $member->landmark ?? '') }}">
                        <div class="field-placeholder">Landmark <span class="text-danger">*</span></div>
                        @error('landmark')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- City (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" required
                            value="{{ old('city', $member->city ?? '') }}">
                        <div class="field-placeholder">City <span class="text-danger">*</span></div>
                        @error('city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- State (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('state') is-invalid @enderror" name="state"
                            required value="{{ old('state', $member->state ?? '') }}">
                        <div class="field-placeholder">State <span class="text-danger">*</span></div>
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Pincode (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode"
                            required value="{{ old('pincode', $member->pincode ?? '') }}">
                        <div class="field-placeholder">Pincode <span class="text-danger">*</span></div>
                        @error('pincode')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Country (disabled) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control" name="country" value="India" readonly>
                        <div class="field-placeholder">Country</div>
                    </div>
                </div>
            </div>


            <!-- Permanent Address Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Permanent Address</div>
            </div>

            <!-- Permanent Address Fields -->
            <div class="row gutters">
                <!-- Permanent Address Line 1 (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('permanent_address') is-invalid @enderror"
                            name="permanent_address"
                            value="{{ old('permanent_address', $member->permanent_address ?? '') }}" required>
                        <div class="field-placeholder">Permanent Address *</div>
                        @error('permanent_address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Permanent City -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('permanent_city') is-invalid @enderror"
                            name="permanent_city" value="{{ old('permanent_city', $member->permanent_city ?? '') }}">
                        <div class="field-placeholder">Permanent City</div>
                        @error('permanent_city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Permanent State (Required) -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('permanent_state') is-invalid @enderror"
                            name="permanent_state" value="{{ old('permanent_state', $member->permanent_state ?? '') }}"
                            required>
                        <div class="field-placeholder">Permanent State *</div>
                        @error('permanent_state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Permanent Pincode (Required) -->
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('permanent_pincode') is-invalid @enderror"
                            name="permanent_pincode"
                            value="{{ old('permanent_pincode', $member->permanent_pincode ?? '') }}" required>
                        <div class="field-placeholder">Permanent Pincode *</div>
                        @error('permanent_pincode')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="form-check">
                            <input class="form-check-input @error('use_as_communication_address') is-invalid @enderror"
                                type="checkbox" id="use_as_communication_address" name="use_as_communication_address" {{
                                old('use_as_communication_address', $member->use_as_communication_address ?? false) ?
                            'checked' : '' }}>
                            <label class="form-check-label" for="use_as_communication_address">Use as Communication
                                Address</label>
                        </div>
                        @error('use_as_communication_address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Address Geolocation Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Address Geolocation</div>
            </div>

            <!-- Address Geolocation Fields -->
            <div class="row gutters">
                <!-- Latitude -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('address_latitude') is-invalid @enderror"
                            name="address_latitude"
                            value="{{ old('address_latitude', $member->address_latitude ?? '') }}">
                        <div class="field-placeholder">Latitude</div>
                        @error('address_latitude')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Longitude -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('address_longitude') is-invalid @enderror"
                            name="address_longitude"
                            value="{{ old('address_longitude', $member->address_longitude ?? '') }}">
                        <div class="field-placeholder">Longitude</div>
                        @error('address_longitude')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Nominee Details Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Nominee Details</div>
            </div>

            <!-- Nominee Details Fields -->
            <div class="row gutters">
                <!-- Nominee Name (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_name') is-invalid @enderror"
                            name="nominee_name" required value="{{ old('nominee_name', $member->nominee_name ?? '') }}">
                        <div class="field-placeholder">Nominee Name <span class="text-danger">*</span></div>
                        @error('nominee_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nominee Relation (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_relation') is-invalid @enderror"
                            name="nominee_relation" required
                            value="{{ old('nominee_relation', $member->nominee_relation ?? '') }}">
                        <div class="field-placeholder">Nominee Relation <span class="text-danger">*</span></div>
                        @error('nominee_relation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nominee Mobile Number (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_mobile_number') is-invalid @enderror"
                            name="nominee_mobile_number" required
                            value="{{ old('nominee_mobile_number', $member->nominee_mobile_number ?? '') }}">
                        <div class="field-placeholder">Nominee Mobile Number <span class="text-danger">*</span>
                        </div>
                        @error('nominee_mobile_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nominee Aadhaar Number (Required) -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_aadhaar_number') is-invalid @enderror"
                            name="nominee_aadhaar_number" required
                            value="{{ old('nominee_aadhaar_number', $member->nominee_aadhaar_number ?? '') }}">
                        <div class="field-placeholder">Nominee Aadhaar Number <span class="text-danger">*</span>
                        </div>
                        @error('nominee_aadhaar_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- Nominee Voter ID -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_voter_id') is-invalid @enderror"
                            name="nominee_voter_id"
                            value="{{ old('nominee_voter_id', $member->nominee_voter_id ?? '') }}">
                        <div class="field-placeholder">Nominee Voter ID</div>
                        @error('nominee_voter_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nominee PAN Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_pan_number') is-invalid @enderror"
                            name="nominee_pan_number"
                            value="{{ old('nominee_pan_number', $member->nominee_pan_number ?? '') }}">
                        <div class="field-placeholder">Nominee PAN Number</div>
                        @error('nominee_pan_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nominee Ration Card Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text"
                            class="form-control @error('nominee_ration_card_number') is-invalid @enderror"
                            name="nominee_ration_card_number"
                            value="{{ old('nominee_ration_card_number', $member->nominee_ration_card_number ?? '') }}">
                        <div class="field-placeholder">Nominee Ration Card Number</div>
                        @error('nominee_ration_card_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nominee Address -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('nominee_address') is-invalid @enderror"
                            name="nominee_address" value="{{ old('nominee_address', $member->nominee_address ?? '') }}">
                        <div class="field-placeholder">Nominee Address</div>
                        @error('nominee_address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <!-- Bank Details Section -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">@if(isset($member->id)) Update @endif Bank Details</div>
            </div>

            <!-- Bank Details Fields -->
            <div class="row gutters">
                <!-- Bank Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror"
                            name="bank_name" value="{{ old('bank_name', $member->bank_name ?? '') }}">
                        <div class="field-placeholder">Bank Name</div>
                        @error('bank_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bank Code -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('bank_code') is-invalid @enderror"
                            name="bank_code" value="{{ old('bank_code', $member->bank_code ?? '') }}">
                        <div class="field-placeholder">Bank Code</div>
                        @error('bank_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Account Type -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <select class="form-control @error('account_type') is-invalid @enderror" name="account_type">
                            <option value="" disabled selected>Select Account Type</option>
                            <option value="savings" {{ old('account_type', $member->account_type ?? '') == 'savings'
                                ? 'selected' : '' }}>Savings</option>
                            <option value="current" {{ old('account_type', $member->account_type ?? '') == 'current'
                                ? 'selected' : '' }}>Current</option>
                        </select>
                        <div class="field-placeholder">Account Type</div>
                        @error('account_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Account Number -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                            name="account_number" value="{{ old('account_number', $member->account_number ?? '') }}">
                        <div class="field-placeholder">Account Number</div>
                        @error('account_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- IFSC Code -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('ifsc_code') is-invalid @enderror"
                            name="ifsc_code" value="{{ old('ifsc_code', $member->ifsc_code ?? '') }}">
                        <div class="field-placeholder">IFSC Code</div>
                        @error('ifsc_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Branch Name -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="text" class="form-control @error('branch_name') is-invalid @enderror"
                            name="branch_name" value="{{ old('branch_name', $member->branch_name ?? '') }}">
                        <div class="field-placeholder">Branch Name</div>
                        @error('branch_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <!-- Alerts and Notifications Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Alerts and Notifications</div>
                </div>

                <!-- SMS Alerts -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <div class="form-check">
                            <input class="form-check-input @error('enable_sms_alert') is-invalid @enderror"
                                type="checkbox" id="enable_sms_alert" name="enable_sms_alert" {{ old('enable_sms_alert',
                                $member->enable_sms_alert ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable_sms_alert">Enable SMS Alerts</label>
                        </div>
                        @error('enable_sms_alert')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Status -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="active" {{ old('status', $member->status ?? '') == 'active' ? 'selected'
                                : ''
                                }}>Active</option>
                            <option value="inactive" {{ old('status', $member->status ?? '') == 'inactive' ?
                                'selected'
                                : '' }}>Inactive</option>
                        </select>
                        <div class="field-placeholder">Member Account Status</div>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <!-- Document Uploads Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">@if(isset($member->id)) Update @endif Document Uploads</div>
                </div>

                <!-- Photo -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                            accept="image/*">
                        <div class="field-placeholder">Photo</div>
                        @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Signature -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control @error('signature') is-invalid @enderror"
                            name="signature" accept="image/*">
                        <div class="field-placeholder">Signature</div>
                        @error('signature')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Driving License -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control @error('driving_license') is-invalid @enderror"
                            name="driving_license" accept="image/*">
                        <div class="field-placeholder">Driving License</div>
                        @error('driving_license')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- PAN Card -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control @error('pan_card') is-invalid @enderror" name="pan_card"
                            accept="image/*">
                        <div class="field-placeholder">PAN Card</div>
                        @error('pan_card')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Aadhaar Card -->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="field-wrapper">
                        <input type="file" class="form-control @error('aadhar_card') is-invalid @enderror"
                            name="aadhar_card" accept="image/*">
                        <div class="field-placeholder">Aadhaar Card</div>
                        @error('aadhar_card')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            @if(!isset($member))
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
            <button class="btn btn-sm btn-outline-primary py-1 px-2" id="MsubmitButton" type="submit">
                <span class="icon-save2"></span>
                <span id="MbuttonText">@if(isset($member->id)) Update @else Submit @endif </span>
                <span id="MloadingSpinner" class="spinner-border spinner-border-sm text-white d-none" role="status">
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
    new FormSubmitHandler('Memberstore', 'MsubmitButton', 'MbuttonText', 'MloadingSpinner');
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Select the monthly income and annual income input fields
    const monthlyIncomeInput = document.querySelector("input[name='monthly_income']");
    const annualIncomeInput = document.querySelector("input[name='annual_income']");

    // Add an event listener to the monthly income input field
    monthlyIncomeInput.addEventListener('input', function () {
        // Get the value of the monthly income input
        const monthlyIncome = parseFloat(monthlyIncomeInput.value);

        // Check if the monthly income is a valid number
        if (!isNaN(monthlyIncome)) {
            // Calculate the annual income (monthly income * 12)
            const annualIncome = monthlyIncome * 12;

            // Set the value of the annual income input field
            annualIncomeInput.value = annualIncome.toFixed(2);
        } else {
            // If the input is invalid, clear the annual income field
            annualIncomeInput.value = '';
        }
    });
});

</script>

@endsection