<!DOCTYPE html>
<html>
<head>
    <title>test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
<?
$step = isset($_REQUEST['step']) ? $_REQUEST['step'] : 1;

switch ($step) {
    case 1:
        ?>
        <form action="" method="post">
            Введите размер матрицы <input type="text" name="size" value=""/>
            <input type="hidden" name="step" value="2" />
            <input type="submit" value="Показать матрицу" />
        </form>
        <?
        break;

    case 2:
        if(isset($_REQUEST['size']) && is_numeric($_REQUEST['size'])) {
            $size = (int) $_REQUEST['size'];
            ?>
            <form action="" method="post">
                <table class="table-dark table-bordered">
                    <?
                    for ($i = 0; $i < $size; $i++) {
                        ?><tr><?
                        for ($j = 0; $j < $size; $j++) {
                            ?><td><input type="text" name="mat[<?=$i?>][<?=$j?>]" /></td><?
                        }
                        ?></tr><?
                    }
                    ?>
                </table>
                <input type="hidden" name="step" value="3" />
                <input type="submit" value="Заполнить матрицу" />
            </form>
            <?
        }
        break;

    case 3:
        echo 'Вот заполненная матрица:<br/><pre>';
        print_r($_REQUEST['mat']);
        echo '</pre>';

        break;

}
?>
</body>
</html>