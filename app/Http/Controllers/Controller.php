<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\Manager;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    const REST_OK = 200;
    const REST_CREATED = 201;
    const REST_ACCEPTED = 202;
    const REST_NO_CONTENT = 204;

    const REST_BAD_REQUEST = 400;
    const REST_UNAUTHORIZED = 401;
    const REST_FORBIDDEN = 403;

    const REST_INTERNAL_SERVER_ERROR = 500;

    use RestResponseTrait;

    /**
     * Constructor
     *
     * @param Manager|null $fractal
     */
    public function __construct(Manager $fractal = null)
    {
        $fractal = $fractal === null ? new Manager() : $fractal;
        $this->setFractal($fractal);
    }

    /**
     * @return array
     */
    protected function getRelations()
    {
        $request = App::make(Request::class);
        if ($request->has('with')) {
            return explode(',', $request->get('with'));
        }

        return [];
    }
}
