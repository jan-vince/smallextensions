<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables extends Migration
{
    public function up()
    {

        Schema::create('janvince_smallextensions_blogfields', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_id')->unsigned()->index()->nullable();
            $table->string('api_code')->nullable();
            $table->string('string')->nullable();
            $table->text('text')->nullable();
            $table->boolean('switch')->nullable();
            $table->datetime('datetime')->nullable();
            $table->text('repeater')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('janvince_smallextensions_blogfields');
    }
}
