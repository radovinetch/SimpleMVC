<?php


namespace SimpleMvc\http;


use SimpleMvc\exception\SortingException;
use SimpleORM\model\Model;

class Response
{
    /**
     * Сортировка уже полученных значений (вне БД)
     * В данный момент использую сортировку в БД (ORDER BY)
     * @param $array
     * @param $key
     * @param $type
     * @return array
     */
    public function sort($array, $key, $type): array
    {
        uasort($array,
            function ($a, $b) use($key, $type) {
                if (!$a instanceof Model || !$b instanceof Model) {
                    return new SortingException('Cannot sort objects!');
                }

                return $a->getVar($key) > $b->getVar($key) ? ($type == 'asc' ? 1 : -1) : ($type == 'asc' ? -1 : 1);
            }
        );
        return $array;
    }

    /**
     * @param $array
     */
    public function json($array): void
    {
        echo json_encode($array);
    }

    public function redirect($url): void
    {
        header('Location: ' . $url);
    }

    public function back(): void
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}