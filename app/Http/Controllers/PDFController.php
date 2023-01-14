<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePdf() {
        $pdf = PDF::loadView('myview');
        return $pdf->download('mypdf.pdf');
    }
}
