<?php 
namespace Inc\Email;
use SendGrid;
use Exception;
use PHPMailer;
use SendGrid\Mail\Mail;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//https://andres-dev.com/enviar-correos-usando-wp-mail-wordpress/
class Email{
    public function __construct() 
    {
        add_action('phpmailer_init', array($this, 'smtp_config'));
        add_filter('wp_mail_content_type', array($this, 'email_content_type'));
    }

    public function email_content_type()
    {
        return 'text/html';
    }

    private function addformnumber(){
        update_field('num_formularios', (intval(get_field('num_formularios','option')) + 1 ), 'option');
    }

    public function emailhtml($data){
        if($data->id === 'formContact'){
            $emailhtml = file_get_contents(get_template_directory_uri().'/emails/adminbase.html');
            $searchTerms = array ('{{name}}','{{email}}','{{phone}}','{{subject}}','{{website}}','{{company}}');
            $replacements = array ($data->name, $data->email,$data->cellphone ,$data->message, home_url(), get_field('empresa','option'));
            $emailhtml = str_replace( $searchTerms, $replacements, $emailhtml );
            
        }
        return $emailhtml;

    }


    public function createcontent($data){
        $content = '<table style="border: 1px #ecedeesolid;">';
        foreach ($data as $key => $value) {
            if($key != 'token')  {
                $content .= '<tr>';
                    $content .= '<td style="border: 1px #ecedee solid; padding: 10px 50px; margin: 0px;">'.$key.'</td>';
                    $content .= '<td style="border: 1px #ecedee solid; padding: 10px 50px; margin: 0px;"><strong>'.$value.'</strong></td>';        
                $content .= '</tr>';
            }       
        }
        $content .= '</table>';
        $this->addformnumber();
        return $content;
    }


    public function saveDatabaseEmail($name, $email, $phone, $type, $data){
        $post_data = array(
            'post_title'    => $name.' '.$email,
            'post_status'   => 'publish',
            'post_type'     => 'clientes',
        );
        $id = wp_insert_post( $post_data );
        wp_set_object_terms( $id, $name, 'cliente_nombre', false );
        wp_set_object_terms( $id, $email, 'cliente_email', false );
        wp_set_object_terms( $id, $phone, 'cliente_phone', false );
        wp_set_object_terms( $id, $type, 'cliente_tipo', false );
        update_field('asunto', $data, $id);
        return $id;
    }

    private function sendgridLocal(String $to, String $subject, String $plain, String $html) {
        
        
        $email = new Mail();
        // $email->setFrom("funerariasycremaciones@gmail.com", "funerariasycremaciones");
        $email->setFrom($_ENV['SENDGRID_FROM_EMAIL'], $_ENV['SENDGRID_FROM_NAME']);
        // $email->setSubject("Sending with SendGrid is Fun");
        $email->setSubject($subject);
        // $email->addTo("patote.gonzalez@gmail.com", "Pato");
        $email->addTo($to);
        // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent("text/plain", $plain);
        // $email->addContent(
        // "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        // );
        $email->addContent("text/html", $html);
        $sendgrid = new SendGrid($_ENV['SENDGRID_KEY']);
        try {

        $response = $sendgrid->send($email);

        return array(
            'success' => $response->statusCode() === 202 ? true : false,
            'res' => $response
        );
        } catch (Exception $e) {
            return array(
                'success' => false,
                'res' => $e,
                'error' => $e
            );
        // echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }


    private function swiftMailerLocal(
                String $to, 
                String $subject, 
                String $plain, 
                String $html){
        $transport = (new Swift_SmtpTransport($_ENV['SWIFTMAILER_SMTP'], $_ENV['SWIFTMAILER_PORT'], 'ssl'))
            ->setUsername($_ENV['SWIFTMAILER_USER'])
            ->setPassword($_ENV['SWIFTMAILER_PASS']);

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message($subject))
            ->setFrom([$_ENV['SWIFTMAILER_FROM_EMAIL'] => $_ENV['SWIFTMAILER_FROM_NAME']])
            ->setTo($to)
            // ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
            ->setBody($html, 'text/html')
            ->addPart($plain, 'text/plain');
            
        // Send the message
        $result = $mailer->send($message);
        return array(
            'success' => $result === 1 ? true : false
        );
    }

    public function sendEmail(String $to, String $subject, String $plain, String $html){
        // $email = new Email();
        //     $res = $email->sendEmail(
        //         "funerariasycremaciones@gmail.com", 
        //         "funerariasycremaciones",
        //         "patote.gonzalez@gmail.com",
        //         "asunto de prueba",
        //         "email plano",
        //         "<h2>email en html</h2>"
        //     );
        
        // return $this->sendgridLocal($to, $subject, $plain, $html );
        return $this->swiftMailerLocal($to, $subject, $plain, $html );
    }


}
?>