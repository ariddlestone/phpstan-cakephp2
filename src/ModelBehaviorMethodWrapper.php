<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

class ModelBehaviorMethodWrapper implements MethodReflection
{
    /**
     * @var MethodReflection
     */
    private $wrappedMethod;

    public function __construct(MethodReflection $wrappedMethod)
    {
        $this->wrappedMethod = $wrappedMethod;
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->wrappedMethod->getDeclaringClass();
    }

    public function isStatic(): bool
    {
        return $this->wrappedMethod->isStatic();
    }

    public function isPrivate(): bool
    {
        return $this->wrappedMethod->isPrivate();
    }

    public function isPublic(): bool
    {
        return $this->wrappedMethod->isPublic();
    }

    public function getDocComment(): ?string
    {
        return $this->wrappedMethod->getDocComment();
    }

    public function getName(): string
    {
        return $this->wrappedMethod->getName();
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this->wrappedMethod->getPrototype();
    }

    /**
     * @return array<ParametersAcceptor>
     */
    public function getVariants(): array
    {
        return array_map(static function (ParametersAcceptor $variant) {
            $parameters = $variant->getParameters();
            array_shift($parameters);
            return new FunctionVariant(
                $variant->getTemplateTypeMap(),
                $variant->getResolvedTemplateTypeMap(),
                $parameters,
                $variant->isVariadic(),
                $variant->getReturnType()
            );
        }, $this->wrappedMethod->getVariants());
    }

    public function isDeprecated(): TrinaryLogic
    {
        return $this->wrappedMethod->isDeprecated();
    }

    public function getDeprecatedDescription(): ?string
    {
        return $this->wrappedMethod->getDeprecatedDescription();
    }

    public function isFinal(): TrinaryLogic
    {
        return $this->wrappedMethod->isFinal();
    }

    public function isInternal(): TrinaryLogic
    {
        return $this->wrappedMethod->isInternal();
    }

    public function getThrowType(): ?Type
    {
        return $this->wrappedMethod->getThrowType();
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return $this->wrappedMethod->hasSideEffects();
    }
}
