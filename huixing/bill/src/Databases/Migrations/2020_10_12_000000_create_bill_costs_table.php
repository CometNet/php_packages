<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 创建资费表
 * Class CreateBillCostsTable
 */
class CreateBillCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_costs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("资费名称");
            $table->string('descry')->comment("资费描述");
            $table->tinyInteger('cost_type')->comment("资费类别 1:包年 2:包月 3：套餐 4：计时 5: 按次");
            $table->integer('base_duration')->comment("包时长（小时)");
            $table->integer('unit_cost')->comment('基费（元）相应包月的基本计费，含基本费用');
            $table->integer('state')->comment('资费状态');
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
        Schema::dropIfExists('users');
    }
}
