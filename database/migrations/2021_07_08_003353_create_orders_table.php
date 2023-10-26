<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            //$table->unsignedBigInteger('articulo_id');

            $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('articulo_id')->references('id')->on('articulos');


            $table->text('contact');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->text('reference')->nullable();
            $table->enum('status', [Order::PENDIENTE, Order::RECIBIDO, Order::ENVIADO, Order::ENTREGADO, Order::ANULADO])->default(Order::PENDIENTE);
            $table->enum('shipping_type', [1, 2]); // 1 - Retira en Local, 2 - Envio Domicilio
            $table->float('shipping_cost');
            $table->float('total');
            //$table->json('content')->nullable();
            $table->text('content')->nullable();

            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('departament_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('departament_id')->references('id')->on('departaments');

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
        Schema::dropIfExists('orders');
    }
}
