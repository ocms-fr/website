<?php namespace SunLab\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSunlabNewsletterSubscribersCategories extends Migration
{
    public function up()
    {
        Schema::create('sunlab_newsletter_subscribers_categories', static function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('subscriber_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_newsletter_subscribers_categories');
    }
}
