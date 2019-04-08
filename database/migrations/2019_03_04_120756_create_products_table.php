<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('quote_ar')->nullable();
            $table->text('quote_en')->nullable();
            $table->text('author_ar')->nullable();
            $table->text('author_en')->nullable();
            $table->text('tags')->nullable();
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('admin_id')->default(0);
            $table->boolean('show')->default(0);
            $table->integer('like')->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
