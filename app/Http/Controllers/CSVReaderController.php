<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class CSVReaderController extends Controller
{
    public function readCsv($file) {
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);
        return $csv->getRecords();
    }


}
