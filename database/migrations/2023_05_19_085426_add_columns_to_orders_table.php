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
        Schema::table('orders', function (Blueprint $table) {
           $table->string('shipping_method')->after('order_date');
            $table->decimal('tax_sum', 10,2)->after('amount');
            $table->decimal('amount_without_tax', 10, 2)->after('tax_sum');
            $table->decimal('delivery_cost', 10, 2)->after('amount_without_tax');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->removeColumn('shipping_method');
            $table->removeColumn('tax_sum');
            $table->removeColumn('amount_without_tax');
            $table->removeColumn('delivery_cost');
        });
    }
};
