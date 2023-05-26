<?php

namespace Tests\Unit;

use App\HashedUrlRepository;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class HashedUrlRepositoryTest extends TestCase
{
    /**
     * @var HashedUrlRepository
     */
    private $hashedUrlRepository;

    public function setUp() : void
    {
        parent::setUp();

        $this->hashedUrlRepository = app(HashedUrlRepository::class);
    }

    /**
     * @return array
     */
    public function providerTestClicksToInsert() : array
    {
        return [
            [
                1,
                2,
            ],
            [
                10,
                11,
            ],
            [
                100,
                101,
            ],
        ];
    }

    /**
     * @dataProvider providerTestClicksToInsert
     *
     * @return void
     */
    public function testClicksToInsert(int $existingClicks, int $expectedClicksToInsert)
    {
        $hashedUrlRepository = new ReflectionClass(HashedUrlRepository::class);
        $method = $hashedUrlRepository->getMethod('clicksToInsert');
        $method->setAccessible(true);
        $actualClicksToInsert = $method->invokeArgs($this->hashedUrlRepository, [$existingClicks]);

        $this->assertSame($expectedClicksToInsert, $actualClicksToInsert);
    }
}
