<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

class InitSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = [
            [
                'label'=>'popular_like_threshold',
                'value'=>10
            ],
            [
                'label'=>'popular_duedate',
                'value'=>7
            ],
            [
                'label'=>'enable_post_pending',
                'value'=>0
            ],
            [
                'label'=>'publish_acc_threshold',
                'value'=>2
            ]
        ];

        foreach ($settings as $setting) {
            $setting_m = new Setting;
            $setting_m->label = $setting['label'];
            $setting_m->value = $setting['value'];
            $setting_m->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::collection('settings')->raw(function($collection){
            $collection->drop();
        });
    }
}
