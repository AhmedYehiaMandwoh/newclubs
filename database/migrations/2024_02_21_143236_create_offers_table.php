<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\IsActiveEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('discount_type')->index();
            $table->double('discount_percent')->default(0);

            $table->double('show_percent')->nullable();
            $table->string('can_use_type')->nullable()->index();
            $table->date('can_use_from_date')->nullable();

            $table->string('valid_to_type')->nullable();
            $table->date('valid_to_date')->nullable();

            $table->integer('max_used')->nullable();
            $table->integer('count_used')->default(0);
            $table->nullableMorphs('created_by');
            $table->nullableMorphs('updated_by');
            $table->nullableMorphs('deleted_by');
            $table->softDeletes();
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
        Schema::dropIfExists('offers');
    }
};
