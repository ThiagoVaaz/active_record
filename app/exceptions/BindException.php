<?php

namespace app\exceptions;

use Exception;

class BindException extends Exception
{
    public function __construct($message = "", $code = 0, $previous = null) {
        // Personalizar a mensagem
        $mensagemPersonalizada = "Esse índice nao existe dentro do bind: $message";
        
        // Chame o construtor da classe pai (PDOException)
        parent::__construct($mensagemPersonalizada, $code, $previous);
    }
}