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
     * @param string $hash
     *
     * @return HashedUrl | null
     */
    public function findByHash(string $hash) : ?HashedUrl
    {
        return HashedUrl::byHash($hash)->first();
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

        return $hashedUrl->fresh();
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
     * @param int $clicks
     *
     * @return int
     */
    private function clicksToInsert(int $clicks) : int
    {
        return $clicks + 1;
    }

    /**
     * @param HashedUrl $hashedUrl
     *
     * @return void
     */
    private function increaseUrlClicks(HashedUrl $hashedUrl)
    {
        $existingClicks = $hashedUrl->clicks();

        $hashedUrl->setClicks($this->clicksToInsert($existingClicks))->save();
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
     * @return HashedUrl
     */
    public function hashedUrl(string $url) : HashedUrl
    {
        $hashedUrl = $this->findByUrl($url);

        if (! empty($hashedUrl)) {
            return $hashedUrl;
        }

        $hashedUrl = $this->saveUrl($url);
        $hash = $this->generateHash($hashedUrl->id());

        $this->updateUrlHash($hashedUrl, $hash);

        return $hashedUrl;
    }

    /**
     * @param string $hash
     *
     * @return string
     */
    public function url(string $hash) : string
    {
        $hashedUrl = $this->findByHash($hash);

        if (! empty($hashedUrl)) {
            $this->increaseUrlClicks($hashedUrl);

            return $hashedUrl->url();
        }

        return '';
    }
}
