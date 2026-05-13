<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\DerivedType;
use PSX\Schema\Attribute\Description;
use PSX\Schema\Attribute\Discriminator;

#[Description('The base abstract type for all schema definitions. It provides metadata common to all types such as descriptions and deprecation status.')]
#[Discriminator('type')]
#[DerivedType(ArrayDefinitionType::class, 'array')]
#[DerivedType(MapDefinitionType::class, 'map')]
#[DerivedType(StructDefinitionType::class, 'struct')]
abstract class DefinitionType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('Indicates if this type is legacy and should no longer be used in new implementations.')]
    protected ?bool $deprecated = null;
    #[Description('A brief explanation of the purpose and usage of this type.')]
    protected ?string $description = null;
    #[Description('The discriminator value used to identify the specific definition subclass.')]
    protected ?string $type = null;
    public function setDeprecated(?bool $deprecated): void
    {
        $this->deprecated = $deprecated;
    }
    public function getDeprecated(): ?bool
    {
        return $this->deprecated;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getDescription(): ?string
    {
        return $this->description;
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
        $record = new \PSX\Record\Record();
        $record->put('deprecated', $this->deprecated);
        $record->put('description', $this->description);
        $record->put('type', $this->type);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

