<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $empty = json_encode([]);
        Schema::create('characters', function (Blueprint $table) use ($empty) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('level')->default(1);
            $table->string('class');
            $table->string('class_extra')->nullable();
            $table->string('race');
            $table->string('race_extra')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->json('weapons')->default($empty);
            $table->json('armours')->default($empty);
            $table->integer('armour_class')->default(10);
            $table->json('abilities')->default($empty);
            $table->integer('proficiency_bonus')->default(2);
            $table->integer('speed')->default(0);
            $table->json('skills')->default($empty);
            $table->json('saving_throws')->default($empty);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
