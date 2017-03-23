<?php
/**
 * Created by PhpStorm.
 * User: ibrahimselim
 * Date: 23/03/17
 * Time: 14:59
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method PriceTierCollection add(PriceTier $element)
 * @method PriceTier current()
 * @method PriceTier getAt($offset)
 */
class PriceTierCollection extends Collection
{
    protected $type = PriceTier::class;
}
