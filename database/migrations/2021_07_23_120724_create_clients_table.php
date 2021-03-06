<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name', 100)->unique();
            $table->text('address1');
            $table->text('address2');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('phone_no1', 100)->unique();
            $table->string('phone_no2', 100)->nullable()->unique();
            $table->string('zip', 100);
            $table->date('start_validity');
            $table->date('end_validity');
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
