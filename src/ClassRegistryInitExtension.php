<?php

declare(strict_types=1);

namespace PHPStanCakePHP2;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStanCakePHP2\Service\SchemaService;
use Inflector;
use PhpParser\ConstExprEvaluator;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\BooleanType;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\ObjectWithoutClassType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;

class ClassRegistryInitExtension implements DynamicStaticMethodReturnTypeExtension
{
    private ReflectionProvider $reflectionProvider;

    private SchemaService $schemaService;

    public function __construct(
        ReflectionProvider $reflectionProvider,
        SchemaService $schemaService)
    {
        $this->reflectionProvider = $reflectionProvider;
        $this->schemaService = $schemaService;
    }

    public function getClass(): string
    {
        return 'ClassRegistry';
    }

    public function isStaticMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'init';
    }

    public function getTypeFromStaticMethodCall(MethodReflection $methodReflection, StaticCall $methodCall, Scope $scope): ?Type
    {
        $argumentType = $scope->getType($methodCall->getArgs()[0]->value);

        if (!$argumentType instanceof ConstantStringType) {
            return $this->getDefaultType();
        }

        $value = $argumentType->getValue();

        if ($this->reflectionProvider->hasClass($value)) {
            return new ObjectType($value);
        }

        if ($this->schemaService->hasTable(Inflector::tableize($value))) {
            return new ObjectType('Model');
        }

        return $this->getDefaultType();
    }

    private function getDefaultType(): Type
    {
        return new UnionType([
            new BooleanType(),
            new ObjectWithoutClassType(),
        ]);
    }
}
