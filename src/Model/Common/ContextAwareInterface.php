<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


interface ContextAwareInterface
{
    /**
     * @return Context
     */
    public function getContext();

    /**
     * @return callable
     */
    public function getContextCallback();

    /**
     * @param Context|callable $context
     * @return mixed
     */
    public function setContext($context = null);

    /**
     * @param Context|callable $context
     * @return mixed
     */
    public function setContextIfNull($context = null);
}
