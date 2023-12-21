<?php 
    
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

      public function validaMensagem() {
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
    //print_r($mensagem);

    if ($mensagem->validaMensagem()) {
      echo 'Mensagem é válida';  //tudo foi preenchido corretamente no formulario
    } else {
      echo 'Mensagem invalida';   //formulario não foi preenchido corretamente
    }





?>