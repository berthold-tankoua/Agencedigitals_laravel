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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();

            $table->string('blog_img')->nullable();
            $table->string('tags');
            $table->integer('views')->nullable();

            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();

            $table->string('author')->nullable();
            $table->text('author_note')->nullable();

            $table->string('others')->nullable();
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
        Schema::dropIfExists('blogs');
    }
};
