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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Sajj Eco Craft');
            $table->string('tag_line')->default('Hello World');
            $table->string('logo_light_image')->nullable();
            $table->string('logo_dark_image')->nullable();
            $table->string('favicon_image')->nullable();
            $table->string('phone_number')->default('(+91)-8347471711');
            $table->string('email_address')->default('info@sajjecocraft.com');
            $table->longText('address')->nullable();
            $table->longText('description')->nullable();
            $table->string('facebook')->default('#');
            $table->string('youtube')->default('#');
            $table->string('linkedin')->default('#');
            $table->string('instagram')->default('#');

            $table->string('meta_description')->default('SajjEcoCraft');
            $table->string('meta_keywords')->default('SajjEcoCraft');
            $table->string('meta_author')->default('SajjEcoCraft');
            $table->string('canonical_url')->default('SajjEcoCraft');
            $table->string('og_title')->default('SajjEcoCraft');
            $table->string('og_description')->default('SajjEcoCraft');
            $table->string('og_image')->default('SajjEcoCraft');
            $table->string('og_url')->default('SajjEcoCraft');
            $table->string('og_type')->default('SajjEcoCraft');
            $table->string('og_site_name')->default('SajjEcoCraft');
            $table->string('twitter_card')->default('SajjEcoCraft');
            $table->string('twitter_title')->default('SajjEcoCraft');
            $table->string('twitter_description')->default('SajjEcoCraft');
            $table->string('twitter_image')->default('SajjEcoCraft');
            $table->string('twitter_url')->default('SajjEcoCraft');
            $table->string('twitter_site')->default('SajjEcoCraft');
            $table->string('twitter_creator')->default('SajjEcoCraft');

            $table->string('latitude');
            $table->string('longitude');
            $table->string('map_link');

            $table->string('gst')->nullable()->default('SajJEcoCraft');
            $table->string('account_holder_name')->default('SajJEcoCraft');
            $table->string('bank_name')->default('SajJEcoCraft');
            $table->string('account_number')->default('SajJEcoCraft');
            $table->string('ifsc_code')->default('SajJEcoCraft');
            $table->string('bank_address')->default('SajJEcoCraft');
            $table->string('account_type')->default('SajJEcoCraft');
            $table->string('upi_id')->default('SajJEcoCraft');
            $table->string('upi_number')->default('SajJEcoCraft');
            $table->string('upi_qr_code_image')->default('SajJEcoCraft');
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
        Schema::dropIfExists('site_settings');
    }
};
