<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_company', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('nohp')->nullable();
            $table->string('wa')->nullable();
            $table->string('fb')->nullable();
            $table->string('in')->nullable();
            $table->string('ig')->nullable();
            $table->string('tw')->nullable();
            $table->json('etc')->nullable();
            $table->timestamps();
        }); 

        Schema::create('bgr_bank', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('judul');
            $table->string('nama_bank');
            $table->string('kcp');
            $table->string('an');
            $table->string('no');
            $table->string('curr')->default('IDR');
            $table->boolean('utama')->default(false);
            $table->timestamps();
        }); 

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgr_company');
        Schema::dropIfExists('bgr_bank');
    }
}
