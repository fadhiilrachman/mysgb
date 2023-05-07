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
        Schema::create('sharing', function (Blueprint $table) {
            $table->id();
            $table->uuid('sharing_id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->longText('body');
            $table->jsonb('labels');
            $table->enum('view_mode', ['public', 'private', 'secret', 'club', 'inner'])->default('public');
            $table->boolean('listing_mode')->default(true);
            $table->string('secret_code')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->enum('status', ['published', 'archived', 'draft', 'blocked'])->default('published');
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
        Schema::dropIfExists('sharing');
    }
};
