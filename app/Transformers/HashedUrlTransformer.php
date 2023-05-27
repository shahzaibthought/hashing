<?php

namespace App\Transformers;

use App\HashedUrl;

class HashedUrlTransformer
{
	/**
	 * @param HashedUrl $hashedUrl
	 *
	 * @return array
	 */
	public function transform(HashedUrl $hashedUrl) : array
	{
		return [
            'url' => $hashedUrl->url(),
            'hashedUrl' => route('web.hashed.urls.show', ['hash' => $hashedUrl->hash()]),
            'clicks' => $hashedUrl->clicks(),
        ];
	}
}
