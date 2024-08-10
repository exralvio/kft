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
        $created_i=0;
        /** Fill created_date field **/
        foreach ($medias as $media) {
            $update = Media::find($media['_id']);
            $created_date = $media->created_at->format('Y-m-d');
            $update->created_date = $created_date;
            $update->save();

            $created_i++;
            echo "Update created_date ".$created_i."\n";
            ob_flush();
        }

        $medias = Media::orderBy('_id','asc')->get();

        $fresh_i = 0;
        foreach ($medias as $media) {
            $insert = MediaFresh::insertFresh($media);
            if($insert){
                $fresh_i++;
                echo "Insert fresh ".$fresh_i."\n";
                ob_flush();
            }
        }

        echo "Success updated ".$created_i." media created_date!\n\n";
        ob_flush();

        dd("Success inserting ".$fresh_i." fresh medias");
    }
}
