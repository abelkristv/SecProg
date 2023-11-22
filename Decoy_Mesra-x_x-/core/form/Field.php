<?php

namespace app\core\form;
use app\core\Model;

class Field 
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
        $this->model = $model;
    }

    public function __toString(): string
    {
        return sprintf('
          <div class="mb-3 form-group">
            <label>%s</label>
            <input type="%s" class="form-control%s" name = "%s" value="%s"></textarea>
            <div class="invalid-feedback">
                %s
            </div>
          </div>
',          $this->attribute,
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}

?>
