<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Registra Excepción request TooLarge
     */
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
    //         \Log::warning('Solicitud demasiado grande: ' . $request->path());

    //         return redirect()->back()
    //             ->with('error', 'La solicitud es demasiado grande. Por favor, reduce el tamaño del archivo o contenido.');
    //     }

    //     $statusCode = $this->getStatusCode($exception);
    //     if (view()->exists("errors.{$statusCode}")) {
    //         return parent::render($request, $exception);
    //     }

    //     return response()->view('errors.fallback', ['code' => $statusCode], $statusCode);
    // }

    // protected function getStatusCode(Throwable $exception): int
    // {
    //     return method_exists($exception, 'getStatusCode')
    //         ? $exception->getStatusCode()
    //         : 500;
    // }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
            \Log::warning('Solicitud demasiado grande: ' . $request->path());

            return redirect()->back()
                ->with('error', 'La solicitud es demasiado grande. Por favor, reduce el tamaño del archivo o contenido.');
        }

        return parent::render($request, $exception);
    }

}
