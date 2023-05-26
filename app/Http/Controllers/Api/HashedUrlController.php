<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HashedUrl\StoreRequest;

class HashedUrlController extends Controller
{
    /**
     * @param StoreRequest $request
     *
     * @return string
     */
    public function store(StoreRequest $request)
    {
        return 'Welcome to HashedUrlController ... Good bye!';
    }
}
