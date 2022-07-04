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
        Schema::create('materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->uuid('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('type_materials')->onDelete('cascade');

            $table->uuid('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->uuid('tag_id')->nullable();
            $table->foreign('tag_id')->references('id')->on('tag_models')->onDelete('cascade');

            $table->uuid('url_id')->nullable();
            $table->foreign('url_id')->references('id')->on('url_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
