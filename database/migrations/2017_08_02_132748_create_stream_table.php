<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateStreamTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('stream', function (Blueprint $table) {
        $table->increments('id')->unsigned();
        $table->integer('user_id');
        $table->string('performer');
        $table->string('track_name');
        $table->string('body');
        $table->integer('category_id');
        $table->string('img');
        $table->string('url');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('deleted_at')->nullable();
      });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::dropIfExists('stream');
    }
}