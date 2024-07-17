<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Số điện thoại
            $table->string('phone')->nullable();
            
            // Địa chỉ
            $table->string('address')->nullable();

            // Giới tính
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Ngày tháng năm sinh
            $table->date('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('gender');
            $table->dropColumn('dob');
        });
    }
}
