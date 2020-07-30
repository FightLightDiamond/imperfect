<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->default('');
            $table->text('intro')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedInteger('section_id')->index()->nullable();
            $table->bigInteger('views')->default(0);
            $table->dateTime('last_view')->nullable();
            $table->dateTime('publish_time')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('no')->nullable();
            $table->string('feature_image')->nullable();
            $table->json('images')->nullable();
            $table->tinyInteger('status')->default(-1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
