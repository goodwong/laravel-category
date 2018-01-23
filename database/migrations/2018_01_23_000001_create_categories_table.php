<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 32)->nullable();
            $table->string('vocabulary', 32)->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name', 32);
            $table->integer('position')->default(0);
            $table->string('status', 32)->nullable();
            $table->jsonb('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')
                  ->references('id')->on('categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
        });

        Schema::dropIfExists('categories');
    }
}
