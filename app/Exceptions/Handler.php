<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        TechnicalException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

    	//400+
	    if($exception instanceof \InvalidArgumentException) {
		    return new JsonResponse(
			    [
				    "code" => 400,
				    "message" => $exception->getMessage()
			    ], 400);
	    }

	    if($exception instanceof NotFoundException) {
		    return new JsonResponse([
			    "code" => 404,
		    	"message" => "<a href='mailto:jacob@balabnaov.ca'>admin</a>"], 404);
	    }

	    if($exception instanceof MethodNotAllowedHttpException) {
		    return new JsonResponse([
			    "code" => 405,
			    "message" => "Method not allowed"
		    ], 405);
	    }

	    //500+
	    if($exception instanceof TechnicalException) {
		    new JsonResponse([
		    	"code"    => 500,
		    	"message" => "Technical problem, Please contact the <a href='mailto:jacob@balabnaov.ca'>admin</a>"
		    ], 500);
	    }

	    return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
