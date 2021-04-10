<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedInteger('nisn')->unique();
            $table->enum('jenis_kelamin', ['p', 'l']);
            $table->string('kelas');
            $table->string('alamat');
            $table->string('penghasilan_ortu');
            $table->enum('penerima_kks', ['punya', 'tidak punya']);
            $table->string('r_mtk');
            $table->string('r_bindo');
            $table->string('r_bing');
            $table->string('r_mapel_produktif');
            $table->string('beasiswa')->nullable();
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
        Schema::dropIfExists('students');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('nilais');
        Schema::dropIfExists('values');
    }
}
