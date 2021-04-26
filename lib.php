<?php
require_once 'bootstrap.html';
function getFieldForMatrix() {
    echo '<br>
<form action="main.php" method="POST">
<table class="table_s table-bordered">';
    /*Размер матрицы, введённый пользователем*/
    $size = $_POST['matrix_size'];
    for ($row=1;$row<=$size;$row++) {
        echo '<tr>';
        for ($col=1;$col<=$size;$col++) {
            $rand = rand(1,100);
            echo "<td>
                <input name='A$row$col' value='$rand' placeholder='A$row$col' class='table_td form-control form-control-lg' type='text' required>
              </td>";
        }
        echo '</tr>';
    }
    echo '</table><br>';

    echo '<div class="container">
        <div class="row">
            <div class="col text-center"><button class="btn btn-success">Поехали!</button></div>
        </div>
      </div>';
    /*Передаём размер матрицы в скрытой форме для дальнейшей работы скрипта*/
    echo '<input name= "let`s_go!" type="hidden" value="'.$size.'"></form>';

}


function GetUserMatrixByForm() {
    echo '<br>
<form action="main.php" method="POST">
<table class="table_s table-bordered">';
    /*Размер матрицы, введённый пользователем*/
    $size = $_POST['matrix_size'];
    for ($row=1;$row<=$size;$row++) {
        echo '<tr>';
        for ($col=1;$col<=$size;$col++) {
            $rand = '';
            /*можно раскомментировать если лень заполнять матрицу при тестировании программы*/
            $rand = rand(1,1000);
            echo "<td>
                <input name='A$row$col' value='$rand' placeholder='A$row$col' class='table_td form-control form-control-lg' type='text' required>
              </td>";
        }
        echo '</tr>';
    }
    echo '</table><br>';

    echo '<div class="container">
        <div class="row">
            <div class="col text-center"><button class="btn btn-success">Поехали!</button></div>
        </div>
      </div>';
    /*Передаём размер матрицы в скрытой форме для дальнейшей работы скрипта*/
    echo '<input name= "let`s_go!" type="hidden" value="'.$size.'"></form>';

}


/*Вычисление матрицы на первом шаге алгоритма, когда решаем задачу на максимум*/
function ReduxMatrixByRows($array) {
    $cols = array();
    for ($i=0; $i<count($array); $i++) {
        $MinOnRow = min($array[$i]); //максимумы в каждой строке
        $rows = array();
        for ($g=0; $g<count($array); $g++) {
            $element = abs($array[$i][$g] - $MinOnRow);
            $rows[] = $element;
        }
        $cols[] = $rows;
        unset($rows);
    }
    printMatrix($cols,'Шаг 1. Редукция матрицы по строкам');
    return $cols;
}

function ReduxMatrixByCols($array,$min_list) {

    for ($i = 0; $i < count($array); $i++) {
        for ($g = 0; $g < count($array); $g++) {
            $values[] = abs($array[$g][$i] - $min_list[$i]);
        }
        $cols[] = $values;
        unset($values);
    }
    printMatrix(($cols),'Шаг 2. Редукция матрицы по столбцам');
    return $cols;
}

function printMatrix($array,$description) {
    /*Заголовок*/
    echo "<h5 class='header'>$description</h5>";
    echo '<table class="table_s table-bordered">';
    for ($i=0; $i<count($array); $i++) {
        echo '<tr>';
        for ($g=0; $g<count($array); $g++) {
            if ($array[$i][$g]==0) {
                $color = 'yellow';
                $tag = '<b>';
                $tag_close = '</b>';
            }
            else {
                $color = 'white';
                $tag = '';
                $tag_close = '';
            }
            echo '<td style="text-align: center; background-color: '.$color.'">'.$tag.''.$array[$i][$g].''.$tag_close.'</td>';
        }
        echo '</tr>';
    }
    echo '</table><br>';
}

function matrix_transpose($array) {
    return $trans = array_map(null, ...$array);
    //var_dump($trans);
}

function pre($object) {
    echo '<pre>';
    var_dump($object);
    echo '</pre>';
}

function GetMinimalElementListByCols($array) {
    $array = matrix_transpose($array);
    for ($i = 0; $i < count($array); $i++) {
        $min_list[] = min($array[$i]);
    }
    return $min_list;
}


function CrossOutLinesAndCols($array) {

    printMatrix($array,'Поиск вычёркиваемых строк и столбцов');
    /*Формируем массивы столбцов*/


    for ($i = 0; $i < count($array); $i++) {
        for ($g = 0; $g < count($array); $g++) {
            /*Работаем только с нулями*/
            if ($array[$i][$g]==0) {
                /*Создаём объект, в котором храним адрес нуля, количество нулей по столбцу и строке этого адреса*/
                $BlackList = new stdClass();
                $BlackList->row_addr = $i;
                $BlackList->col_addr = $g;
                $BlackList->zero_on_row = array_count_values($array[$i])[0];
                $array = matrix_transpose($array);
                $BlackList->zero_on_col = array_count_values($array[$g])[0];
                $data[] = $BlackList;
                unset($BlackList);
                $array = matrix_transpose($array);
            }

        }
    }
    //pre($data);

    for ($k=0; $k < count($data); $k++) {

        $CrossOut = new stdClass();
        if ($data[$k]->zero_on_row >= $data[$k]->zero_on_col) {
            $fixed[] = $data[$k]->row_addr.', row';
            $CrossOut->row = $data[$k]->row_addr;
        }

            else {
                $fixed[] = $data[$k]->col_addr.', col';
                $CrossOut->col = $data[$k]->col_addr;
            }
            $cross_list[] = $CrossOut;
            unset($CrossOut);
        }

    /*Получили уникальный массив т*/
    $fixed = (array_values(array_unique($fixed)));
    ($fixed = (implode(', ',$fixed)));
    ($fixed = explode(', ',$fixed));

    for ($i = 0; $i < count($fixed); $i = $i+2) {
        $BlackList = new stdClass();
        if ($fixed[$i+1] == 'row') {
            $BlackList->row = $fixed[$i];
        }
        if ($fixed[$i+1] == 'col') {
            $BlackList->col = $fixed[$i];
        }
        $BL[] = $BlackList;
    }
    /*Вот тут наша цель - массив объектов, указывающих номер строки или столбца*/
    pre($BL);

}