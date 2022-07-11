<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            // documentazione Laravel migration/foreigh_key_constrain
            // nella tabella posts creo la colonna della foreign key
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //assegno la foreign key alla colonna appena creata
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

            // elimino la foreign key
            $table->dropForeign(['category_id']);

            // elimino la colonna della foreign key
            $table->dropColumn('category_id');
        });
    }
}
