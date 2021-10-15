<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Descripcion del Proyecto

Una aplicación web desarrollada para la comprá de distintos articulos que se podrán pagar por medio de Mercado Pago.
Los mismos podrán ser enviados a domicilio o retirados en el local del vendedor, el envio a domicilio tiene un costo dependiendo del lugar de envio, además de que el cliente podrá ver el estado de envío de sus articulos.

## Funcionalidades

La aplicación poseé :
- Home optimizado para la carga de articulos
- Sistema de autentiﬁcacion con Laravel Jetstream
- Manejo de Roles con Spatie/Laravel Permission
- SDK de Mercado Pago
- Panel de control con AdminLTE
- Envío de mails con PHPMailer
- Diseño Responsive implementado con Tailwind CSS y Bootstrap 5

## Roles

### Cliente

- Puede ver el estado en el que se encuentra su orden luego de haberla generado
- Método de envío
- Modiﬁcar su carrito de compras
- Agregar varios articulos a su carrito de compras 

### Vendedor

Tiene un panel de control en el cual podrá realizar las siguientes acciones:

- Crear, editar y eliminar sus articulos
- Cada vez que el vendedor actualice el estado de una orden, se le notiﬁcá al cliente por medio de un mail esta acción
- Administrar las ordenes que se encuentren en estado de Pago Recibido, Orden Enviada, Orden Entregada
- Generar un PDF o Excel con la informacion de sus articulos

### Administrador

Tiene un panel de control en el cual podrá realizar las siguientes acciones:

- Agregar o eliminar nuevas categorias para que los vendedores puedan asignarle a sus articulos
- Crear nuevos usuarios asignandoles un rol, esta acción notiﬁcará por medio de un mail los datos con los que se identiﬁcará en el sistema
- Habilitar o deshabilitar cuentas de usuarios (vendedores y clientes)

#### Las crendenciales para poder acceder a las cuentas de cada uno de los roles generados, se encuentran en UserSeeder.php

## Tecnologias

- Bases de Datos : phpMyAdmin - MySQL
- Laravel Collective para manejar algunos formularios
- DataTables
- Mails : PHPMailer
- Carrito de Compras : bumbummen99/shoppingcart
- Excel : Maatwebsite
- PDF : DomPDF
- Manejo de Roles con Spatie/Laravel Permission
- Componentes de Livewire
- Javascript : Alpine y jQuery
- CSS : Bootstrap 5 y Tailwind CSS
- PHP : Laravel 8


## Ejecución

Antes de ejecutar el proyecto, es necesario tener instalado Node.js y Docker ya que nos serán utiles para la utilizacion de los componentes de livewire y el uso del SDK de Mercado Pago

Tambien necesitamos iniciar las migraciones: 

#### php artisan migrate

Para luego poder rellenarlas con los factories y seeders, con el siguiente comando: 

#### php artisan migrate:fresh --seed

En caso de que quieramos probar la eliminacion de una orden cuando no se realiza el pago, esta funcionalidad esta automatizada (por ahora) con un cron de Laravel, la orden es eliminada luego de 10 minutos en caso de que no se realice el pago, con el siguiente comando activamos el cron.

#### php artisan schedule:work (solo funciona para localhost)

En el archivo .env_example estan algunas de las meta_keys necesarias para poder levantar la BD, hacer uso de las credenciales de Mercado Pago y para el envió de email, dichas meta_keys deben ser completadas por quien haga uso de este sistema.
