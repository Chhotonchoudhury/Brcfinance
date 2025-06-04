<?php

namespace App\Exports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
      // Define the headings for the columns
      public function headings(): array
      {
          return [
            'Branch Name',
              'Branch Code',
              'IFSC Code',
              'Branch Name',
              'Opening Date',
              'Contact Number',
              'Contact Email',
              'City',
              'Pin Code',
              'Status',
          ];
      }
  
      // Fetch the data to be exported
      public function collection()
      {
          return Branch::select('branch_name','branch_code', 'ifsc_code', 'branch_name', 'opening_date', 'contact_no', 'contact_email', 'city', 'pincode', 'status')->get();
      }
}
