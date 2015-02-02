<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Sphere\Core\Request;


/**
 * Class AbstractQueryRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractQueryRequest extends AbstractPagedRequest
{
    use QueryTrait;
}
