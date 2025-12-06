<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class FixVouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Fixing Vouchers table...');

        Schema::disableForeignKeyConstraints();

        $this->command->info('Dropping existing vouchers table if any...');
        Schema::dropIfExists('vouchers');

        $this->command->info('Creating vouchers table...');
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

        $this->command->info('Updating bookings table...');
        if (!Schema::hasColumn('bookings', 'voucher_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->uuid('voucher_id')->nullable();
                $table->decimal('discount_amount', 12, 2)->default(0);
            });
        }

        $this->command->info('Updating snack_orders table...');
        if (!Schema::hasColumn('snack_orders', 'voucher_id')) {
            Schema::table('snack_orders', function (Blueprint $table) {
                $table->uuid('voucher_id')->nullable();
                $table->decimal('discount_amount', 12, 2)->default(0);
            });
        }

        Schema::enableForeignKeyConstraints();
        $this->command->info('Database fixed successfully!');
    }
}
