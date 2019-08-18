<?php
namespace CEC\Toolbox\Admin\Node;

class Element implements \CEC\Toolbox\Admin\Node
{
    use \CEC\Toolbox\Admin\Tree;
    protected $tag;
    protected $attributes = [];
    const VOID_TAGS = ['input', 'img', 'hr', 'br', 'meta', 'link', 'area', 'base', 'col', 'embed', 'param', 'source', 'track', 'wbr'];

    public function __construct($tag, array $attributes = [], array $children = [])
    {
        $this->tag = $this->sanitize_name($tag);
        $this->setAttributes($attributes);
        if (!empty($children)) {
            $this->appendChildren($children);
        }
    }

    public function getAttribute($name)
    {
        $name = $this->sanitize_name($name);
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
    }

    public function setAttribute($name, $value)
    {
        $name = $this->sanitize_name($name);
        $this->attributes[$name] = is_bool($value) ? $value : (string) $value;

        return $this;
    }

    public function removeAttribute($name)
    {
        $name = $this->sanitize_name($name);
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }

        return $this;
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $name=>$value) {
            $this->setAttribute($name, $value);
        }

        return $this;
    }

    public function clearAttributes()
    {
        $this->attributes = [];

        return $this;
    }

    public function renderAttributeString()
    {
        $attributeString = '';

        foreach ($this->attributes as $name => $value) {
            if (is_bool($value) && true === $value) {
                $attributeString .= sprintf(" %s", $name);
            } elseif (is_string($value) && !empty($value)) {
                $attributeString .= sprintf(" %s='%s'", $name, $value);
            }
        }

        return $attributeString;
    }

    public function isVoidElement()
    {
        return in_array($this->tag, self::VOID_TAGS);
    }

    public function renderChildren()
    {
        $childrenString = "";
        foreach ($this->children as $child) {
            $childrenString .= $child;
        }

        return $childrenString;
    }

    public function renderOpenTag()
    {
        return sprintf("<%s%s>", $this->tag, $this->renderAttributeString());
    }

    public function renderCloseTag()
    {
        if ($this->isVoidElement()) {
            return "";
        }

        return sprintf("</%s>", $this->tag);
    }

    public function sanitize_name($tag)
    {
        //Lower case everything
        $tag = strtolower($tag);
        //Make alpha (removes all other characters)
        $tag = preg_replace("/[^a-z_\s-]/", "", $tag);
        //Clean up multiple dashes or whitespaces
        $tag = preg_replace("/[\s-]+/", " ", $tag);
        //Convert whitespaces and underscore to dash
        $tag = preg_replace("/[\s_]/", "-", $tag);
        return $tag;
    }

    public static function create($tag, array $attributes = [], array $children = [])
    {
        return new Element($tag, $attributes, $children);
    }

    public function render()
    {
        return sprintf("%s%s%s", $this->renderOpenTag(), $this->renderChildren(), $this->renderCloseTag());
    }

    public function __toString()
    {
        return $this->render();
    }

    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    public function __unset($name)
    {
        unset($this->attributes[$name]);
    }
}
