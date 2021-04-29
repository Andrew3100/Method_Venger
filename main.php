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

printMatrix($cols,'Исходная матрица');

printMatrix(matrix_transpose($cols),'Эта же матрица, но транспонированная');


/*Проводим редукцию матрицы по строкам*/
$step1 = ReduxMatrixByRows($cols);

/*Для проведения редукции по столбцам вычисляем массив минимумов по строкам*/
$min_list = (GetMinimalElementListByCols($step1));

/*Проводим редукцию по столбцам, получаем матрицу, из которой будем вычёркивать строки по Венгерскому алгоритму*/
$matrixForCrossOut = ReduxMatrixByCols($step1,$min_list);

/*Создаём вычеркнутую матрицу с созданным чёрным списком элементов*/
$mod_matrix = CrossOutLinesAndCols($matrixForCrossOut);

/*Получаем максимальный элемент оставшегося массива для дальнейшей обработки*/
 $min = min(GetUseElementsArray($mod_matrix));
echo "$min - минимальное значение";
ParseTwoMatrix($mod_matrix,$min,$matrixForCrossOut);
printMatrix($cols,'Исходная матрица');