<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables03 extends Migration
{
    public function up()
    {

        Schema::table('janvince_smallextensions_blogfields', function($table)
        {
            $table->string('featured_image_title')->nullable();
            $table->text('featured_image_alt')->nullable();
        });

    }

    public function down()
    {
		Schema::table('janvince_smallextensions_blogfields', function($table)
        {
            $table->dropColumn(['featured_image_title', 'featured_image_alt']);
        });
    }
}
