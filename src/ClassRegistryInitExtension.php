<?php

namespace ARiddlestone\PHPStanCakePHP2;

use ARiddlestone\PHPStanCakePHP2\Service\SchemaService;
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
        $arg1 = $methodCall->getArgs()[0]->value;
        $evaluator = new ConstExprEvaluator();
        $arg1 = $evaluator->evaluateSilently($arg1);
        if (! is_string($arg1)) {
            return $this->getDefaultType();
        }
        if ($this->reflectionProvider->hasClass($arg1)) {
            return new ObjectType($arg1);
        }
        if ($this->schemaService->hasTable(Inflector::tableize($arg1))) {
            return new ObjectType('Model');
        }
        return $this->getDefaultType();
    }

    private function getDefaultType(): Type
    {
        return new UnionType([
            new BooleanType(),
            new ObjectWithoutClassType()
        ]);
    }
}
