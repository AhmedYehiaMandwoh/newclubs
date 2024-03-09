<?php

namespace App\Traits;

use App\Classes\Abilities;
use App\Classes\Helpmate;
use App\Exceptions\NotAuthorizedException;
use App\Services\BouncerService;
use Lorisleiva\Actions\ActionRequest;

trait ElAuthorizeAble
{
    protected Abilities $ability;

    /**
     * @return bool
     */
    public function authorize(ActionRequest|null $request): bool
    {
        return !isset($this->ability) || BouncerService::checkAbility($this->ability);
    }


    /**
     * @return void
     * @throws NotAuthorizedException
     */
    public function checkAbility(Abilities $ability): void
    {
        if (!BouncerService::checkAbility($ability)){
            throw (new NotAuthorizedException())->redirectBack();
        }
    }

    /**
     * @return void
     * @throws NotAuthorizedException
     */
    public function getAuthorizationFailure(): void
    {
        throw (new NotAuthorizedException())->redirectBack();
    }
}
