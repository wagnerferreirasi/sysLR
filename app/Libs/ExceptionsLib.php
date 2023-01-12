<?php
namespace App\Libs;

use Exception;

class ExceptionsLib extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    //routes exceptions
    public static function routeCreated()
    {
        return new self('Rota criada com sucesso!');
    }

    public static function routeUpdated()
    {
        return new self('Rota atualizada com sucesso!');
    }

    public static function routeNotFound()
    {
        return new self('Rota não encontrada!');
    }

    public static function routeInUse()
    {
        return new self('Esta rota está sendo usada em um pacote, não é possível excluí-la!');
    }

    public static function routeExcluded()
    {
        return new self('Rota excluída com sucesso!');
    }
}
