<?php


namespace SimpleMvc;


use SimpleMvc\http\Request;

class Validator
{
    /**
     * Простенький валидатор, важно понимать что валидация по хорошему должна быть на JS
     *
     * Return empty array if no validation errors or array with errors
     * @param Request $request
     * @param array $validate
     * @return array
     */
    public static function validate(Request $request, array $validate): array
    {
        $all = array_merge($request->getAll(), $request->postAll());
        $errors = [];
        foreach ($all as $key => $value) {
            $validatorString = $validate[$key] ?? null;
            if ($validatorString !== null) {
                $parse = explode('|', $validatorString);
                foreach ($parse as $validatorItem) {
                    switch ($validatorItem) {
                        case 'required':
                            if ($key === null) {
                                $errors[] = 'Параметр ' . $key . ' обязательный для заполнения!';
                            }
                            break;

                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $errors[] = 'Параметр ' . $key . ' должен быть электронной почтой!';
                            }
                            break;

                        default:
                            if (preg_match_all('#^(?P<type>min|max)?\:(?P<length>\d+)$#', $validatorItem, $matches) != 0) {
                                $type = array_shift($matches['type']);
                                $length = array_shift($matches['length']);
                                if ($type == 'min' && strlen($value) < $length) {
                                    $errors[] = "Параметр " . $key . ' минимальная длина ' . $length;
                                }

                                if ($type == 'max' && strlen($validatorItem) > $length) {
                                    $errors[] = "Параметр " . $key . " максимальная длина " . $length;
                                }
                            }
                    }
                }
            }
        }

        return $errors;
    }
}