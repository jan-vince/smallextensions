<?php

namespace JanVince\SmallExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SmallExtensionsTables08 extends Migration
{
    public function up()
    {

        if (Schema::hasTable('janvince_smallextensions_blogcategoriesfields')) 
        {
            Schema::table('janvince_smallextensions_blogcategoriesfields', function($table)
            {
                $table->text('meta_title')->nullable();
                $table->text('meta_description')->nullable();
            });
        }

    }

    public function down()
    {
        if (Schema::hasTable('janvince_smallextensions_blogcategoriesfields')) 
        {
            if (Schema::hasColumn('janvince_smallextensions_blogcategoriesfields', 'meta_title')) 
            {
                Schema::table('janvince_smallextensions_blogcategoriesfields', function($table)
                {
                    $table->dropColumn('meta_title');
                });
            }

            if (Schema::hasColumn('janvince_smallextensions_blogcategoriesfields', 'meta_description')) 
            {
                Schema::table('janvince_smallextensions_blogcategoriesfields', function($table)
                {
                    $table->dropColumn('meta_description');
                });
            }
        }
    }
}
