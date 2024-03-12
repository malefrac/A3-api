<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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

    private $url = ['location', 'career', 'instructor', 'sheduling_enviroment', 'learning_enviroment', 'enviroment_type', 'course', 'user'];


    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

    $this->renderable(function(NotFoundHttpException $e, $request)
        {
            $urlFinal = preg_filter('/^/', 'api/', $this->url);
            $urlFinal = preg_filter('/$/', '/*', $this->url);

            if($request->is($urlFinal))
            {
                return response()->json([
                    'message' => 'URL no econtrada'
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function(MethodNotAllowedHttpException $e, $request)
        {
                return response()->json([
                    'message' => 'Método no econtrado o soportado'
                ], Response::HTTP_METHOD_NOT_ALLOWED);
        });
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof AuthorizationException)
        {
            return response()->json([
                'message' => 'Acceso prohibido al recurso'
            ], Response::HTTP_FORBIDDEN);
        }

        if($exception instanceof RouteNotFoundException)
        {
            return response()->json([
                'message' => 'Debe iniciar sesión'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $exception);
    }

}
