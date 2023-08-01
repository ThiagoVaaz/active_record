<?php

namespace app\exceptions;

use PDOException;

class ConnectionException extends PDOException
{
    public function __construct($message = "", $code = 0, $previous = null) {
        // Personalizar a mensagem
        $mensagemPersonalizada = "Ocorreu um erro na Conexão do banco de dados: $message";
        
        // Chame o construtor da classe pai (PDOException)
        parent::__construct($mensagemPersonalizada, $code, $previous);
    }
}