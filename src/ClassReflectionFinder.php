<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2;

use Exception;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;

/**
 * Finds class reflections for all classes at specified glob paths, optionally
 * restricted to children of certain classes.
 *
 * Assumes classes have no namespace, and are named the same as their files, eg.
 * "MyClass" is in a file called "MyClass.php".
 */
final class ClassReflectionFinder
{
    /**
     * @var ReflectionProvider
     */
    private $reflectionProvider;

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
        string $isA = 'stdClass'
    ): array {
        $classReflections = array_map(
            [$this->reflectionProvider, 'getClass'],
            $this->getClassNamesFromPaths($paths)
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
    private function getClassNamesFromPaths(array $paths): array
    {
        $classPaths = [];
        foreach ($paths as $path) {
            $filePaths = glob($path);
            if (! is_array($filePaths)) {
                throw new Exception(sprintf('glob(%s) caused an error', $path));
            }
            $classPaths = array_merge($classPaths, $filePaths);
        }
        $classNames = array_map(static function ($classPath) {
            return basename($classPath, '.php');
        }, $classPaths);
        return array_filter(
            $classNames,
            [$this->reflectionProvider, 'hasClass']
        );
    }
}
