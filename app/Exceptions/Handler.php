<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        //return parent::render($request, $exception);
        if($request->expectsJson()) {

            switch(true) {
                case $exception instanceof ModelNotFoundException:
                    return response()->json([
                        'error' => 'Record or model not found',
                    ], 404);
                    break;
                case $exception instanceof NotFoundHttpException:
                    return response()->json([
                        'error' => 'route not found',
                    ], 404);

                case $exception instanceof MethodNotAllowedHttpException:
                return response()->json([
                        'error' => 'method not allowed',
                    ], 404);
                    break;
                // default:
                //     return response()->json([
                //             'error' => $exception,
                //         ], 404);
                //     break;

            }
        }


        return parent::render($request, $exception);

        
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated user, try to login first.'], 401);

        }


        return parent::render($request, $exception);
    }
}
