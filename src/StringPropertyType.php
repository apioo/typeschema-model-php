<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\Description;

#[Description('Represents a sequence of characters, optionally following a specific format.')]
class StringPropertyType extends ScalarPropertyType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('The value to be used if the property is not explicitly provided.')]
    protected ?string $default = null;
    #[Description('Provides specialized context for the string (e.g., \'date-time\').')]
    protected ?string $format = null;
    protected ?string $type = 'string';
    public function setDefault(?string $default): void
    {
        $this->default = $default;
    }
    public function getDefault(): ?string
    {
        return $this->default;
    }
    public function setFormat(?string $format): void
    {
        $this->format = $format;
    }
    public function getFormat(): ?string
    {
        return $this->format;
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
        $record->put('default', $this->default);
        $record->put('format', $this->format);
        $record->put('type', $this->type);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

