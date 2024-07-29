<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreIdToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id')->nullable();

            // Thêm foreign key
            $table->foreign('store_id')
                  ->references('id')->on('stores')
                  ->onDelete('cascade'); // Xoá các dòng liên quan khi store bị xoá
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Xoá foreign key trước khi xoá cột
            $table->dropForeign(['store_id']);

            // Xoá cột nếu tồn tại
            $table->dropColumn('store_id');
        });
    }
}
