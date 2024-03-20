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
        // Schema::table('messages', function (Blueprint $table) {
        //     $table->unsignedBigInteger('message_room_id')->after('id'); // idカラムの後に追加
        //     $table->foreign('message_room_id')->references('id')->on('message_rooms')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
        $table->dropForeign(['message_room_id']); // カラム名のみを指定
        $table->dropColumn('message_room_id');
        });
    }
};
