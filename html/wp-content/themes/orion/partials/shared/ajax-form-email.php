<?php 
use Inc\Email\Email;
use Inc\Contacto\Formulario;
define('WP_USE_THEMES', false);  
require_once('../../../../../wp-load.php');
$inp = file_get_contents('php://input');
$data = json_decode($inp);
$email = new Email();
$formulario = new Formulario();
$data = $data->data;
$token = $data->token;
// recatchav3
if(get_field('recatchpa','option') && ($_SERVER["SERVER_NAME"]) != "localhost"){


    // if (($_SERVER["SERVER_NAME"]) == "dekaz.pro"){
    //     $tokenserver = "6LecWsUUAAAAADxN-sZtP7QVTKUtfxvkV-nO07hq";
    // } else {
        $tokenserver = get_field('recatchpa_servidor','option');
    // }
    
    $validation = $formulario->recatchpa3($tokenserver, $token);
    }  else {$validation = true;}


$to = get_field('email_admin','option');
$subject = get_field('asunto_admin','option').' '.get_field('num_formularios','option').' '.$data->email;


if($validation){
// obtiene el email de la carpeta email
// formContact es el email normal
$emailhtml = $email->emailhtml($data);

//enviaemail admin
$exitoadmin = wp_mail( $to, $subject, $emailhtml);


//guarda en la base de datos lo enviado
$content = $email->createcontent($data);
$email->saveDatabaseEmail($data->name,$data->email,$data->cellphone,$data->id,$content);
$datos = [$data, $exitoadmin];
echo json_encode($datos);}
else {
    $datos = [$validation, 0];
    echo json_encode($datos);
}
?>