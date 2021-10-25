<?php

namespace SimpleMvc;

use SimpleORM\model\Model;

class Pagination
{
    /**
     * @var array
     */
    private array $array = [];

    /**
     * @var int
     */
    private int $perPage;

    /**
     * @var int
     */
    private int $currentPage;

    /**
     * @var int
     */
    private int $countOfPages;

    /**
     * @param Model $class
     * @param int $perPage
     * @param int $currentPage
     * @param array $order
     * @return Pagination
     */
    public static function get(string $class, int $perPage = 3, int $currentPage = 1, $order = []): Pagination
    {
        $builder = $class::getQueryBuilder();
        $builder->select();

        if (!empty($order)) {
            $builder->orderBy($order);
        }

        $builder->limit($perPage)->offset(($currentPage - 1) * $perPage);
        $model = $class::useBuilder($builder);

        $static = new static();
        $get = $model->get();
        if (!is_array($get)) {
            $get = [$get];
        }
        $static->setArray($get);
        $static->setPerPage($perPage);
        $static->setCurrentPage($currentPage);
        $static->setCountOfPages($class::countAll());
        return $static;
    }

    /**
     * @param array $array
     */
    public function setArray(array $array): void
    {
        $this->array = $array;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getCountOfPages(): int
    {
        return $this->countOfPages;
    }

    /**
     * @param int $countOfPages
     */
    public function setCountOfPages(int $countOfPages): void
    {
        $this->countOfPages = $countOfPages;
    }
}