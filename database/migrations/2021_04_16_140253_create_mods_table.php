<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('principal_image')->nullable();
            $table->json('images')->nullable();
            $table->boolean('approved')->nullable();
            $table->json('tags')->nullable();
            $table->text('link')->nullable();
            $table->integer('category_game')->nullable();
            $table->integer('category')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('total_likes')->nullable();
            $table->float('total_stars')->nullable();
            $table->integer('total_users_stars')->nullable();
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
        Schema::dropIfExists('mods');
    }
}
