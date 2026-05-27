<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use League\CSV\Reader;

#[Signature('app:import-sentences')]
#[Description('Command description')]
class ImportSentences extends Command
{
    
    public function handle()
    {
        $file = Reade::from("")
            ->setHeaderOffset(0)
            ->setEscape('');
        
        $records = $file->getRecords(); 

        foreach ($records as $record) {
            Sentence::create([
                'date' => $record["date"],
                'content' => $record["content"],
                'author' => $record["author"]
            ]);
        }
    }
}
