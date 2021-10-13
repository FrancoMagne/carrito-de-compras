<?php

use App\Models\Articulo;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function quantity($articulo_id) {
    $articulo = Articulo::find($articulo_id);

    return $articulo->quantity;
}

function qtyAdded($articulo_id) {
    $cart = Cart::content();
    $item = $cart->where('id', $articulo_id)->first();

    if($item) {
        return $item->qty;
    } else {
        return 0;
    }
}

function qtyAvailable($articulo_id) {
    return quantity($articulo_id) - qtyAdded($articulo_id);
}

function discount($item) {
    $articulo = Articulo::find($item->id);
    $qtyAvailable = qtyAvailable($articulo->id);

    $articulo->quantity = $qtyAvailable;
    $articulo->save();
}

function increase($item) {
    $articulo = Articulo::find($item->id);
    $quantity = quantity($articulo->id) + $item->qty;

    $articulo->quantity = $quantity;
    $articulo->save();
}

/* Funciones para Email */

function emailRegister(User $user, $password = '', $flag = false) {

    if(!$flag) {
        // Si el usuario se dio de alta desde el Registro
        if($user->rol == 'cliente') {
            $subject = 'Bienvenido Cliente '.$user->name;
            $body = 'Ya tienes tu cuenta en nuestra pagina <a href="http://web.test">web.test</a>, ahora puedes comprar nuestros articulos disponibles y ver el progreso de entrega de los mismos';
        } else {
            $subject = 'Bienvenido Vendedor '.$user->name;
            $body = 'Ahora puedes cargar tus articulos y comenzar a venderlos por <a href="http://web.test">web.test</a>';
        }
    } else {
        // Si el admin da de alta
        $subject = 'Bienvenido '.$user->rol.' '.$user->name;
        $body = 'Ya eres un '.$user->rol.' de nuestra página, estas serán tus credenciales:<br>';
        $body .= ' <br> - Email: '.$user->email;
        $body .= ' <br> - Password: '.$password;
        $body .= '<br><br> Puedes verificar las mismas en <a href="http://web.test">web.test</a>';
    }

    phpmailer($user->email, $subject, $body);
}

function emailOrderStatus(Order $order) {

    $user = User::find($order->user_id);
    $status = getStatus($order);
    $subject = 'Notificación de Estado de su Orden #'.$order->id;
    $body = 'Le notificamos que su orden se encuentra en estado '.$status;
    if($status == 'Anulado') {
        $body .= ' debido a que pasó un periodo de 10 minutos que no abonó con su cuenta de Mercado Pago.';
        $body .= '<br>Disculpé las molestias';
    }

    phpmailer($user->email, $subject, $body);
}

function getStatus(Order $order) {
    switch($order->status) {
        case 1: return 'Pendiente'; 
        case 2: return 'Pago Recibido';
        case 3: return 'Enviado';
        case 4: return 'Entregado';
        default: return 'Anulado';
    }
}

function phpmailer($user_email, $subject, $body) {
    
    require base_path('/vendor/autoload.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = env('MAIL_HOST');                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = env('MAIL_USERNAME');                     //SMTP username
        $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = env('MAIL_PORT');                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
        $mail->addAddress($user_email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->CharSet = 'UTF-8';

        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}