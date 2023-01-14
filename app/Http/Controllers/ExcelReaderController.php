<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Listeners\GenerateTag;

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

    public function viewPage($order_id){
        $file = public_path('Attendee_Summary_Report.xlsx');
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheetArray = $worksheet->toArray();
        array_shift($worksheetArray);
        $worksheetArray = $worksheet->toArray();



         // Search for the value in the array
         $searchResult = array_search($order_id, array_column($worksheetArray, 0));

         if ($searchResult !== false) {
             // The value was found in the array
             $row = $searchResult + 1;

             $name = $worksheetArray[$searchResult][4];
             $email = $worksheetArray[$searchResult][5];
             $barcode = $worksheetArray[$searchResult][11];
             $event = $worksheetArray[$searchResult][5];
             $price = $worksheetArray[$searchResult][8];
             $event = ['participant' => [
                'name' => $name,
                'email' => $email,
                'price' => $price,
                'event_name' => $event,
                'tag_number' => $barcode,
             ]];
            //  dd($event['participant']);
             event(new GenerateTag($event));
            //  return view('view', [
            //     'participant_name' => $name,
            //     'participant_email' => $email,
            //     'participant_tag_number' => $barcode,
            //  ]);
         } else {
             // The value was not found in the array
             return "Value '$searchValue' not found in the array";
         }

    }
}
