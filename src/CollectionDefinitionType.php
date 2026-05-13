<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\DerivedType;
use PSX\Schema\Attribute\Description;
use PSX\Schema\Attribute\Discriminator;

#[Description('Abstract base for definitions that hold multiple values of a single type, such as arrays or maps.')]
#[Discriminator('type')]
#[DerivedType(ArrayDefinitionType::class, 'array')]
#[DerivedType(MapDefinitionType::class, 'map')]
abstract class CollectionDefinitionType extends DefinitionType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('The type of the elements or values contained within the collection.')]
    protected ?PropertyType $schema = null;
    #[Description('The type of collection (e.g., \'map\' or \'array\').')]
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

