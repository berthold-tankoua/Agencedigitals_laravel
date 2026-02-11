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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('about_img')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('title1')->nullable();
            $table->text('desc1')->nullable();

            $table->string('title2')->nullable();
            $table->text('desc2')->nullable();

            $table->string('title3')->nullable();
            $table->text('desc3')->nullable();

            $table->string('title4')->nullable();
            $table->text('desc4')->nullable();

            $table->string('title5')->nullable();
            $table->text('desc5')->nullable();

            $table->string('localisation');
            $table->string('google_map_link')->nullable();

            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('tiktok_link')->nullable();

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
        Schema::dropIfExists('abouts');
    }
};
