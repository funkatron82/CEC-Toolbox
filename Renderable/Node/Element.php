<?php
namespace CEC\Toolbox\Renderable\Node;

class Element implements \CEC\Toolbox\Renderable\Node
{
    protected $children;
    protected $tagName;
    protected $attributes;
    protected $classList;
    const VOID_TAGS = ['input', 'img', 'hr', 'br', 'meta', 'link', 'area', 'base', 'col', 'embed', 'param', 'source', 'track', 'wbr'];

    public function __construct(
        $tagName,
        \CEC\Toolbox\Renderable\Attributes $attributes,
        \CEC\Toolbox\Renderable\ClassList $tclassList,
        \CEC\Toolbox\Renderable\RenderableList $children
    ) {
        $this->tag = $this->sanitizeTag($tagName);
        $this->attributes = $attributes;
        $this->classList = $tclassList;
        $this->children = $children;
    }

    public function appendChild(\CEC\Toolbox\Renderable $child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function appendChildren(array $children)
    {
        foreach ($children as $child) {
            $this->appendChild($child);
        }
        return $this;
    }

    public function sanitizeTag($tagName)
    {
        //Lower case everything
        $tagName = strtolower($tagName);
        //Make alpha (removes all other characters)
        $tagName = preg_replace("/[^a-z0-9]/", "", $tagName);
        return $tagName;
    }

    public function getAttribute($name)
    {
        return $this->attributes[$name];
    }

    public function setAttribute($name, $value)
    {
        if ('class' === $name) {
            $this->classList->removeAll();
            $classes = explode(' ', $value);
            $this->addClass(...$classes);
        }
        $this->attributes[$name] = $value;
        return $this;
    }

    public function setAttributes(array $attributes)
    {
        array_walk($attributes, function ($value, $key) {
            $this->setAttribute($key, $value);
        });
    }

    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);
        return $this;
    }

    public function addClass(...$class)
    {
        $this->classList->add(...$class);
        $this->attributes['class'] = $this->classList->render();
        return $this;
    }

    public function removeClass(...$class)
    {
        $this->classList->remove(...$class);
        $this->attributes['class'] = $this->classList->render();
        return $this;
    }

    public function toggleClass($class, $force)
    {
        $this->classList->toggle($class, $force);
        $this->attributes['class'] = $this->classList->render();
    }

    public function replaceClass($class)
    {
        $this->classList->replace($class);
        $this->attributes['class'] = $this->classList->render();
        return $this;
    }

    public function containsClass($class)
    {
        return $this->classList->contains($class);
    }

    public function isVoidElement()
    {
        return in_array($this->tag, self::VOID_TAGS);
    }

    public function renderChildren()
    {
        return $this->isVoidElement() ? '' : $this->children->render();
    }

    public function renderOpenTag()
    {
        return sprintf("<%s%s>", $this->tag, $this->attributes->render());
    }

    public function renderCloseTag()
    {
        return $this->isVoidElement() ? '' : sprintf("</%s>", $this->tag);
    }

    public function render()
    {
        return sprintf("%s%s%s", $this->renderOpenTag(), $this->renderChildren(), $this->renderCloseTag());
    }

    public function __toString()
    {
        return $this->render();
    }
}
