<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_sponsors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(1)->comment('0=inactive, 1= active');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('our_sponsors');
    }
}
