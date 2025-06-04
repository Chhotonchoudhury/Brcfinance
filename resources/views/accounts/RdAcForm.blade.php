@extends('layouts/app')
@section('title') RD Account Create @endsection

<style>
    .form-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .form-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .form-switch-slider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 24px;
    }

    .form-switch-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    .form-switch input:checked+.form-switch-slider {
        background-color: #007bff;
    }

    .form-switch input:checked+.form-switch-slider:before {
        transform: translateX(26px);
    }
</style>
@section('content')

<div class="row gutters mb-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">RD Account</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <!-- Top Actions - DateRange and Buttons -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('rdAc.account') }}" class="btn btn-sm btn-outline-dark py-1 px-2"
                onclick="showLoadingEffect(event)">
                <span class="icon-arrow-left"></span> Back
                <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;" role="status">
                </span>

            </a>
        </div>
    </div>
</div>
<div class="card">
    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="header-left">
            <h5 class="card-title mb-0">Create New RD Account</h5>
            <p class="text-muted small mb-0">Fill in the form below to create a new account</p>
        </div>
        <div class="header-right">
            <button class="btn btn-outline-primary btn-sm py-1 px-2">Help</button>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('rdAc.store') }}" id="SAstore" method="POST">
        @csrf

        <!-- Card Body -->
        <div class="card-body">
            <div class="row gutters">

                <div class="row gutters">
                    <!-- Members Select -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <div class="">
                                <select class="select-single js-states @error('member_id') is-invalid @enderror"
                                    name="member_id" id="memberSelect">
                                    <option selected>Select Member</option>
                                    @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id')==$member->id ? 'selected'
                                        : ''
                                        }}>
                                        {{ $member->first_name }} {{ $member->last_name }} ({{$member->member_code}})
                                    </option>
                                    @endforeach
                                </select>
                                <div class="field-placeholder">Members <span class="text-danger">*</span></div>
                            </div>
                            @error('member_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Branches Select -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <select class="select-single js-states @error('branch_id') is-invalid @enderror"
                                name="branch_id">
                                <option selected>Select Branch</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id')==$branch->id ? 'selected' : ''
                                    }}>
                                    {{ $branch->branch_name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="field-placeholder">Branches <span class="text-danger">*</span></div>
                        </div>
                        @error('branch_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Plans Select -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <select class="select-single js-states @error('rd_plan_id') is-invalid @enderror"
                                name="rd_plan_id" id="savingsPlanSelect">
                                <option selected>Select Plan</option>
                                @foreach($rdPlans as $plan)
                                <option value="{{ $plan->id }}" {{ old('rd_plan_id')==$plan->id ? 'selected' :
                                    ''
                                    }}>
                                    {{ $plan->plan_name }} #{{ $plan->plan_code }}
                                </option>
                                @endforeach
                            </select>
                            <div class="field-placeholder">Plans <span class="text-danger">*</span></div>
                        </div>
                        @error('rd_plan_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                      <!-- Agents Employee Id Select  -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper">
                            <select class="select-single js-states @error('agent_id') is-invalid @enderror"
                                name="agent_id">
                                <option selected value="">Select Agent / Employee</option>
                                @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ old('agent_id')==$agent->id ? 'selected' : ''
                                    }}>
                                    {{ $agent->name }} ({{ $agent->user_type }})
                                </option>
                                @endforeach
                            </select>
                            <div class="field-placeholder">Agents / Employee</div>
                        </div>
                        @error('agent_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberName">
                            <div class="field-placeholder">Member Name </div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberCode">
                            <div class="field-placeholder">Member Code </div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberEmail">
                            <div class="field-placeholder">Member Email</div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control" type="text" readonly id="memberPhone">
                            <div class="field-placeholder">Member Phone</div>
                        </div>
                        <!-- Field wrapper end -->
                    </div>
                </div>

                <div class="row gutters">
                    <!-- Minimum Amount -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control @error('minimum_amount') is-invalid @enderror" type="number"
                                id="minimumAmount" name="minimum_amount" value="{{ old('minimum_amount') }}"
                                placeholder="Enter Minimum Amount">
                            <div class="field-placeholder">Minimum Amount <span class="text-danger">*</span></div>
                            <div id="minimumAmountMessage"
                                class="form-text d-none p-2 bg-light border rounded text-danger shadow-sm">
                                Minimum amount :- <span id="minimumAmountValue" style="font-weight: bold;"></span>
                                required .
                            </div>
                            @error('minimum_amount')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <!-- Opening Date -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control @error('opeaning_date') is-invalid @enderror" type="date"
                                name="opeaning_date" value="{{ old('opeaning_date') }}">
                            <div class="field-placeholder">Opening Date <span class="text-danger">*</span> </div>
                            @error('opeaning_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Field wrapper end -->
                    </div>

                    <!-- TDS -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">TDS Deduct</label>
                            <label class="form-switch">
                                <input type="hidden" name="tds" value="0">
                                <input type="checkbox" name="tds" id="tds" value="1" {{ old('tds') ? 'checked' : '' }}>
                                <span class="form-switch-slider"></span>
                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- auto Renew -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Auto Renew</label>
                            <label class="form-switch">
                                <input type="hidden" name="renew" value="0">
                                <input type="checkbox" name="renew" id="renew" value="1" {{ old('renew') ? 'checked'
                                    : '' }}>
                                <span class="form-switch-slider"></span>
                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- auto Renew -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Senior St</label>
                            <label class="form-switch">
                                <input type="hidden" name="st" value="0">
                                <input type="checkbox" name="st" id="st" value="1" {{ old('st') ? 'checked' : '' }}>
                                <span class="form-switch-slider"></span>
                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                </div>



                <!-- Toggle Switch Row -->
                <div class="row gutters">
                    <!-- Open Account with Less Minimum Balance -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Open account with less minimum balance</label>
                            <label class="form-switch">
                                <input type="hidden" name="opened_with_less_minimum" value="0">
                                <input type="checkbox" name="opened_with_less_minimum" value="1"
                                    id="openedWithLessMinimum" {{ old('opened_with_less_minimum') ? 'checked' : '' }}>
                                <span class="form-switch-slider"></span>

                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- Account on Hold -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Account on hold</label>
                            <label class="form-switch">
                                <input type="hidden" name="account_on_hold" value="0">
                                <input type="checkbox" name="account_on_hold" id="accountOnHold" value="1" {{
                                    old('account_on_hold') ? 'checked' : '' }}>
                                <span class="form-switch-slider"></span>

                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- Joint Account -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Joint Account</label>
                            <label class="form-switch">
                                <input type="hidden" name="is_joint_account" value="0">
                                <input type="checkbox" name="is_joint_account" id="hasJoint" value="1" {{
                                    old('is_joint_account') ? 'checked' : '' }}>
                                <span class="form-switch-slider"></span>

                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>

                    <!-- Nominee -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="field-wrapper d-flex align-items-center">
                            <label class="me-2">Nominee</label>
                            <label class="form-switch">
                                <input type="hidden" name="has_nominee" value="0">
                                <input type="checkbox" name="has_nominee" id="hasNominee" value="1" {{
                                    old('has_nominee') ? 'checked' : '' }}>
                                <span class="form-switch-slider"></span>
                                <!-- Sends 0 when unchecked -->
                            </label>
                        </div>
                    </div>
                </div>


                <!-- Joint member section  -->
                <div id="joininfoSection" style="display: none;">
                    <div class="row gutters ">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                            <div class="form-section-header">Joint Account Memebr</div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <div class="">
                                    <select
                                        class="select-single js-states @error('joint_member_id') is-invalid @enderror"
                                        name="joint_member_id" id="joint_member_id">
                                        <option value="" selected>Select Member</option>
                                        @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ old('joint_member_id')==$member->id ?
                                            'selected' : '' }}>
                                            {{ $member->first_name }} {{ $member->last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="field-placeholder">Joint Member <span class="text-danger">*</span>
                                    </div>
                                </div>
                                @error('joint_member_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" id="JMemberName" readonly>
                                <div class="field-placeholder">Member Name <span class="text-danger">*</span></div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" id="JMemberCode" readonly>
                                <div class="field-placeholder">Member Code <span class="text-danger">*</span></div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" id="JMemberPhone" readonly>
                                <div class="field-placeholder">Member Phone<span class="text-danger">*</span></div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>

                    </div>
                </div>

                <!-- Nominee info -->
                <div id="nomineeInfoSection" style="display: none;">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Nominee Information</div>
                    </div>
                    <div class="row gutters">

                        <!-- Relationship -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <select class="form-control @error('relationship') is-invalid @enderror"
                                    name="relationship" id="relationship">
                                    <option selected disabled>Select Relationship</option>
                                    <option value="spouse" {{ old('relationship')=='spouse' ? 'selected' : '' }}>
                                        Spouse
                                    </option>
                                    <option value="parent" {{ old('relationship')=='parent' ? 'selected' : '' }}>
                                        Parent
                                    </option>
                                    <option value="child" {{ old('relationship')=='child' ? 'selected' : '' }}>Child
                                    </option>
                                    <option value="sibling" {{ old('relationship')=='sibling' ? 'selected' : '' }}>
                                        Sibling
                                    </option>
                                    <option value="other" {{ old('relationship')=='other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                <div class="field-placeholder">Relationship <span class="text-danger">*</span></div>
                                @error('relationship')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Full Name -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control @error('nominee_name') is-invalid @enderror" type="text"
                                    name="nominee_name" value="{{ old('nominee_name') }}" id="nomineeName"
                                    placeholder="Enter full name">
                                <div class="field-placeholder">Full Name <span class="text-danger">*</span></div>
                                @error('nominee_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Aadhar Number -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control @error('aadhar_number') is-invalid @enderror" type="text"
                                    name="aadhar_number" value="{{ old('aadhar_number') }}" id="aadharNumber"
                                    placeholder="Enter Aadhar number">
                                <div class="field-placeholder">Aadhar Number</div>
                                @error('aadhar_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Voter ID Number -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control @error('voter_id_number') is-invalid @enderror" type="text"
                                    name="voter_id_number" value="{{ old('voter_id_number') }}" id="voterIdNumber"
                                    placeholder="Enter Voter ID number">
                                <div class="field-placeholder">Voter ID Number</div>
                                @error('voter_id_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                                    name="phone_number" value="{{ old('phone_number') }}" id="phoneNumber"
                                    placeholder="Enter phone number">
                                <div class="field-placeholder">Phone Number</div>
                                @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Full Address -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="field-wrapper">
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                    id="address" rows="3"
                                    placeholder="Enter full address">{{ old('address') }}</textarea>
                                <div class="field-placeholder">Full Address</div>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Payment Information Section -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Payment Information</div>
                </div>

                <div class="row gutters mb-1">

                    <!-- Transaction Date -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <input class="form-control @error('transaction_date') is-invalid @enderror" type="date"
                                name="transaction_date" value="{{ old('transaction_date') }}">
                            <div class="field-placeholder">Transaction Date <span class="text-danger">*</span>
                            </div>
                            @error('transaction_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Field wrapper end -->
                    </div>
                    <!-- Payment Mode -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <!-- Field wrapper start -->
                        <div class="field-wrapper">
                            <select class="form-control @error('payment_mode') is-invalid @enderror" id="paymentMode"
                                name="payment_mode">
                                <option value="" selected disabled>Select Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online">Online</option>
                            </select>
                            <div class="field-placeholder">Payment Mode <span class="text-danger">*</span></div>
                            @error('payment_mode') is-invalid @enderror
                        </div>
                        <!-- Field wrapper end -->
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-text p-3 bg-light border rounded text-success shadow-sm"
                            style="font-weight: bold;">
                            Payable Balance Must Be: <span id="payableValue" class="fs-6 mb-2"> 0</span>/-
                        </div>
                    </div>
                </div>

                <!-- Cash Section -->
                <div id="cashSection" style="display: none;">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-section-header">Cash Denominations</div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_1">
                                <div class="field-placeholder">₹1 Notes</div>
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_5">
                                <div class="field-placeholder">₹5 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_10">
                                <div class="field-placeholder">₹10 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_20">
                                <div class="field-placeholder">₹20 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_50">
                                <div class="field-placeholder">₹50 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_100">
                                <div class="field-placeholder">₹100 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_200">
                                <div class="field-placeholder">₹200 Notes</div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="number" name="cash_500">
                                <div class="field-placeholder">₹500 Notes</div>
                            </div>
                        </div>
                        <!-- Add other cash inputs similarly -->
                    </div>
                </div>

                <!-- Cheque Section -->
                <div id="chequeSection" style="display: none;">
                    <div class="row gutters">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="cheque_number">
                                <div class="field-placeholder">Cheque Number</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="bank_name">
                                <div class="field-placeholder">Bank Name</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="branch_name">
                                <div class="field-placeholder">Branch Name</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="date" name="cheque_date">
                                <div class="field-placeholder">Cheque Date</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Online Section -->
                <div id="onlineSection" style="display: none;">
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="online_transaction_id">
                                <div class="field-placeholder">Transaction ID</div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="payment_gateway">
                                <div class="field-placeholder">Payment Gateway / Platfrom</div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="field-wrapper">
                                <textarea class="form-control" name="remarks" rows="3"
                                    placeholder="Details About the Transactiron"></textarea>
                                <div class="field-placeholder">Remarks</div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div class="footer-left">
                <p class="text-muted mb-0 small">Need help? Contact our <a href="#" class="text-primary">support
                        team</a>.</p>
            </div>
            <div class="footer-right">

                <button class="btn btn-sm btn-outline-primary py-1 px-2" id="DDsubmitButton" type="submit">
                    <span class="icon-save2"></span>
                    <span id="DDbuttonText"> Create </span>
                    <span id="DDloadingSpinner" class="spinner-border spinner-border-sm text-white d-none"
                        role="status">
                        <span class="visually-hidden">Creating...</span>
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>


</div>

@endsection

@section('script')

<script>
    new FormSubmitHandler('SAstore', 'DDsubmitButton', 'DDbuttonText', 'DDloadingSpinner');
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 for the dropdown
        $('#memberSelect').select2();

        // Attach the select2:select event
        $('#memberSelect').on('select2:select', function (e) {
            const selectedMemberId = e.params.data.id; // Get the selected member ID

            // Debugging: Show an alert or log the selected ID

            // Make an AJAX request to fetch member details
            if (selectedMemberId) {
                fetch(`/get-member-info/${selectedMemberId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Populate the fields with member details
                            document.getElementById('memberName').value = data.first_name + ' ' + data.last_name;
                            document.getElementById('memberCode').value = data.member_code;
                            document.getElementById('memberEmail').value = data.email;
                            document.getElementById('memberPhone').value = data.phone;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching member data:', error);
                    });
            } else {
                // Clear the input fields if no member is selected
                document.getElementById('memberName').value = '';
                document.getElementById('memberCode').value = '';
                document.getElementById('memberEmail').value = '';
                document.getElementById('memberPhone').value = '';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 for the dropdown
        $('#joint_member_id').select2();

        // Attach the select2:select event
        $('#joint_member_id').on('select2:select', function (e) {
            const MemberId = e.params.data.id; // Get the selected member ID

            // Make an AJAX request to fetch member details
            if (MemberId) {
                fetch(`/get-member-info/${MemberId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                        
                            // Populate the fields with member details
                            document.getElementById('JMemberName').value = data.first_name + ' ' + data.last_name;
                            document.getElementById('JMemberCode').value = data.member_code;
                            document.getElementById('JMemberPhone').value = data.phone;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching member data:', error);
                    });
            } else {
                // Clear the input fields if no member is selected
                document.getElementById('JMemberName').value = '';
                document.getElementById('JMemberCode').value = '';
                document.getElementById('JMemberPhone').value = '';
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2 for the plan dropdown
        $('#savingsPlanSelect').select2();

        // Attach event listener for when a plan is selected
        $('#savingsPlanSelect').on('select2:select', function (e) {
            const selectedPlanId = e.params.data.id;

            // Make an AJAX request to fetch plan details
            if (selectedPlanId) {
                fetch(`/get-plan-info-rd/${selectedPlanId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.minimum_amount) {
                            // Update the minimum amount field and message
                            document.getElementById('minimumAmount').value = data.minimum_amount;
                            document.getElementById('minimumAmountValue').textContent = data.minimum_amount;
                            document.getElementById('payableValue').textContent = data.minimum_amount;
                            document.getElementById('minimumAmountMessage').classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching plan data:', error);
                    });
            } else {
                // Clear the minimum amount field and hide the message
                document.getElementById('minimumAmount').value = '';
                document.getElementById('minimumAmountValue').textContent = '';
                document.getElementById('payableValue').textContent = '';
                document.getElementById('minimumAmountMessage').classList.add('d-none');
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const hasNomineeCheckbox = document.getElementById("hasNominee");
    const nomineeInfoSection = document.getElementById("nomineeInfoSection");

    const hasJointCheckbox = document.getElementById("hasJoint");
    const jointInfoSection = document.getElementById("joininfoSection");

    // Function to toggle the visibility of the Nominee Information section
    const toggleNomineeSection = () => {
        if (hasNomineeCheckbox.checked) {
            nomineeInfoSection.style.display = "block";
        } else {
            nomineeInfoSection.style.display = "none";
        }
    };

     // Function to toggle the visibility of the Nominee Information section
     const toggleJointSection = () => {
        if (hasJointCheckbox.checked) {
            jointInfoSection.style.display = "block";
        } else {
            jointInfoSection.style.display = "none";
        }
    };

    // Initialize visibility based on checkbox state
    toggleNomineeSection();
    toggleJointSection();

    // Add event listener for checkbox changes
    hasNomineeCheckbox.addEventListener("change", toggleNomineeSection);
    hasJointCheckbox.addEventListener("change", toggleJointSection);
  });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const hasNomineeCheckbox = document.getElementById("hasNominee");
    const nomineeInfoSection = document.getElementById("nomineeInfoSection");

    

    // Function to toggle the visibility of the Nominee Information section
    const toggleNomineeSection = () => {
        nomineeInfoSection.style.display = hasNomineeCheckbox.checked ? "block" : "none";
    };

    // Function to toggle the visibility of the Joint Member section
    const toggleJointSection = () => {
        jointInfoSection.style.display = hasJointCheckbox.checked ? "block" : "none";
    };

    // Initialize visibility based on checkbox states
    toggleNomineeSection();
    toggleJointSection();

    // Add event listeners for checkbox changes
    hasNomineeCheckbox.addEventListener("change", toggleNomineeSection);
    hasJointCheckbox.addEventListener("change", toggleJointSection);
  });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const paymentModeSelect = document.getElementById("paymentMode");
        const cashSection = document.getElementById("cashSection");
        const chequeSection = document.getElementById("chequeSection");
        const onlineSection = document.getElementById("onlineSection");

        // Function to toggle sections based on payment mode
        const togglePaymentSections = () => {
            const selectedMode = paymentModeSelect.value;

            // Hide all sections
            cashSection.style.display = "none";
            chequeSection.style.display = "none";
            onlineSection.style.display = "none";

            // Show the relevant section
            if (selectedMode === "cash") {
                cashSection.style.display = "block";
            } else if (selectedMode === "cheque") {
                chequeSection.style.display = "block";
            } else if (selectedMode === "online") {
                onlineSection.style.display = "block";
            }
        };

        // Add event listener to dropdown
        paymentModeSelect.addEventListener("change", togglePaymentSections);

        // Initialize visibility on page load
        togglePaymentSections();
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const minimumAmountInput = document.getElementById("minimumAmount");
        const payableValueSpan = document.getElementById("payableValue");

        // Function to update the payable value dynamically
        const updatePayableValue = () => {
            const minimumAmount = parseFloat(minimumAmountInput.value) || 0; // Default to 0 if input is empty or invalid
            payableValueSpan.textContent = minimumAmount.toFixed(2); // Format to 2 decimal places
        };

        // Add event listener to the minimum amount input field
        minimumAmountInput.addEventListener("input", updatePayableValue);

        // Initialize payable value on page load
        updatePayableValue();
    });
</script>

@endsection