<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToLaracmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laracms_pages', function (Blueprint $table) {
            $table->boolean('in_top_nav')->after('id')->default(false);
            $table->boolean('in_footer')->after('id')->default(false);
            $table->boolean('auth_only')->after('id')->default(false);
            $table->string('key')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laracms_pages', function (Blueprint $table) {
            $table->dropColumn('in_top_nav');
            $table->dropColumn('in_footer');
            $table->dropColumn('auth_only');
            $table->dropColumn('key');
        });
    }
}
