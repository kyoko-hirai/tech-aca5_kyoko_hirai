<http>
    <head>
        <title>電卓</title>
    </head>
    <body>
    <form method="POST">
        <input type="text" name="figure1" value="<?php echo $POST['figure1'];?>">
        <select name="method">
            <option value="add">+</option>
            <option value="sub">-</option>
            <option value="mult">×</option>
            <option value="div">÷</option>
        </select>
        <input type="text" name="figure2" value="<?php echo $_POST['figure2'];?>">
        <input type="submit" value="＝">
    </form>

    <?php
    $err=NULL;
    $ans=NULL;
    $figure1=$_POST['figure1'];
    $figure2=$_POST['figure2'];
    $method=$_POST['method'];

    if(isset($figure1)) {
        if ($figure1 ==='' or $figure2 === '') {
            $err = '値を入力してください。';
        } else {
            if ($method === 'add') {
                $ans = $figure1 + $figure2;
            } elseif ($method === 'sub') {
                $ans = $figure1 - $figure2;
            } elseif ($method === 'mult') {
                $ans = $figure1 * $figure2;
            } else {
                if ($figure2 === '0') {
                    $err = '割る数が0です。計算できません。';
                } else {
                    $ans = $figure1 / $figure2;
                }
            }
        }
    }

    print_r($_POST);
    print $err;
    print $ans;
    ?>
    </body>
</http>