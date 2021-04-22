<?php
include 'bootstrap.html';
/*Размер матрицы, введённый пользователем*/
$size = $_POST['matrix_size'];
echo '<h5 class="header">Введите элементы матрицы. Все элементы обязательны к заполнению</h5>';
echo '<br>
<form action="main.php" method="POST">
<table class="table_s bg-dark table-bordered">';

for ($row=1;$row<=$size;$row++) {
    echo '<tr>';
    for ($col=1;$col<=$size;$col++) {
        $rand = rand(1,100);
        echo "<td>
                <input name='A$row$col' value='$rand' placeholder='A$row$col' class='form-control form-control-lg' type='text' required>
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



