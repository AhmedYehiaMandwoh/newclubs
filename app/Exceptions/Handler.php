<?php

namespace App\Exceptions;

use App\Classes\ApiResponse;
use App\Classes\Localization;
use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        Localization::setLocaleHeader();

        if ($request->expectsJson() || Str::contains($request->fullUrl(),'api')){
            //update message  No query results for model
            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return $this->apiError([
                    'message'=>__('message.model_not_found'),
                    'error'=>$e->getMessage()
                ],404,message: __('message.model_not_found'));
            }


            //update message for error 500
            if ($e instanceof \Error) {
                return $this->apiError([
                    'message'=>__('message.error500'),
                    'error'=>$e->getMessage()
                ],500,message: $e->getMessage());
            }

            //not found page
            if ($e instanceof NotFoundHttpException) {
                return $this->apiError(code: 404, message: __('message.error404'));
            }

            //if php artisan down
            if ($e->getMessage()=='Service Unavailable') {
                return $this->apiError(code: 503, message: __('message.server_in_maintenance'));
            }
        }
        return parent::render($request, $e);
    }
}
