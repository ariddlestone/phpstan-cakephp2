<?php

declare(strict_types=1);

namespace ARiddlestone\PHPStanCakePHP2\Service;

use ARiddlestone\PHPStanCakePHP2\ClassReflectionFinder;
use Exception;
use PHPStan\BetterReflection\Reflection\Adapter\ReflectionProperty;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;
use ReflectionProperty as CoreReflectionProperty;

/**
 * Identifies schema files, and uses them to provide information about tables
 * and columns in the database.
 *
 * @phpstan-type table_schema mixed
 * @phpstan-type column_schema mixed
 */
final class SchemaService
{
    private ReflectionProvider $reflectionProvider;

    /**
     * @var list<string>
     */
    private array $schemaPaths;

    /**
     * @var array<string, table_schema>
     */
    private ?array $tableSchemas = null;

    /**
     * @var list<string>|null
     */
    private ?array $cakeSchemaPropertyNames = null;

    /**
     * @param list<string> $schemaPaths
     */
    public function __construct(
        ReflectionProvider $reflectionProvider,
        array $schemaPaths
    ) {
        $this->reflectionProvider = $reflectionProvider;
        $this->schemaPaths = $schemaPaths;
    }

    /**
     * @throws Exception
     */
    public function hasTable(string $table): bool
    {
        return array_key_exists($table, $this->getTableSchemas());
    }

    /**
     * @return table_schema|null
     *
     * @throws Exception
     */
    public function getTableSchema(string $table)
    {
        $tableSchemas = $this->getTableSchemas();

        return array_key_exists($table, $tableSchemas)
            ? $tableSchemas[$table]
            : null;
    }

    /**
     * @return array<string, table_schema>
     *
     * @throws Exception
     */
    private function getTableSchemas(): array
    {
        if (is_array($this->tableSchemas)) {
            return $this->tableSchemas;
        }
        $this->tableSchemas = [];
        $classReflectionFinder = new ClassReflectionFinder(
            $this->reflectionProvider,
        );
        $schemaReflections = $classReflectionFinder->getClassReflections(
            $this->schemaPaths,
            'CakeSchema',
            function (string $fileName) {
                return $this->fileNameToClassName($fileName);
            },
        );
        foreach ($schemaReflections as $schemaReflection) {
            $this->tableSchemas += $this->extractTableSchemas(
                $schemaReflection,
            );
        }

        return $this->tableSchemas;
    }

    /**
     * @return list<string>
     */
    private function getCakeSchemaPropertyNames(): array
    {
        return $this->cakeSchemaPropertyNames ??= array_map(
            static function (ReflectionProperty $reflectionProperty) {
                return $reflectionProperty->getName();
            },
            $this->reflectionProvider
                ->getClass('CakeSchema')
                ->getNativeReflection()
                ->getProperties(),
        );
    }

    /**
     * @return array<string, table_schema>
     */
    private function extractTableSchemas(
        ClassReflection $schemaReflection
    ): array {
        $propertyNames = array_map(
            static function (ReflectionProperty $reflectionProperty) {
                return $reflectionProperty->getName();
            },
            $schemaReflection
                ->getNativeReflection()
                ->getProperties(CoreReflectionProperty::IS_PUBLIC),
        );
        $tableProperties = array_diff(
            $propertyNames,
            $this->getCakeSchemaPropertyNames(),
        );

        return array_intersect_key(
            $schemaReflection->getNativeReflection()->getDefaultProperties(),
            array_fill_keys($tableProperties, null),
        );
    }

    private function fileNameToClassName(string $fileName): string
    {
        return str_replace(
            ' ',
            '',
            ucwords(
                str_replace(
                    ['_', '-'],
                    ' ',
                    basename($fileName, '.php'),
                ),
            ),
        ).'Schema';
    }
}
