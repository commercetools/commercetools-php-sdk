<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Symfony\Component\Yaml\Yaml;

/**
 * Class AbstractModelTest
 * @package Commercetools\Core\Model
 */
abstract class AbstractModelTest extends \PHPUnit\Framework\TestCase
{
    protected $fixture = 'models.yaml';

    protected $modelFields;

    public function fieldProvider()
    {
        if (is_null($this->modelFields)) {
            $fixturePath = __DIR__ . '/../../fixtures/';
            $this->modelFields = Yaml::parse(file_get_contents($fixturePath . $this->fixture));
        }

        return $this->modelFields;
    }

    protected function getInstance($className)
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = call_user_func($className . '::of');
        } else {
            $object = $this->getMockForAbstractClass($className, [], '', false);
        }

        return $object;
    }

    protected function getClassName($domain, $model)
    {
        return 'Commercetools\\Core\\Model\\' . ucfirst($domain) . '\\' . ucfirst($model);
    }
}
