<?php
require_once 'lib.php';
$size = $_POST['let`s_go!'];

    /*Столбцы*/
    $cols = array();
    /*Строки*/
/*Записываем всё в массивы*/
for ($row=1;$row<=$size;$row++) {
        $rows = array();
        for ($col=1;$col<=$size;$col++) {
            $rows[] = ($_POST['A'.$row.$col]);
        }
        $cols[] = $rows;
        unset($rows);
    }
/*В этом двумерном массиве хранится вся матрица*/



/*  Предполагаем, что задача решается на максимум, следовательно,
    в каждой строке матрицы ищем максимальный
    элемент и вычитаем его из каждого элемента ЭТОЙ же строки*/


var_dump($cols = GetMatrixByStep1($cols));
