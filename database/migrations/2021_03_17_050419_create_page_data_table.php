<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_data', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->index();
            $table->string('property')->index();
            $table->text('property_value')->nullable();
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['page_id', 'property']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_data');
    }
}
