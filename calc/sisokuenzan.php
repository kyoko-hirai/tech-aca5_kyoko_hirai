<?php
$err='';
$ans='';
if(isset($_POST['figure1'],$_POST['figure2'],$_POST['method'])) {
    $figure1=$_POST['figure1'];
    $figure2=$_POST['figure2'];
    $method=$_POST['method'];
    if ($figure1 ==='' or $figure2 === '') {
        $err = '値を入力してください。';
    } else {
        if ($method === '+') {
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
}
if(isset($_POST['delete'])){
    $file = 'calc.txt';
    $content = '';
    file_put_contents($file, $content);
}
//print $_SESSION['figure1'];
//var_dump($err);
?>
<http>
    <head>
        <title>電卓</title>
    </head>
    <body>
        <form method="POST" >
            <input type="text" name="figure1" value="<?php if(isset($figure1)){echo $figure1;} ?>">
            <select name="method">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="×">×</option>
                <option value="÷">÷</option>
            </select>
            <input type="text" name="figure2" value="<?php if(isset($figure2)){echo $figure2;}?>">
            <input type="submit" value="=">
        </form>
        <?php
        print $err;
        print $ans;
        ?>
        <br>

        計算履歴<br>
        <?php
        if ($err==='') {
            $file='calc.txt';
            $for=$figure1.$method.$figure2.'='.$ans;
            $current=file_get_contents($file);
            $content=$current.$for.'<br>'."\n";
            file_put_contents($file, $content);
        }else{
        }
        $file='calc.txt';
        $content=file_get_contents($file);
        print $content;
        ?>
        <form method="POST">
            <input type="button" name="delete" value="削除">
        </form>
    </body>
</http>