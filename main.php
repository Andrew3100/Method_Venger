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

echo '</pre>';
$step1 = ReduxMatrixByRows($cols);
/*Для проведения редукции по столбцам вычисляем массив минимумов по строкам*/
$min_list = (GetMinimalElementListByCols($cols));
$k = (ReduxMatrixByCols($step1,$min_list));

printMatrix($k,'Результат редукции по столбцам');