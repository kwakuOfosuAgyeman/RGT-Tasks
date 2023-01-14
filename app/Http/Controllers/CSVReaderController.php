<?php

namespace App\Http\Controllers;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PhpOffice\PhpSpreadsheet\IOFactory;
use League\Csv\Writer;

use Illuminate\Http\Request;

class CSVReaderController extends Controller
{
      public function readCsv($name){
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
             // The value was found in the array
             $row = $searchResult + 1;

             $name = $worksheetArray[$searchResult][3];
             $email = $worksheetArray[$searchResult][4];
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
            $participant = $event['participant'];
            // $n = new GenerateTag;
            $csv = Writer::createFromFileObject(new \SplTempFileObject());
            // dd($csv);
            $csv->insertOne([
                'Name' => $participant['name'],
                'Email' => $participant['email'],
                'Price' => $participant['price'],
                'Event' => $participant['event_name'],
                'Tag Number' => $participant['tag_number'],
            ]);

            $csv->output($participant['event_name'] . 'participants.csv');
         } else {
             // The value was not found in the array
             return "Value '$name' not found in the sheet";
         }

    }


}
