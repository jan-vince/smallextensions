<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables06 extends Migration
{
    public function up()
    {
        if (Schema::hasTable('rainlab_blog_posts')) 
        {
            if (!Schema::hasColumn('rainlab_blog_posts', 'custom_repeater')) 
            {
                Schema::table('rainlab_blog_posts', function($table)
                {
                    $table->text('custom_repeater')->nullable();
                });
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('rainlab_blog_posts')) 
        {
            if (Schema::hasColumn('rainlab_blog_posts', 'custom_repeater')) 
            {
                Schema::table('rainlab_blog_posts', function($table)
                {
                    $table->dropColumn('custom_repeater');
                });
            }
        }
    }
}
