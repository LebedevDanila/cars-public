<?php

namespace App\Libs\Response;

class Throwable
{

    public static function response(callable $callable)
    {
        try {
            return $callable();
        } catch (\Throwable $e) {
            $message = in_array(env('APP_ENV'), ['local', 'dev'])
                ? implode(PHP_EOL, [$e->getMessage(), $e->getTraceAsString()])
                : $e->getMessage()
            ;

            return new Error($message);
        }

    }

}
