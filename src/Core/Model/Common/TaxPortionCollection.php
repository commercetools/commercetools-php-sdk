<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-carts.html#taxportion
 * @method TaxPortion current()
 * @method TaxPortionCollection add(TaxPortion $element)
 * @method TaxPortion getAt($offset)
 */
class TaxPortionCollection extends Collection
{
    protected $type = TaxPortion::class;
}
