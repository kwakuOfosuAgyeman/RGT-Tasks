<?php

namespace App\Listeners;

use App\Events\EventSignup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    public function handle(EventSignup $event)
    {
        $participant = $event['participant'];

        // Write participant's information to a CSV file
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne([
            'Name' => $participant['name'],
            'Email' => $participant['email'],
            'Price' => $participant['price'],
            'Event' => $participant['event_name'],
            'Tag Number' => $participant['tag_number'],
        ]);
        $csv->output($participant['event_name'] . '-participants.csv');

        // dd($csv);
        // Generate a PDF tag for the participant
        $pdf = PDF::loadView('participant_tag', ['participant' => $participant]);
        $pdf->save(storage_path('app/public/' . $participant['event_name'] . '-tags/' . $participant['tag_number'] . '.pdf'));
    }
}
