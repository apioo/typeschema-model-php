<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\Description;

#[Description('Represents a fixed-structure object (class/record). It supports inheritance and explicit property definitions.')]
class StructDefinitionType extends DefinitionType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('If true, this struct acts as an abstract template and cannot be instantiated directly.')]
    protected ?bool $base = null;
    #[Description('The property name used to distinguish between different implementations of a base struct.')]
    protected ?string $discriminator = null;
    /**
     * @var \PSX\Record\Record<string>|null
     */
    #[Description('Maps discriminator values to their concrete definition names for polymorphic handling.')]
    protected ?\PSX\Record\Record $mapping = null;
    #[Description('A reference to another struct from which this struct inherits properties.')]
    protected ?ReferencePropertyType $parent = null;
    /**
     * @var \PSX\Record\Record<PropertyType>|null
     */
    #[Description('A map of property names to their respective types defining the structure of the object.')]
    protected ?\PSX\Record\Record $properties = null;
    protected ?string $type = 'struct';
    public function setBase(?bool $base): void
    {
        $this->base = $base;
    }
    public function getBase(): ?bool
    {
        return $this->base;
    }
    public function setDiscriminator(?string $discriminator): void
    {
        $this->discriminator = $discriminator;
    }
    public function getDiscriminator(): ?string
    {
        return $this->discriminator;
    }
    /**
     * @param \PSX\Record\Record<string>|null $mapping
     */
    public function setMapping(?\PSX\Record\Record $mapping): void
    {
        $this->mapping = $mapping;
    }
    /**
     * @return \PSX\Record\Record<string>|null
     */
    public function getMapping(): ?\PSX\Record\Record
    {
        return $this->mapping;
    }
    public function setParent(?ReferencePropertyType $parent): void
    {
        $this->parent = $parent;
    }
    public function getParent(): ?ReferencePropertyType
    {
        return $this->parent;
    }
    /**
     * @param \PSX\Record\Record<PropertyType>|null $properties
     */
    public function setProperties(?\PSX\Record\Record $properties): void
    {
        $this->properties = $properties;
    }
    /**
     * @return \PSX\Record\Record<PropertyType>|null
     */
    public function getProperties(): ?\PSX\Record\Record
    {
        return $this->properties;
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
        $record->put('base', $this->base);
        $record->put('discriminator', $this->discriminator);
        $record->put('mapping', $this->mapping);
        $record->put('parent', $this->parent);
        $record->put('properties', $this->properties);
        $record->put('type', $this->type);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

