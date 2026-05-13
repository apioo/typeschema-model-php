<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\Description;

#[Description('A reference to a defined type in the global \'definitions\' map.')]
class ReferencePropertyType extends PropertyType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    #[Description('The name of the definition this property points to.')]
    protected ?string $target = null;
    /**
     * @var \PSX\Record\Record<string>|null
     */
    #[Description('Maps generic names in the target type to concrete definition names.')]
    protected ?\PSX\Record\Record $template = null;
    protected ?string $type = 'reference';
    public function setTarget(?string $target): void
    {
        $this->target = $target;
    }
    public function getTarget(): ?string
    {
        return $this->target;
    }
    /**
     * @param \PSX\Record\Record<string>|null $template
     */
    public function setTemplate(?\PSX\Record\Record $template): void
    {
        $this->template = $template;
    }
    /**
     * @return \PSX\Record\Record<string>|null
     */
    public function getTemplate(): ?\PSX\Record\Record
    {
        return $this->template;
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
        $record->put('target', $this->target);
        $record->put('template', $this->template);
        $record->put('type', $this->type);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

