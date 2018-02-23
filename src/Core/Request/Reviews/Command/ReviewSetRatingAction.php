<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-rating
 * @method string getAction()
 * @method ReviewSetRatingAction setAction(string $action = null)
 * @method int getRating()
 * @method ReviewSetRatingAction setRating(int $rating = null)
 */
class ReviewSetRatingAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'rating' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setRating');
    }
}
