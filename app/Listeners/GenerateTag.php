<?php

namespace App\Listeners;

// use App\Events\EventSignup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use League\Csv\Writer;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class GenerateTag
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventSignup  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($csv);
        $participant = $event['participant'];
        // dd($participant);

        // Write participant's information to a CSV file
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        // dd($csv);
        $csv->insertOne([
            'Name' => $participant['name'],
            'Email' => $participant['email'],
            'Price' => $participant['price'],
            'Event' => $participant['event_name'],
            'Tag Number' => $participant['tag_number'],
        ]);
        // dd((string) $csv);
        // $csv->save('path/to/save/my-file.csv');
        $csv->output($participant['event_name'] . 'participants.csv');


        // dd($csv);
        // Generate a PDF tag for the participant
        $pdf = PDF::loadView('myview');


        $pdf->save(storage_path('app/public/' . $participant['event_name'] . '-tags/' . $participant['tag_number'] . '.pdf'));
        // $pdf->download();
        return $pdf->stream();
    }
}
