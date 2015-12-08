<?php

/**
 * Матрица смежности
 *
 * @param array $poi   -  Массив точек с координатами
 * @param int   $count -  Кол-во POI для матрицы
 *
 * @return mixed
 * @internal param bool|int $count_poi
 */
function matrix($poi, $count = 21)
{
    for ($i = 0; $count >= $i; $i++) {

        if (array_key_exists($i, $poi)) {
            $matrix[ $i ] = []; // будущий массив
            for ($v = 0; $count >= $v; $v++) {
                // Сравниваем id poi, есть true, то задаем 0
                if ($poi[ $i ]['id'] == $poi[ $v ]['id']) {
                    $matrix[ $i ][ $v ] = 0;
                } else {
                    // Получаем радиант
                    $sqrt = rad($poi[ $i ]['coordinates'], $poi[ $v ]['coordinates']);
                    // Если радиант равен нулю, значит это первый граф
                    if ($sqrt == 0) {
                        $matrix[ $i ][ $v ] = 0;
                    } else {
                        $matrix[ $i ][ $v ] = round($sqrt, 10);
                    }
                }
            }
        }
        // Добавляем в массив максимальное значение в горизонтальной плоскости
        // полученное методом сложения array_sum
        if (isset($matrix[ $i ])) {
            $matrix[ $i ]['max'] = array_sum($matrix[ $i ]);
        }

    } // end for

    return $matrix;
}


/**
 * Вычисляем коэфицент растояния между двумя точками
 *
 * @param $cdr1
 * @param $cdr2
 *
 * @return float
 *
 * @see matrix
 */
function rad($cdr1, $cdr2)
{
    $cdr1 = explode(',', $cdr1);
    $cdr2 = explode(',', $cdr2);
    $sqrt = sqrt(pow(($cdr1[0] - $cdr2[0]), 2) + pow(($cdr1[1] - $cdr2[1]), 2));

    return $sqrt;
}
