<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
           $table->id();
            $table->string('title')->default('SajjEcoCraft'); // Title of the slider
            $table->string('description')->default('SajjEcoCraft'); // Description of the slider
            $table->string('tag')->default('SajjEcoCraft'); // Tag for the slider
            $table->string('cta_label')->default('SajjEcoCraft'); // Call-to-action button label
            $table->string('cta_url')->default('https://www.google.com'); // URL for the CTA button
            $table->string('image')->nullable(); // Path to the slider image (nullable)
            $table->integer('order')->unique(); // Order for the slider (for sorting)
            $table->string('status'); // Status to indicate if the slider is active or inactive
            $table->timestamps();
            $table->softDeletes(); // Soft delete column to allow for soft deletion of records
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
