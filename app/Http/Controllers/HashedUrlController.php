<?php

namespace App\Http\Controllers;

use App\HashedUrlRepository;

class HashedUrlController extends Controller
{
    /**
     * @param HashedUrlRepository $repository
     * @param string $hash
     *
     * @return mixed
     */
    public function show(HashedUrlRepository $repository, string $hash)
    {
        try {
            $hashedUrl = $repository->findByHash($hash);

            if (! empty($hashedUrl)) {
                $repository->increaseUrlClicks($hashedUrl);

                return redirect($hashedUrl->url());
            }

            return response()->json([
                'error' => 'The URL was\'t found.',
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Error while getting the URL back', ['message' => $e->getTraceAsString()]);

            return response()->json([
                'error' => 'There has been some errors while getting the URL.',
            ], 500);
        }
    }
}
