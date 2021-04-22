<?php
include 'bootstrap.html';
echo '<h1 class="header">Решение задачи о назначениях</h1>';
echo '<h2 class="instruction">Введите размер матрицы: </h2>';
echo '
<div class="container">
    <div class="row">
        <div class="col">
        <form method="POST" action="get_matrix.php" class="f">
            <input name="matrix_size" class="form-control form-control-lg" placeholder="n" type="text" required>
            <br>
            <button class="btn btn-success">Поехали!</button>
        </form>
            
        </div>
    </div>
</div>
';