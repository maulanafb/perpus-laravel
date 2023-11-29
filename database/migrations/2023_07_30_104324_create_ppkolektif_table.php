<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppkolektif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_user');

            $table->string('jumlah');
            $table->date('tgl_pinjam');
            $table->boolean('status')->default(false);

            $table->foreign('id_buku')->references('id')->on('databukus')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('ppkolektif', function (Blueprint $table) {
            $table->dropColumn('status');
        });

    }
};