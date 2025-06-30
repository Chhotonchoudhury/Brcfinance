@extends('layouts.app')

@section('content')
<div class="container">
     <div class="d-flex justify-content-between align-items-center mb-1">
        <h4>Document Verification for Loan: <strong>{{ $loan->application_number }}</strong></h4>
        <a href="{{ route('LoanADApplication.underDocVerify') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Applications
        </a>
    </div>

   <div class="card mt-1 border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom">
        <h5 class="mb-1 mt-0 fw-semibold text-primary">Applicant Summary</h5>
    </div>

    <div class="card-body py-4">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="small text-muted">Full Name</div>
                <div class="fw-semibold">
                    {{ $member->title }} {{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="small text-muted">Father's Name</div>
                <div class="fw-semibold">{{ $member->father_name ?? '—' }}</div>
            </div>

            <div class="col-md-4">
                <div class="small text-muted">Mobile</div>
                <div class="fw-semibold">{{ $member->mobile_number }}</div>
            </div>

            <div class="col-md-4">
                <div class="small text-muted">Email</div>
                <div class="fw-semibold">{{ $member->email }}</div>
            </div>

            <div class="col-md-4">
                <div class="small text-muted">Date of Birth</div>
                <div class="fw-semibold">{{ \Carbon\Carbon::parse($member->date_of_birth)->format('d M Y') }}</div>
            </div>

            <div class="col-md-6">
                <div class="small text-muted">Aadhaar Number</div>
                <div class="fw-semibold">{{ $member->aadhaar_number ?? '—' }}</div>
            </div>

            <div class="col-md-6">
                <div class="small text-muted">PAN Number</div>
                <div class="fw-semibold">{{ $member->pan_number ?? '—' }}</div>
            </div>

            <div class="col-12">
                <div class="small text-muted">Address</div>
                <div class="fw-semibold">
                    {{ $member->correspondence_address_line1 }},
                    {{ $member->correspondence_address_line2 }},
                    {{ $member->para }},
                    {{ $member->panchayat }},
                    {{ $member->city }},
                    {{ $member->state }},
                    {{ $member->pincode }},
                    {{ $member->country }}
                </div>
            </div>
        </div>
    </div>
</div>



    <div class="row">
        @php
            $documents = [
                'photo' => 'Photo',
                'signature' => 'Signature',
                'driving_license' => 'Driving License',
                'pan_card' => 'PAN Card',
                'aadhar_card' => 'Aadhaar Card',
            ];
        @endphp

        @foreach($documents as $key => $label)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>{{ $label }}</strong>
                        @if($member->$key)
                            <!-- <form method="POST" action="{{ route('loan-documents.destroy', [$loan->id, $key]) }}" onsubmit="return confirm('Delete this document?')">
                                @csrf
                                @method('DELETE') -->
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            <!-- </form> -->
                        @endif
                    </div>

                    <div class="card-body text-center">
                        <img src="{{ $member->$key ? asset('storage/' . $member->$key) : asset('assetsDashboard/img/no-image.png') }}"
                            alt="{{ $label }}" class="img-fluid mb-2" style="max-height: 200px; object-fit: contain;">
                        <!-- <form method="POST" action="{{ route('loan-documents.upload', [$loan->id, $key]) }}" enctype="multipart/form-data">
                            @csrf -->
                            <input type="file" name="document" class="form-control mb-2" required>
                            <button class="btn btn-primary btn-sm">Upload</button>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
