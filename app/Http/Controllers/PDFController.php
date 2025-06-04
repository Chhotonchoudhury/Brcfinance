<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BranchesExport;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Branch;
use App\Models\Memeber;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //

    public function BranchExportPDF(){
        $branches = Branch::all();
    
        $html = view('tblExport.branch-pdf', compact('branches'))->render(); // Render the HTML content
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html); // Load the HTML content
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render(); // Render the PDF
        $dompdf->stream('branch-report.pdf'); // Stream the PDF to the browser
    }

    public function MemberExportPDF(){
        $members = Memeber::all();
    
        $html = view('tblExport.member-pdf', compact('members'))->render(); // Render the HTML content
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html); // Load the HTML content
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render(); // Render the PDF
        $dompdf->stream('member-report.pdf'); // Stream the PDF to the browser
    }
}
