<?php

namespace Commercetools\Core\Model\OrderSearch;

class SearchTest extends \PHPUnit\Framework\TestCase
{
    public function testHit() {
        $hit = Hit::of()->setRelevance(2.15)->setId('123456')->setVersion(1);

        $this->assertSame(['relevance' => 2.15, 'id' => '123456', 'version' => 1], $hit->toArray());
        $this->assertInstanceOf(Hit::class, $hit);
    }
}
