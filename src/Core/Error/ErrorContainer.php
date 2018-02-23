<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Error
 *
 * @method ErrorContainer add(ApiError $element)
 * @method ApiError current()
 * @method ApiError getAt($offset)
 */
class ErrorContainer extends Collection
{
    const CODE = 'code';

    protected $type = ApiError::class;

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ApiError) {
            $id = $row->getCode();
        } else {
            $id = $row[static::CODE];
        }
        $this->addToIndex(static::CODE, $offset, $id);
    }

    /**
     * @param $code
     * @return ApiError
     */
    public function getByCode($code)
    {
        return $this->getBy(static::CODE, $code);
    }
}
