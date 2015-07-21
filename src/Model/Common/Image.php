<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-projects-products.html#product-images
 * @method string getUrl()
 * @method Image setUrl(string $url = null)
 * @method ImageDimension getDimensions()
 * @method Image setDimensions(ImageDimension $dimensions = null)
 * @method string getLabel()
 * @method Image setLabel(string $label = null)
 */
class Image extends JsonObject
{
    const THUMB = 'thumb';
    const SMALL = 'small';
    const MEDIUM = 'medium';
    const LARGE = 'large';
    const ZOOM = 'zoom';

    public function getFields()
    {
        return [
            'url' => [static::TYPE => 'string'],
            'dimensions' => [static::TYPE => '\Sphere\Core\Model\Common\ImageDimension'],
            'label' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param string $size
     * @return string
     * @internal
     */
    public function getSizeUrl($size = null)
    {
        if (empty($size)) {
            return $this->getUrl();
        }
        $fileInfo = pathinfo($this->getUrl());

        $dirName = isset($fileInfo['dirname']) ? $fileInfo['dirname'] : '';
        $fileName = isset($fileInfo['filename']) ? $fileInfo['filename'] : '';
        $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';
        $url = $dirName . '/' . $fileName . '-' . $size . $extension;

        return $url;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->getSizeUrl(static::THUMB);
    }

    /**
     * @return string
     */
    public function getSmall()
    {
        return $this->getSizeUrl(static::SMALL);
    }

    /**
     * @return string
     */
    public function getMedium()
    {
        return $this->getSizeUrl(static::MEDIUM);
    }

    /**
     * @return string
     */
    public function getLarge()
    {
        return $this->getSizeUrl(static::LARGE);
    }

    /**
     * @return string
     */
    public function getZoom()
    {
        return $this->getSizeUrl(static::ZOOM);
    }
}
