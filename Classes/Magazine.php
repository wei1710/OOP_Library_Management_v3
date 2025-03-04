<?php

require_once 'LibraryItem.php';

Class Magazine extends LibraryItem
{
    private int $issueNumber;
    public string $publisher;

    public function __construct(
        string $title,
        string $author,
        int $publicationYear,
        int $issueNumber,
        string $publisher
    )
    {
        parent::__construct($title, $author, $publicationYear);
        if ($this->validateIssueNumber($issueNumber)) {
            $this->issueNumber = $issueNumber;
        } else {
            throw new Exception('Invalid issue number.');
        }
        $this->publisher = $publisher;
    }

    public function __get(string $property): mixed
    {
        if ($property === 'issueNumber') {
            return $this->issueNumber;
        }

        throw new Exception("Property '$property' does not exist.");
    }

    public function __set(string $property, mixed $value)
    {
        if ($property === 'issueNumber' && !$this->validateIssueNumber($value)) {
            throw new Exception('Invalid issue number.');
        }
        $this->$property = $value;
    }

    private function validateIssueNumber(int $issueNumber): bool
    {
        return $issueNumber > 0;
    }

    public function getDetails(): string
    {
        return 'Magazine: ' . parent::getDetails() . " (Issue {$this->issueNumber}) - Publisher: {$this->publisher}";
    }
}