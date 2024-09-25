<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
       //
    }
     /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Check if the application is in debug mode
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        // Return the custom error page for all errors
        return response()->view('error.error', [
            'exception' => $exception,
            'statusCode' => $this->getStatusCode($exception)
        ], $this->getStatusCode($exception));
    }

    /**
     * Get the HTTP status code based on the exception.
     *
     * @param  \Throwable  $exception
     * @return int
     */
    protected function getStatusCode(Throwable $exception)
    {
        return method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
    }
    
}
