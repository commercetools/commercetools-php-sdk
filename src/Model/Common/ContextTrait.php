<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


trait ContextTrait
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @return Context
     */
    public function getContext()
    {
        if (is_null($this->context)) {
            $this->context = new Context();
        }
        return $this->context;
    }

    /**
     * @param Context $context
     * @return $this
     */
    public function setContext(Context $context = null)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @param Context $context
     * @return $this
     */
    public function setContextIfNull(Context $context = null)
    {
        if (is_null($this->context)) {
            $this->setContext($context);
        }

        return $this;
    }
}
