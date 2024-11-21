<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddQuantityToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->integer('quantity')->default(0);  // Add the quantity column with a default value
    });

    // Set the value for all existing records (for example, setting quantity to 0 for all existing rows)
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('quantity');
    });
}

}
