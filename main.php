<?php
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
//var_dump($cols);

