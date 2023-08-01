<?php

namespace app\exceptions;
use PDOException;

class QueryException extends PDOException
{

    public function __construct($message = "", $code = 0, $previous = null)
    {
        // Personalizar a mensagem
        $mensagemPersonalizada = "Ocorreu um erro na Execução da Query: $message";

        // Chame o construtor da classe pai (PDOException)
        parent::__construct($mensagemPersonalizada, $code, $previous);
    }
}
