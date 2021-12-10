<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthorizationException;
use Illuminate\Database\QueryException;
use App\Http\Traits\ApiResponse;
use Throwable;


class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    $errors=$e->validator->errors()->getMessages();
                    return $this->failure('The given data was invalid.',$errors,$e->status);
                }
                if ($e instanceof NotFoundHttpException ) {
                    return $this->failure('Page not found.',$e,$e->getStatusCode());
                }
                if($e instanceof  AuthorizationException ){
                    return  $this->failure('unauthorized.',$e,403);
                }
                if($e instanceof  MethodNotAllowedHttpException){
                    return  $this->failure('this method is not supported for this route',$e->getMessage(),405);
                }
                if($e instanceof HttpException){
                    return  $this->failure('error happend',$e->getMessage(),$e->getStatusCode());
                }
                if($e instanceof QueryException){
                    $code= $e->errorInfo[1];
                    if ($code == 1451) {
                        return  $this->failure('cannot remove this',$e->getMessage(),409);
                    }
                }
                return $this->failure('Unexpected exception, Try later');
            }

        });
    }

    protected function unauthenticated($request, AuthenticationException $e) 
    {
        if ($request->expectsJson()) {
            return $this->failure('please login first',['error' => $e], 401);
        }
        return redirect()->guest('login');
    }

    
}
