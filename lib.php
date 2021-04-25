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
    echo '</table><br>';
    return $cols;
}


function ReduxMatrixByCols($arr) {
    $cols = array();
    echo '<br>
        <table class="table_s table-bordered">';
    for ($i=0;$i<count($arr);$i++) {
        echo '<tr>';
        $MinOnCol = min($arr[$i]);


        for ($g=0;$g<count($arr);$g++) {

             echo $cols[] = '<td>'.$arr[$g][$i].'</td>';
        }
        echo '</tr>';
    }
    return $cols;
}

function GetControlOfZero($array) {
    $zero_address = array();


    for ($i=0; $i<count($array); $i++) {
        for ($g=0; $g<count($array); $g++) {
            if ($array[$i][$g]==0) {
                /*Запоминаем адрес нулей*/
               $obj = new stdClass();
               $obj->x = $i;
               $obj->y = $g;
               $zero_address[] = $obj;
            }
        }
    }
    /*Выводим таблицы координат с нулями по Х*/
    echo '<table class="table_s table-bordered">';
    echo '<tr>';
    foreach ($zero_address as $item) {
        echo "<td style='text-align: center'>{$item->x}</td>";
    }
    echo '</tr>';
    echo '</table><br>';

    /*Выводим таблицы координат с нулями по Х*/
    echo '<br><table class="table_s table-bordered">';
    echo '<tr>';
    foreach ($zero_address as $item) {
        echo "<td style='text-align: center'>{$item->y}</td>";
    }
    echo '</tr>';
    echo '</table>';

    for ($i=0; $i<count($array); $i++) {
        for ($g=0; $g<count($array); $g++) {

        }
        for ($g=0; $g<count($array); $g++) {

        }
    }
}


function printMatrix($array,$description) {
    /*Заголовок*/
    echo "<h5 class='header'>$description</h5>";
    echo '
        <table class="table_s table-bordered">';

    for ($i=0; $i<count($array); $i++) {
        echo '<tr>';
        for ($g=0; $g<count($array); $g++) {
            if ($array[$i][$g]==0) {
                $color = 'yellow';
            }
            else {
                $color = 'white';
            }
            echo '<td style="text-align: center; background-color: '.$color.'">'.$array[$i][$g].'</td>';
        }
        echo '</tr>';
    }
    echo '</table><br>';
}