<?php

namespace App\Http\Controllers;
require('../phpqrcode/qrlib.php');
use PhpOffice\PhpSpreadsheet\IOFactory;

// use Milon\Barcode\DNS1D;

use Illuminate\Http\Request;

class ExcelReaderController extends Controller
{
    public function readExcel()
    {
        $file = public_path('Attendee_Summary_Report.xlsx');
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();

        $cellValue = $worksheet->getCellByColumnAndRow(1, 1)->getValue();
        $worksheetArray = $worksheet->toArray();
        array_shift($worksheetArray);

        return view('allview', [
            'cell' => $cellValue,
            'worksheet' => $worksheetArray
        ]);
    }

    public function viewPage($name){
        $file = public_path('Attendee_Summary_Report.xlsx');
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheetArray = $worksheet->toArray();
        array_shift($worksheetArray);
        $worksheetArray = $worksheet->toArray();



         // Search for the value in the array
        //  dd(array_column($worksheetArray, 3));
         $searchResult = array_search($name, array_column($worksheetArray, 3));

         if ($searchResult !== false) {
            $row = $searchResult + 1;

            $name = $worksheetArray[$searchResult][3];
            $email = $worksheetArray[$searchResult][4];
            $qrcode = $worksheetArray[$searchResult][11];
            $event = $worksheetArray[$searchResult][5];
            $price = $worksheetArray[$searchResult][8];

            if(!file_exists(public_path('barcodes/'.$name.'.png'))){
                \QRcode::png((string)$qrcode, public_path('barcodes/'.$name.'.png'));
            }

            return view('myview', ['name'=> $name, 'email' => $email, 'event' => $event, 'price' => $price, 'qrcode' => $qrcode]);
         } else {
             // The value was not found in the array
             return "Value '$name' not found in the sheet";
         }

    }
}
