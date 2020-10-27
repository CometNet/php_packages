<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUcenterTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('ucenter.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('ucenter.database.users_table'),function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('username', 190)->unique();
            $table->tinyInteger('stat')->nullable();
            $table->decimal('money')->nullable();
            $table->string('phone')->nullable();
        });

        /**
         * 充值明细
         */
        Schema::table('costs',function (Blueprint $table) {
            $table->id();
            $table->increments('user_id')->nullable();
            $table->string('name')->comment('充值名称');
            $table->tinyInteger('type')->nullable()->comment('1:支付宝,2:网银转账');
            $table->tinyInteger('stat')->nullable()->comment('0:未支付,1:已支付');
            $table->decimal('before_money')->nullable()->comment('充值前金额');
            $table->decimal('money')->nullable()->comment('充值金额');
            $table->string('description')->nullable()->comment('备注描述');
            $table->string('order_id')->nullable()->comment('订单号');
            $table->string('account')->nullable()->comment('充值账号');
            $table->timestamps();
        });

//        /**
//         * 消费明细
//         */
//        Schema::table('cost_consumer',function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->tinyInteger('type')->nullable();
//            $table->decimal('before_money')->nullable();
//            $table->decimal('money')->nullable();
//            $table->string('description')->nullable();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('ucenter.database.users_table'), function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('username', 190)->unique();
            $table->tinyInteger('stat')->nullable();
            $table->decimal('money')->nullable();
            $table->string('phone')->nullable();
        });
    }
}
