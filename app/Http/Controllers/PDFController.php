<?php

namespace App\Http\Controllers;

// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePdf($name, $email, $event, $price) {
        $pdf = Pdf::loadView('myview', ['name'=> $name, 'email' => $email, 'event' => $event, 'price' => $price]);
        return $pdf->download('invoice.pdf');
    }
}
