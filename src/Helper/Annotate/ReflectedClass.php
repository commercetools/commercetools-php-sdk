<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper\Annotate;


class ReflectedClass
{
    /**
     * @var bool
     */
    protected $abstract;

    protected $fileName;

    protected $className;
    protected $shortClassName;

    protected $namespace;
    protected $uses = [];
    protected $methods = [];
    protected $magicGetSetMethods = [];
    protected $docBlockLines = [];

    public function __construct($className)
    {
        $this->className = $className;
        $this->reflectClass();
        $this->reflectUseStatements();
        $this->reflectDocBlock();
    }

    public function addMagicGetSetMethod(
        $type,
        $fieldName,
        $args,
        $returnTypeHint = null,
        $returnsReference = null,
        $shortDescription = null
    ) {
        $name = $type . ucfirst($fieldName);
        if ($this->hasMethod($name)) {
            return;
        }

        $magicMethod = [
            'name' => $name,
            'returnTypeHint' => $returnTypeHint,
            'returnsReference' => $returnsReference,
            'type' => $type,
            'fieldName' => $fieldName,
            'args' => $args,
            'shortDescription' => $shortDescription
        ];

        if (isset($this->magicGetSetMethods[$name])) {
            $magicMethod = array_merge($this->magicGetSetMethods[$name], $magicMethod);
        }

        $this->magicGetSetMethods[$name] = $magicMethod;
    }

    public function hasMethod($methodName)
    {
        return isset($this->methods[$methodName]);
    }

    public function hasMagicGetSetMethod($methodName)
    {
        return isset($this->magicGetSetMethods[$methodName]);
    }

    public function getMethod($methodName)
    {
        if ($this->hasMethod($methodName)) {
            return $this->methods[$methodName];
        }
        return false;
    }

    public function getMagicGetSetMethod($methodName)
    {
        if ($this->hasMethod($methodName)) {
            return $this->magicGetSetMethods[$methodName];
        }
        return false;
    }

    /**
     * @param $fieldType
     * @param $alias
     */
    public function addUse($className, $alias = null)
    {
        $className = trim($className, '\\');
        if (strpos($className, $this->namespace . '\\') === false && !isset($this->uses[$className])) {
            $this->uses[$className] = [
                'class' => $className,
                'alias' => $alias
            ];
        }
    }

    protected function reflectClass()
    {
        $reflectionClass = new \ReflectionClass($this->getClassName());
        $this->shortClassName = $reflectionClass->getShortName();
        $this->namespace = $reflectionClass->getNamespaceName();
        $this->fileName = $reflectionClass->getFileName();
        $this->abstract = $reflectionClass->isAbstract();

        $methods = [];
        foreach ($reflectionClass->getMethods() as $method) {
            $methods[$method->getName()] = $method;
        }
        $this->methods = $methods;
    }

    protected function reflectUseStatements()
    {
        $source = file_get_contents($this->getFileName());
        preg_match('~namespace(.*)class~s', $source, $matches);

        $headData = $matches[1];
        preg_match_all('~use (.*);\n~', $headData, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $match) {
                $data = explode(' as ', $match);
                $class = $data[0];
                $alias = null;
                if (isset($data[1])) {
                    $alias = $data[1];
                }
                $this->addUse($class, $alias);
            }
        }
    }

    protected function reflectDocBlock()
    {
        $reflectionClass = new \ReflectionClass($this->getClassName());
        $docBlock = $reflectionClass->getDocComment();

        $docBlockLines = explode(PHP_EOL, $docBlock);

        $lines = [];
        foreach ($docBlockLines as $line) {
            if ($this->skipDocBlockLine($line)) {
                continue;
            } elseif (preg_match($this->getMethodPattern(), $line, $matches)) {
                $this->reflectMagicMethods($matches);
            } else {
                $lines[] = preg_replace('/^ \* /', '', $line);
            }
        }

        $this->docBlockLines = $lines;
    }

    /**
     * @param $type
     * @param $fieldName
     * @return string
     */
    protected function getMethodName($type, $fieldName)
    {
        return $type . ucfirst($fieldName);
    }

    protected function reflectMagicMethods($matches)
    {
        list(, $returnTypeHint, $returnsReference, $name, $type, $fieldName, $args, $shortDescription) = $matches;

        if (!$this->hasMethod($name)) {
            $this->magicGetSetMethods[$name] = [
                'name' => $name,
                'returnTypeHint' => $returnTypeHint,
                'returnsReference' => $returnsReference,
                'type' => $type,
                'fieldName' => $fieldName,
                'args' => $args,
                'shortDescription' => $shortDescription
            ];
        }
    }

    protected function skipDocBlockLine($line)
    {
        return (strpos($line, '/**') === 0)
            || (strpos($line, ' */') === 0)
            || (strpos($line, '@package') > 0)
            || (strpos($line, '* Class') > 0);
    }

    /**
     * @return string
     */
    protected function getMethodPattern()
    {
        return '~@method\\s+(?:([$\\w\\\\]+(?:\\|[$\\w\\\\]+)*)\\s+)?(&)?' .
        '\\s*((set|get)(\\w+))\\s*\\(\\s*(.*)\\s*\\)\\s*(.*|$)~s';
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return mixed
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @return mixed
     */
    public function getMagicGetSetMethods()
    {
        return $this->magicGetSetMethods;
    }

    /**
     * @return array
     */
    public function getDocBlockLines()
    {
        return $this->docBlockLines;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return bool
     */
    public function isAbstract()
    {
        return $this->abstract;
    }

    /**
     * @return mixed
     */
    public function getShortClassName()
    {
        return $this->shortClassName;
    }
}
