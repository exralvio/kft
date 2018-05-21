<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Media;
use App\Models\MediaFresh;

class MigrateFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move media to media fresh collection';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $medias = Media::orderBy('_id','asc')->get();

        ob_start();
        $i=0;
        /** Fill created_date field **/
        foreach ($medias as $media) {
            $update = Media::find($media['_id']);
            $created_date = $media->created_at->format('Y-m-d');
            $update->created_date = $created_date;
            $update->save();

            $i++;
            echo "Update created_date ".$i."\n";
            ob_flush();
        }

        $medias = Media::orderBy('_id','asc')->get();

        $i = 0;
        foreach ($medias as $media) {
            $insert = MediaFresh::insertFresh($media);
            if($insert){
                $i++;
                echo "Insert fresh ".$i."\n";
                ob_flush();
            }
        }

        echo "Success updated ".$i." media created_date!\n\n";

        dd("Success inserting ".$i." fresh medias");
    }
}
