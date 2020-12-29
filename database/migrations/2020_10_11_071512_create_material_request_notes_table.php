<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRequestNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_request_notes', function (Blueprint $table) {
            $table->id();
            $table->date('note_date');
            $table->unsignedBigInteger('site_id');
            $table->boolean('is_urgent');
            $table->boolean('is_complete')->default(false);
            $table->string('is_approved')->default("Pending");
            $table->date('delivery_date');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('material_request_notes');
    }
}
