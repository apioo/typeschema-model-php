<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\DerivedType;
use PSX\Schema\Attribute\Description;
use PSX\Schema\Attribute\Discriminator;

#[Description('Abstract base for properties that reference inline maps or arrays.')]
#[Discriminator('type')]
#[DerivedType(ArrayPropertyType::class, 'array')]
#[DerivedType(MapPropertyType::class, 'map')]
abstract class CollectionPropertyType extends PropertyType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('The schema definition for the items contained in this property\'s collection.')]
    protected ?PropertyType $schema = null;
    #[Description('The collection type identifier.')]
    protected ?string $type = null;
    public function setSchema(?PropertyType $schema): void
    {
        $this->schema = $schema;
    }
    public function getSchema(): ?PropertyType
    {
        return $this->schema;
    }
    public function setType(?string $type): void
    {
        $this->type = $type;
    }
    public function getType(): ?string
    {
        return $this->type;
    }
    /**
     * @return \PSX\Record\RecordInterface<mixed>
     */
    public function toRecord(): \PSX\Record\RecordInterface
    {
        /** @var \PSX\Record\Record<mixed> $record */
        $record = parent::toRecord();
        $record->put('schema', $this->schema);
        $record->put('type', $this->type);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

