<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\DerivedType;
use PSX\Schema\Attribute\Description;
use PSX\Schema\Attribute\Discriminator;

#[Description('Abstract base for simple value types like strings, numbers, and booleans.')]
#[Discriminator('type')]
#[DerivedType(BooleanPropertyType::class, 'boolean')]
#[DerivedType(IntegerPropertyType::class, 'integer')]
#[DerivedType(NumberPropertyType::class, 'number')]
#[DerivedType(StringPropertyType::class, 'string')]
abstract class ScalarPropertyType extends PropertyType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('The specific scalar type name.')]
    protected ?string $type = null;
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
        $record->put('type', $this->type);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

