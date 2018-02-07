<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables02 extends Migration
{
    public function up()
    {

        Schema::table('janvince_smallextensions_blogfields', function($table)
        {
            $table->text('featured_image')->nullable();
        });

    }

    public function down()
    {
		Schema::table('janvince_smallextensions_blogfields', function($table)
        {
            $table->dropColumn('featured_image');
        });
    }
}
