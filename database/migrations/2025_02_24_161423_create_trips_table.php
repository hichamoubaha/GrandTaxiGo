<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Passenger ID
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null'); // Driver ID
            $table->string('pickup_location');
            $table->string('destination');
            $table->timestamp('pickup_date');
            $table->enum('status', ['pending', 'reserved', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
