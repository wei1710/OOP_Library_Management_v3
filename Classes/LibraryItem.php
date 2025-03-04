<?php

abstract class LibraryItem
{
    public string $title;
    public string $author;
    protected int $publicationYear;

    public function __construct(
        string $title, 
        string $author, 
        int $publicationYear
    )
    {
        $this->title = $title;
        $this->author = $author;
        if ($this->validateYear($publicationYear)) {
            $this->publicationYear = $publicationYear;
        } else {
            throw new Exception('Invalid publication year.');
        }
    }

    public function __get(string $property): mixed
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        throw new Exception("Property '$property' does not exist.");
    }

    public function __set(string $property, mixed $value)
    {
        if ($property === 'publicationYear' && !$this->validateYear($value)) {
            throw new Exception('Invalid publication year.');
        }
        $this->$property = $value;
    }

    protected function validateYear(int $year): bool
    {
        return $year > 0 && $year <= date('Y');
    }

    abstract public function getDetails(): string;
}