<?php
require_once 'lib.php';
include 'bootstrap.html';


echo '<h5 class="header">Введите элементы матрицы. Все элементы обязательны к заполнению</h5>';
/*Получаем квадратную матрицу указанной размерности. Размер получаем постом из формы в файле index.php*/
GetUserMatrixByForm();


