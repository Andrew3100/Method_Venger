<?php

/*Вычисление матрицы на первом шаге алгоритма, когда решаем задачу на максимум*/
function GetMatrixByStep1($array) {

    $cols = array();
    for ($i=0; $i<count($array); $i++) {

        $MaxOnRow = max($array[$i]); //максимумы в каждой строке
        $rows = array();
        for ($g=0; $g<count($array); $g++) {
            $rows[] = abs($array[$i][$g] - $MaxOnRow);
        }


        $cols[] = $rows;
        unset($rows);
    }
    return $cols;
}