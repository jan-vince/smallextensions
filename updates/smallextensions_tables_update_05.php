<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables05 extends Migration
{
    public function up()
    {

        Schema::table('janvince_smallextensions_blogfields', function($table)
        {
            $table->integer('rainlab_user_id')->unsigned()->nullable();
        });

    }

    public function down()
    {
		Schema::table('janvince_smallextensions_blogfields', function($table)
        {
            $table->dropColumn('rainlab_user_id');
        });
    }
}
