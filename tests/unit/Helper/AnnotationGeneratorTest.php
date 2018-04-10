<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */
namespace Commercetools\Core\Helper;

use Commercetools\Core\Helper\Annotate\AnnotationGenerator;
use PHPUnit\Framework\TestCase;

class AnnotationGeneratorTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testGenerate()
    {
        $path = __DIR__ . '/../../../src/';
        $generator = new AnnotationGenerator();
        $generator->run($path);
    }
}
