<?php 
    
    //importacao dos arquivos(require)
    require "./bibliotecas/PHPMailer/Exception.php";
    require "./bibliotecas/PHPMailer/OAuth.php";
    require "./bibliotecas/PHPMailer/PHPMailer.php";
    require "./bibliotecas/PHPMailer/POP3.php";
    require "./bibliotecas/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;





    //print_r($_POST);
    
    class Mensagem {

      private $para = null;
      private $assunto = null;
      private $mensagem = null;

      public function __get($atributo) {
        return $this->$atributo;
      }

      public function __set($atributo, $valor) {
        $this->$atributo = $valor;
      }

      public function mensagemValida() {
        //validar os dados (verificar se formulario foi preenchido certo)
        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) { 
          return false;
        }
        //se todos estiverem preeechidas recebe true
        return true;

      }

    }

    //criar um variavel que vai receber uma instancia da class msg
    $mensagem = new Mensagem(); 

    //recuperar os dados que vem do metodo post(super global POST)
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);
    echo '<br>';

    print_r($mensagem);

    if (!$mensagem->mensagemValida()) {
      echo 'Mensagem não é válida';  //caso a msg não seja valida retorna false e entra no if
      die();  //mata processamento do script
    } 

    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug = 2;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com.';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'jm8661990@gmail.com';                     //SMTP username
      $mail->Password   = 'ueih gbop yhmy mtca';                               //SMTP password
      $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('jm8661990@gmail.com', 'web completo remetente');
      $mail->addAddress($mensagem->__get('para'));     //Add a recipient
             //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');
  
      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $mensagem->__get('assunto');
      $mail->Body    = $mensagem->__get('mensagem');
      $mail->AltBody = 'É necessário usar um client que suporte HTML para ter acesso total ao conteudo dessa mensagem';
  
      $mail->send();
      echo 'E-mail enviado com sucesso';
  } catch (Exception $e) {
      echo "Não foi possivel enviar esse e-mail!.Por favor tente novamente mais tarde!";
      echo " Detalhes do erro:" . $mail->ErrorInfo;
  }





?>