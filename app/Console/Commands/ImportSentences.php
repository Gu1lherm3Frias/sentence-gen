<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Sentence;
use League\Csv\Reader;
use App\Services\DateService;

#[Signature('app:import-sentences')]
#[Description('Command description')]
class ImportSentences extends Command
{
    
    public function handle()
    {      
        $path = Storage::path('imports/sentences.csv');
        $file = Reader::from($path)
            ->setHeaderOffset(0)
            ->setEscape('');
        
        $records = $file->getRecords(); 

        foreach ($records as $record) {
            Sentence::create([
                'date' => DateService::dayOfWeekToNumber($record["date"]),
                'content' => $record["content"],
                'author' => $record["author"]
            ]);
        }
    }
}
