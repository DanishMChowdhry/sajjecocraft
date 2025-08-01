<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('parking_charges')->nullable();
            $table->string('operational_charges')->nullable();
            $table->string('transport')->nullable();
            $table->string('dead_stock')->nullable();
            $table->string('branding')->nullable();
            $table->string('damage_and_shrinkege')->nullable(); // Consider correcting spelling: "shrinkage"
            $table->string('profit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn([
                'parking_charges',
                'operational_charges',
                'transport',
                'dead_stock',
                'branding',
                'damage_and_shrinkege',
                'profit',
            ]);
        });
    }
};
