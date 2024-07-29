<?php

namespace App\Helpers\Collection;

use IteratorAggregate;

class Collection implements IteratorAggregate
{
    protected $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }


    public function push(...$values)
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }

    public function all()
    {
        return $this->items;
    }

    public function filter(callable $callback)
    {
        $filtered = [];

        foreach ($this->items as $key => $item) {
            if ($callback($item, $key)) {
                $filtered[$key] = $item;
            }
        }

        return new static($filtered);
    }

    public function map(callable $callback)
    {
        $mapped = [];

        foreach ($this->items as $key => $item) {
            $mapped[$key] = $callback($item, $key);
        }

        return new static($mapped);
    }

    public function merge($items)
    {
        if ($items instanceof self) {
            $items = $items->all();
        }

        $merged = array_merge($this->items, $items);

        return new static($merged);
    }

    public function count()
    {
        return count($this->items);
    }

    public function first(callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            if (empty($this->items)) {
                return $default;
            }

            foreach ($this->items as $item) {
                return $item;
            }
        }

        foreach ($this->items as $item) {
            if ($callback($item)) {
                return $item;
            }
        }

        return $default;
    }

    public function values()
    {
        return array_values($this->items);
    }

    public function each(callable $callback)
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }
        return $this;
    }
}
