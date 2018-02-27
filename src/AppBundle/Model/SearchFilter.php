<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class SearchFilter
{
    private $categorySlug;

    private $year;

    /**
     * @Assert\Range(
     *     min = 1,
     *     max = 12,
     *     minMessage = "Month number cannot be less than 1",
     *     maxMessage = "Month number cannot be greater than 12"
     * )
     */
    private $month;

    public function __construct(
        string $categorySlug = null,
        int $year = null,
        int $month = null
    ) {
        $this->categorySlug = $categorySlug;
        $this->year = $year;
        $this->month = $month;
    }

    public function getCategorySlug(): string
    {
        return $this->categorySlug;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function toArray()
    {
        $criteria = [
            'category' => $this->categorySlug,
            'year'     => $this->year,
            'month'    => $this->month,
        ];

        return array_filter(
            $criteria,
            function ($item) {
                return !is_null($item);
            }
        );
    }
}