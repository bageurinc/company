<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBgrCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bgr_company', function (Blueprint $table) {
            $table->longText('tentang_kami')->nullable();
            $table->longText('syarat_ketentuan')->nullable();
            $table->longText('kebijakan_privacy')->nullable();
            $table->string('web')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('link_map')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bgr_company', function (Blueprint $table) {
            $table->dropColumn('tentang_kami');
            $table->dropColumn('syarat_ketentuan');
            $table->dropColumn('kebijakan_privacy');
            $table->dropColumn('web');
            $table->dropColumn('jam_operasional');
            $table->dropColumn('link_map');
        });
    }
}
