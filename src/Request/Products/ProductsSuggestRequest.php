<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\AbstractSuggestRequest;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\SortTrait;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductsSuggestRequest of($sort = null, $limit = null, $staged = false)
 */
class ProductsSuggestRequest extends AbstractProjectionRequest
{
    use OfTrait;
    use PageTrait;
    use SortTrait;

    /**
     * @return string
     */
    protected function getProjectionAction()
    {
        return 'suggest';
    }

    /**
     * @param string $sort
     * @param int $limit
     * @param bool $staged
     */
    public function __construct($sort = null, $limit = null, $staged = false)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $sort, $limit, null, $staged);
    }
}
