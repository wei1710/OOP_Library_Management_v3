<?php

require_once 'LibraryItem.php';

Class Library
{
    private array $items = [];

    public function addItem(LibraryItem $item): void 
    {
        $this->items[] = $item;
    }

    public function getItems(): string
    {
        if (empty($this->items)) {
          return "The library is empty.<br>";
        }

        $output = '';
        foreach ($this->items as $item) {
          $output .= $item->getDetails() . '<br>';
        }
        return $output;
    }
}