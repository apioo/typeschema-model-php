<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\Description;

#[Description('The root object of a TypeSchema document containing imports, definitions, and the entry point.')]
class TypeSchema implements \JsonSerializable, \PSX\Record\RecordableInterface
{
    /**
     * @var \PSX\Record\Record<DefinitionType>|null
     */
    #[Description('A dictionary of all types available within this schema document.')]
    protected ?\PSX\Record\Record $definitions = null;
    /**
     * @var \PSX\Record\Record<string>|null
     */
    #[Description('External TypeSchema documents to include, keyed by an alias namespace.')]
    protected ?\PSX\Record\Record $import = null;
    #[Description('The main entry-point definition for the schema.')]
    protected ?string $root = null;
    /**
     * @param \PSX\Record\Record<DefinitionType>|null $definitions
     */
    public function setDefinitions(?\PSX\Record\Record $definitions): void
    {
        $this->definitions = $definitions;
    }
    /**
     * @return \PSX\Record\Record<DefinitionType>|null
     */
    public function getDefinitions(): ?\PSX\Record\Record
    {
        return $this->definitions;
    }
    /**
     * @param \PSX\Record\Record<string>|null $import
     */
    public function setImport(?\PSX\Record\Record $import): void
    {
        $this->import = $import;
    }
    /**
     * @return \PSX\Record\Record<string>|null
     */
    public function getImport(): ?\PSX\Record\Record
    {
        return $this->import;
    }
    public function setRoot(?string $root): void
    {
        $this->root = $root;
    }
    public function getRoot(): ?string
    {
        return $this->root;
    }
    /**
     * @return \PSX\Record\RecordInterface<mixed>
     */
    public function toRecord(): \PSX\Record\RecordInterface
    {
        /** @var \PSX\Record\Record<mixed> $record */
        $record = new \PSX\Record\Record();
        $record->put('definitions', $this->definitions);
        $record->put('import', $this->import);
        $record->put('root', $this->root);
        return $record;
    }
    public function jsonSerialize(): object
    {
        return (object) $this->toRecord()->getAll();
    }
}

