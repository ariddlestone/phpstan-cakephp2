<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use Component;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Scalar\String_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

class LoadComponentOnFlyMethodReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    private ReflectionProvider $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function getClass(): string
    {
        return \ComponentCollection::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'load';
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): ?Type
    {
        $arg = $methodCall->getArgs()[0]->value;

        if (!$arg instanceof String_) {
            return null;
        }

        $componentName = $arg->value . 'Component';

        if (!$this->reflectionProvider->hasClass($componentName)) {
            return null;
        }

        if (!$this->reflectionProvider->getClass($componentName)->is(Component::class)) {
            return null;
        }

        return new ObjectType($componentName);
    }
}
