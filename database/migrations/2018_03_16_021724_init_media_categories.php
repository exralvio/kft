<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\MediaCategory;

class InitMediaCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            'Abstract',
            'Macro',
            'Aerial',
            'Nature',
            'Animals',
            'Night',
            'Black and White',
            'People',
            'Celebrities',
            'Performing Arts',
            'City & Architecture',
            'Sport',
            'Comercial',
            'Still Life',
            'Street',
            'Family',
            'Transportation',
            'Fashion',
            'Travel',
            'Underwater',
            'Fine Art',
            'Urban Exploration',
            'Food',
            'Wedding',
            'Journalism',
            'Landscapes'
        ];

        foreach ($categories as $category) {
            $media_category = new MediaCategory;
            $media_category->name = $category;
            $media_category->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::collection('media_categories')->raw(function($collection){
            $collection->drop();
        });
    }
}
