<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('factories', function($table) {
            $table->dropColumn('icon');
        });
    }

    public function down()
    {
        Schema::table('factories', function($table) {
            $table->string('icon');
        });
    }
};
