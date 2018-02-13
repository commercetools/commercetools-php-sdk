<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\Annotate;

/**
 * @package Commercetools\Core\Helper\Annotate
 */
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

    protected $constructorArgs = [];

    public function __construct($className)
    {
        $this->className = $className;
        $this->reflectClass();
        $this->reflectUseStatements();
        $this->reflectDocBlock();
        $this->reflectConstructorArgs();
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

    public function addMagicMethod(
        $methodName,
        $args,
        $returnTypeHint = null,
        $returnsReference = null,
        $shortDescription = null,
        $static = false,
        $force = false
    ) {
        if (!$force && $this->hasMethod($methodName)) {
            return;
        }

        $magicMethod = [
            'name' => $methodName,
            'returnTypeHint' => $returnTypeHint,
            'returnsReference' => $returnsReference,
            'args' => $args,
            'shortDescription' => $shortDescription,
            'static' => $static
        ];

        if (isset($this->magicGetSetMethods[$methodName])) {
            $magicMethod = array_merge($this->magicGetSetMethods[$methodName], $magicMethod);
        }

        $this->magicGetSetMethods[$methodName] = $magicMethod;
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
     * @return array
     */
    public function getConstructorArgs()
    {
        return $this->constructorArgs;
    }

    /**
     * @param $className
     * @param $alias
     */
    public function addUse($className, $alias = null)
    {
        $className = trim($className, '\\');
        try {
            $reflect = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            return;
        }
        if ($reflect->getNamespaceName() !== $this->namespace && !isset($this->uses[$className])) {
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
            $methods[$method->name] = $method;
        }
        $this->methods = $methods;
    }

    protected function reflectUseStatements()
    {
        $content = file_get_contents($this->getFileName());
        $tokens = token_get_all($content);
        for ($index = 0; isset($tokens[$index]); $index++) {
            if (!isset($tokens[$index][0])) {
                continue;
            }
            if (T_USE == $tokens[$index][0]) {
                $use = '';
                $index += 2;
                while ($tokens[$index][0] != T_AS && isset($tokens[$index]) && is_array($tokens[$index])) {
                    if ($tokens[$index][0] == T_WHITESPACE) {
                        $index++;
                        continue;
                    }
                    $use .= $tokens[$index++][1];
                }
                $alias = null;
                if ($tokens[$index][0] == T_AS) {
                    $alias = '';
                    $index += 2;
                    while (isset($tokens[$index]) && is_array($tokens[$index])) {
                        $alias .= $tokens[$index++][1];
                    }
                }
                $this->addUse($use, $alias);
            }
            if (T_CLASS == $tokens[$index][0]) {
                break;
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
                $lines[] = trim(preg_replace('/^ \*/', '', $line));
            }
        }

        $this->docBlockLines = $lines;
    }

    protected function reflectConstructorArgs()
    {
        $reflectionClass = new \ReflectionClass($this->getClassName());
        $constructor = $reflectionClass->getConstructor();
        $parameters = $constructor->getParameters();

        $args = [];
        foreach ($parameters as $parameter) {
            if ($parameter->isOptional()) {
                continue;
            }
            $typeClass = $parameter->getClass();
            $typeName = '';
            if (!is_null($typeClass)) {
                $typeName = $typeClass->getShortName();
            }
            $args[] = trim($typeName . ' $' . $parameter->getName());
        }
        $this->constructorArgs = $args;
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
        list(, $static, $returnTypeHint, $returnsReference, $name, $args, $shortDescription) = $matches;
        $type = $fieldName = '';
        if (preg_match('~^(set|get)(.*)~', $name, $matches)) {
            $type = $matches[1];
            $fieldName = $matches[2];
        }
        $args = array_map('trim', explode(',', $args));
        if (empty($type) || !$this->hasMethod($name)) {
            $this->magicGetSetMethods[$name] = [
                'name' => $name,
                'returnTypeHint' => $returnTypeHint,
                'returnsReference' => $returnsReference,
                'type' => $type,
                'fieldName' => $fieldName,
                'args' => $args,
                'static' => ($static === 'static'),
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
        return '~@method (?:(static)\\s+)?(?:([\\w\\\\]+(?:\\|[\\w\\\\]+)*)\\s+)?' .
            '(&)?\\s*(\\w+)\\s*\\(\\s*(.*)\\s*\\)\\s*(.*|$)~s';
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
