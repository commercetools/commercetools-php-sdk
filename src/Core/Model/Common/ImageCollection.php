<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#images
 * @method Image current()
 * @method ImageCollection add(Image $element)
 * @method Image getAt($offset)
 */
class ImageCollection extends Collection
{
    protected $type = Image::class;
}
