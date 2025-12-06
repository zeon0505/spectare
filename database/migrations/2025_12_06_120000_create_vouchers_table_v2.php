<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Force drop if exists to ensure clean state
        Schema::dropIfExists('vouchers');

        Schema::create('vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent']);
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();
            $table->decimal('min_purchase', 12, 2)->default(0);
            $table->decimal('max_discount', 12, 2)->nullable();
            $table->integer('quota')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Add columns to bookings if not exists
        if (!Schema::hasColumn('bookings', 'voucher_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->uuid('voucher_id')->nullable();
                $table->decimal('discount_amount', 12, 2)->default(0);
            });
        }

        // Add columns to snack_orders if not exists
        if (!Schema::hasColumn('snack_orders', 'voucher_id')) {
            Schema::table('snack_orders', function (Blueprint $table) {
                $table->uuid('voucher_id')->nullable();
                $table->decimal('discount_amount', 12, 2)->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
        
        if (Schema::hasColumn('bookings', 'voucher_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropColumn(['voucher_id', 'discount_amount']);
            });
        }

        if (Schema::hasColumn('snack_orders', 'voucher_id')) {
            Schema::table('snack_orders', function (Blueprint $table) {
                $table->dropColumn(['voucher_id', 'discount_amount']);
            });
        }
    }
};
