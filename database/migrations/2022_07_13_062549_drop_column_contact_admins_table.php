<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnContactAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('admins', 'contact'))
        {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('contact');
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('admins', 'contact'))
        {
            Schema::table('admins', function (Blueprint $table) {
                $table->string('contact');
            });
        }
    }
}
