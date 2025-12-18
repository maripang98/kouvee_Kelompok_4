<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('layanan', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('pegawai', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('hewan', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('customer', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('layanan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('hewan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('customer', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

