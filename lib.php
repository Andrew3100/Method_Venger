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


/*Вычисление матрицы на первом шаге алгоритма, когда решаем задачу на максимум*/
function GetMatrixByStep1($array,$color = '') {

    $cols = array();
    echo '<h5 class="header">Вид матрицы после первого шага</h5>';
    echo '<br>
        <table class="table_s table-bordered">';
    for ($i=0; $i<count($array); $i++) {

        $MaxOnRow = max($array[$i]); //максимумы в каждой строке
        $rows = array();
        echo '<tr>';
        for ($g=0; $g<count($array); $g++) {
            $element = abs($array[$i][$g] - $MaxOnRow);
            if ($element==0) {
                $color = 'yellow';
            }
            else {
                $color = 'white';
            }
            echo '<td style="text-align: center; background-color: '.$color.'">'.$rows[] = $element.'</td>';
        }
        echo '</tr>';
        $cols[] = $rows;
        unset($rows);
    }
    echo '</table><br>';
    return $cols;
}

/*Далее необходимо выбрать нули в матрице. Если ноль выбран по строке, то столбец с этим нулём трогать нельзя*/
/*Эта функция выбирает нули в матрице*/

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
    echo '<pre>';
    //print_r($zero_address);
    echo '</pre>';

    /*Взять каждый элемент строки*/

    /*Объявляем массив лишних пар, заполняем его в цикле*/
    $ExtraPairsArrayX = array();
    $ExtraPairsArrayY = array();
    foreach ($zero_address as $zero_address1) {
        /*Фиксируем первую координату ПО СТРОКЕ*/
         $finder_value = $zero_address1->x;
        /*Бежим по объекту, ищем совпадения по координате Y*/
        foreach ($zero_address as $zero_address2) {

            if ($zero_address2->y == $finder_value) {
                echo "Нашёл пару значений. Значение $zero_address2->y совпадает со значением $finder_value<br>";
                $ExtraPairsArrayX[] = $zero_address2->x;
                $ExtraPairsArrayY[] = $zero_address2->y;
            }
        }
    }
    echo '<pre>';
    //var_dump($ExtraPairsArrayX);
    //var_dump($ExtraPairsArrayY);
    echo '</pre>';
}