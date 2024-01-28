<?php

declare(strict_types=1);

namespace PHPStanCakePHP2;

use Exception;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Finds class reflections for all classes at specified glob paths, optionally
 * restricted to children of certain classes.
 */
final class ClassReflectionFinder
{
    private ReflectionProvider $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    /**
     * @param array<string> $paths
     *
     * @return array<ClassReflection>
     *
     * @throws Exception
     */
    public function getClassReflections(
        array $paths,
        string $isA = 'stdClass',
        ?callable $pathToClassName = null
    ): array {
        $classReflections = array_map(
            [$this->reflectionProvider, 'getClass'],
            $this->getClassNamesFromPaths($paths, $pathToClassName)
        );
        return array_filter(
            $classReflections,
            static function (
                ClassReflection $classReflection
            ) use ($isA) {
                return $classReflection->is($isA);
            }
        );
    }

    /**
     * @param array<string> $paths
     *
     * @return array<string>
     *
     * @throws Exception
     */
    private function getClassNamesFromPaths(
        array $paths,
        ?callable $pathToClassName
    ): array {
        $classPaths = [];
        foreach ($paths as $path) {
            $filePaths = glob($path);
            if (! is_array($filePaths)) {
                throw new Exception(sprintf('glob(%s) caused an error', $path));
            }
            $classPaths = array_merge($classPaths, $filePaths);
        }
        $classNames = array_map($pathToClassName ?? [$this, 'getClassNameFromFileName'], $classPaths);
        return array_filter(
            $classNames,
            [$this->reflectionProvider, 'hasClass']
        );
    }

    private function getClassNameFromFileName(string $fileName): string
    {
        return basename($fileName, '.php');
    }
}
