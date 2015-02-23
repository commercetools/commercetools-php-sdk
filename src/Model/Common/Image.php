<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class Image
 * @package Sphere\Core\Model\Common
 * @method string getUrl()
 * @method Image setUrl(string $url)
 * @method array getDimensions()
 * @method Image setDimensions(array $dimensions)
 * @method string getLabel()
 * @method Image setLabel(string $label)
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
            'dimensions' => [static::TYPE => 'array'],
            'label' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param string $size
     * @return string
     */
    protected function getThumbnailUrl($size = null)
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
        return $this->getThumbnailUrl(static::THUMB);
    }

    /**
     * @return string
     */
    public function getSmall()
    {
        return $this->getThumbnailUrl(static::SMALL);
    }

    /**
     * @return string
     */
    public function getMedium()
    {
        return $this->getThumbnailUrl(static::MEDIUM);
    }

    /**
     * @return string
     */
    public function getLarge()
    {
        return $this->getThumbnailUrl(static::LARGE);
    }

    /**
     * @return string
     */
    public function getZoom()
    {
        return $this->getThumbnailUrl(static::ZOOM);
    }
}
