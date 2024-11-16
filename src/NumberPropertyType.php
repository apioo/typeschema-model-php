<?php

declare(strict_types = 1);

namespace TypeSchema\Model;

use PSX\Schema\Attribute\Description;

#[Description('Represents a float value')]
class NumberPropertyType extends ScalarPropertyType implements \JsonSerializable, \PSX\Record\RecordableInterface
{
}

