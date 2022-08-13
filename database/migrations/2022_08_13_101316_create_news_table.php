<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->json('images')->nullable();
            $table->enum('status', ['deleted', 'published', 'draft']);
            $table->bigInteger('topic_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('news', function (Blueprint $table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('CASCADE');
            $table->dropForeign('news_topic_id_foreign');
        });
    }
};
