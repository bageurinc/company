<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bageur\Company\model\company as cp;

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
            $table->string('logo_path')->nullable();
            $table->string('favicon')->nullable();
            $table->string('favicon_path')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('nohp')->nullable();
            $table->string('wa')->nullable();
            $table->string('yt')->nullable();
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

            $cp                        = new cp;
            $cp->nama_perusahaan       = 'PT. BAGEUR SOLUSI INDONESIA';
            $cp->alamat                = 'Jl. Sirsak II, Kedung Waringin, Kec. Bojong Gede, Bogor, Jawa Barat 16710, BLOK CG No.3, Kedung Waringin, Kec. Bojong Gede, Bogor, Jawa Barat 16923';
            $cp->email                 = 'info@bageur.id';
            $cp->nohp                  = '0898-8551-395';
            $cp->wa                    = '0898-8551-395';
            $cp->fb                    = 'https://www.facebook.com/bageur.inc';
            $cp->ig                    = 'https://www.instagram.com/bageur.official/';
            $cp->save();

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
