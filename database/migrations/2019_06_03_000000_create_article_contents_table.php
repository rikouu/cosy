<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id');
            $table->text('markdown')->nullable();
            $table->text('html')->nullable();
            $table->boolean('is_html')->default(false);
            $table->string('title');
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('source')->nullable();
            $table->string('image')->nullable();
            $table->text('scripts')->nullable();
            $table->text('styles')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('article_contents');
    }
}
