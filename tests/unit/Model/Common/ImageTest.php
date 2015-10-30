<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function sizeProvider()
    {
        return [
            ['thumb'],
            ['small'],
            ['medium'],
            ['large'],
            ['zoom'],
        ];
    }

    /**
     * @dataProvider sizeProvider
     * @param $size
     */
    public function testSizesFileName($size)
    {
        $image = Image::of();
        $image->setUrl('test.jpg');

        $function = 'get' . ucfirst($size);
        $this->assertSame('./test-'. $size . '.jpg', $image->$function());
    }

    /**
     * @dataProvider sizeProvider
     * @param $size
     */
    public function testSizesUri($size)
    {
        $image = Image::of();
        $image->setUrl('/test/test.jpg');

        $function = 'get' . ucfirst($size);
        $this->assertSame('/test/test-'. $size . '.jpg', $image->$function());
    }

    /**
     * @dataProvider sizeProvider
     * @param $size
     */
    public function testSizesNoExtension($size)
    {
        $image = Image::of();
        $image->setUrl('/test/test');

        $function = 'get' . ucfirst($size);
        $this->assertSame('/test/test-'. $size, $image->$function());
    }

    public function testGetSizeUrl()
    {
        $image = Image::of();
        $image->setUrl('/test/test.jpg');

        $this->assertEquals('/test/test.jpg', $image->getSizeUrl());
    }

    public function testEmptyUrlThumb()
    {
        $image = Image::of();
        $this->assertNull($image->getThumb());
    }
}
