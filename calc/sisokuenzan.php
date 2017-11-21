<?php
$err='';
$ans='';
if(isset($_POST['figure1'],$_POST['figure2'],$_POST['method'])) {
    $figure1=$_POST['figure1'];
    $figure2=$_POST['figure2'];
    $method=$_POST['method'];
    $comment=$_POST['comment'];


    if (!is_numeric($figure1) || !is_numeric($figure2)) {
        $err='半角数字を入力してください';
    }elseif ($figure1 ==='' or $figure2 === '') {
        $err = '値を入力してください。';
    } else {
        if ($method === '') {
            $err='計算方法を選択してください';
        } elseif ($method === '+') {
            $ans = $figure1 + $figure2;
        } elseif ($method === '-') {
            $ans = $figure1 - $figure2;
        } elseif ($method === '×') {
            $ans = $figure1 * $figure2;
        } else {
            if ($figure2 === '0') {
                $err = '割る数が0です。計算できません。';
            } else {
                $ans = $figure1 / $figure2;
            }
        }
    }

    //計算がうまくいけば　ファイルへ計算履歴の書き込み
    if ($err === '') {
        $file = 'calc.txt';
        $for = $figure1 . $method . $figure2 . '=' . $ans . '  ' . $comment;
        $current = file_get_contents($file);
        $content = $current . $for . '<br>' . "\n";
        file_put_contents($file, $content);
    }
}

//削除ボタンを押した場合　履歴を消す
if(isset($_POST['delete'])){
    $file = 'calc.txt';
    $content = '';
    file_put_contents($file, $content);
}

//エラーの場合　テキストボックスに値を残す
if ($err !== '') {
    $figure3=$figure1;
    $figure4=$figure2;
}
?>
<http>
    <head>
        <title>電卓</title>
    </head>
    <body>
        <form method="POST" >
            <input type="text" name="figure1" value="<?php if(isset($figure3)){echo $figure3;} ?>">
            <select name="method">
                <option value=""></option>
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="×">×</option>
                <option value="÷">÷</option>
            </select>
            <input type="text" name="figure2" value="<?php if(isset($figure4)){echo $figure4;}?>">
            <input type="submit" value="=">
            <?php
            print $err;
            print $ans;
            ?><br>
            コメント：<br>
            <textarea name="comment"></textarea>
        </form><br>

        計算履歴<br>
        <?php
        $file='calc.txt';
        $content=file_get_contents($file);
        print $content;
        ?>
        <form method="POST">
            <input type="submit" name="delete" value="削除">
        </form>
    </body>
</http>