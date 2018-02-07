<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables04 extends Migration
{
    public function up()
    {

        Schema::create('janvince_smallextensions_adminfields', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('backend_user_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique('backend_user_id');

        });

    }

    public function down()
    {
        Schema::dropIfExists('janvince_smallextensions_adminfields');
    }
}
