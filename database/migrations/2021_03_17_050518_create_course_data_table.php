<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_data', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->index();
            $table->string('property')->index();
            $table->text('property_value')->nullable();
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['course_id', 'property']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_data');
    }
}
