<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyOnTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //creo la colonna category_id
            $table->unsignedBigInteger('category_id')->after('id')->nullable();

            //definisco la foreign key - onDelete() mi risolve il problema di non cancellare i post di una categoria in caso di cancellazione della categoria stessa
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //elimino prima la foreign key
            $table->dropForeign('posts_category_id_foreign');
            //dopo la colonna 
            $table->dropColumn('category_id');
        });
    }
}
