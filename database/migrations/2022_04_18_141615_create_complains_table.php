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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complainer_id')->nullable();
            $table->foreignId('complain_sub_category_id');
            $table->foreignId('department_id')->nullable();
            $table->string('progress')->default("unresolved");
            $table->string('settlement_procedures')->nullable();
            $table->string('result_of_settlement')->nullable();
            $table->string('others')->nullable();
            $table->string('objective');
            $table->string('reference');
            $table->string('statement');
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
        Schema::dropIfExists('complains');
    }
};
