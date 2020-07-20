<?php namespace SunLab\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSunlabNewsletterSubscribers extends Migration
{
    public function up()
    {
        Schema::create('sunlab_newsletter_subscribers', static function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email', 255);
            $table->tinyInteger('frequency')->unsigned()->default(3);
            $table->timestamps();
            $table->timestamp('last_sended_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_newsletter_subscribers');
    }
}
