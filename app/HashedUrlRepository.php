<?php

namespace App;

class HashedUrlRepository
{
    /**
     * @param string $url
     *
     * @return HashedUrl | null
     */
    private function findByUrl(string $url) : ?HashedUrl
    {
        return HashedUrl::byUrl($url)->first();
    }

    /**
     * @param string $url
     *
     * @return HashedUrl
     */
    private function saveUrl(string $url) : HashedUrl
    {
        $hashedUrl = new HashedUrl();
        $hashedUrl = $hashedUrl->setUrl($url);
        $hashedUrl->save();

        return $hashedUrl;
    }

    /**
     * @param HashedUrl $hashedUrl
     * @param string $hash
     *
     * @return void
     */
    private function updateUrlHash(HashedUrl $hashedUrl, string $hash)
    {
        $hashedUrl->setHash($hash)->save();
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function generateHash(string $value) : string
    {
        $checksum = crc32($value);

        return dechex($checksum);
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function urlHash(string $url) : string
    {
        $hashedUrl = $this->findByUrl($url);

        if (! empty($hashedUrl)) {
            return $hashedUrl->hash();
        }

        $hashedUrl = $this->saveUrl($url);
        $hash = $this->generateHash($hashedUrl->id());

        $this->updateUrlHash($hashedUrl, $hash);

        return $hash;
    }
}
