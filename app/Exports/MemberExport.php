<?php

namespace App\Exports;
use App\Models\Memeber;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
      // Define the headings for the columns
      public function headings(): array
      {
          return [
              'Application No',
              'Member Code',
              'Branch Name',
              'First Name',
              'Last Name',
              'Email',
              'Phone',
              'Occupation',
              'Aadhaar No',
              'Landmark',
              'Pincode',
              'Joining Date',
              'Status',
          ];
      }
  
      // Fetch the data to be exported
      public function collection()
      {
          return Memeber::select(
              'application_number',  // Assuming 'application_code' exists in the member table
              'member_code',
              'branch_id',  // Assuming 'branch_id' is a foreign key to the branches table
              'first_name',
              'last_name',
              'email',
              'mobile_number',  // Assuming 'mobile_number' is the field for phone
              'occupation',
              'aadhaar_number',
              'landmark',
              'pincode',
              'enrollment_date',
              'status'
          )
          ->with('branch')  // Load the branch relation to get the branch name
          ->get()
          ->map(function ($member) {
              // Map the branch name to include it in the export
              return [
                  'application_code' => $member->application_code ?? 'N/A',
                  'member_code' => $member->member_code ?? 'N/A',
                  'branch_name' => $member->branch->branch_name ?? 'N/A',
                  'first_name' => $member->first_name,
                  'last_name' => $member->last_name,
                  'email' => $member->email,
                  'mobile_number' => $member->mobile_number,
                  'occupation' => $member->occupation,
                  'aadhaar_number' => $member->aadhaar_number,
                  'landmark' => $member->landmark,
                  'pincode' => $member->pincode,
                  'enrollment_date' => \Carbon\Carbon::parse($member->enrollment_date)->format('d-m-Y'),
                  'status' => $member->status == 1 ? 'Active' : 'Deactivated',
              ];
          });
      }
}
