<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables07 extends Migration
{
    public function up()
    {
        Schema::create('janvince_smallextensions_blogcategoriesfields', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('janvince_smallextensions_blogcategoriesfields');
    }
}
