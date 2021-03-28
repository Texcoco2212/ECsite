<?php
$param = array('','','','');
$file = '13TOKYO.csv';
if(file_exists($file)){
    $spl = new SplFileObject($file);
    while (!$spl->eof()) {
        $columns = $spl->fgetcsv();
        if(isset($columns[2]) && $columns[2] == "1360072"){
            $kencode = substr($columns[0],0,2);
            $ttext = str_replace('以下に掲載がない場合','',$columns[8]);
            $param = array($kencode,$columns[6], $columns[7],$ttext);
            break;
        }
    }
}
// var_dump($param);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ご購入 | Italian Shop</title>
<link rel="stylesheet" href="shop.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<h1>ご購入</h1>
<div class="base">
  <?php if ($error) echo "<span class=\"error\">$error</span>" ?>
  <form action="buy.php" method="post">
    <p>
      お名前<br>
      <input type="text" name="name" value="<?php echo $name ?>">
    </p>
    <p>
      ご住所<br>
      <input type="text" name="address" size="60" value="<?php echo $address ?>">
    </p>
    <p>
      電話番号<br>
      <input type="text" name="tel" value="<?php echo $tel ?>">
    </p>
    <p>
      <input type="submit" name="submit" value="購入">
    </p>
  </form>
​
        <p>IDを入力 : <input type="text" id="main" /><button id="send">送信</button></p>
        <div id="return"></div>
        <script src="./main.js"></script>
​
        <div id="admbox">
        <form>
        <dl>
        <dt>郵便番号</dt>
        <dd><input type="text" name="adcode" value="" placeholder="例）9876543" maxlength="8"></dd>
        </dl>
        <div class="errmg_box"></div><!-- errmg_box -->
        <dl>
        <dt>住所</dt>
        <dd>
        <select name="adselect">
            <option value="">お選びください</option>
            <option value="11">埼玉県</option>
            <option value="12">千葉県</option>
            <option value="13">東京都</option>
            <option value="14">神奈川県</option>
        </select>
        </dd>
        </dl>
        <dl>
        <dt>市区町村</dt>
        <dd><input type="text" name="adtext" value="" placeholder="例）●●市××区●1-2-3"></dd>
        </dl>
        </form>
        </div>
​
</div>
<div class="base">
  <a href="index.php">お買い物に戻る</a>　
  <a href="cart.php">カートに戻る</a>
</div>
</body>
</html>
​
<script>
$(function(){
​
    //郵便番号
    var zipcode ;
​
    //郵便番号検索ajax
    function postajax(){
        $('#admbox dl:nth-of-type(1)').append('<div id="loading"></div>');
        $.ajax({
            type:"POST",
            url:"cheack1.php",
            data: JSON.stringify(zipcode),
            crossDomain: false,
            dataType : "jsonp",
            scriptCharset: 'utf-8'
        }).done(function(data){
            if(data[0]==""){
                console.log(data[0]);
                $('.errmg_box').text('見つかりませんでした。');
                $('input[name="adtext"]').val('');
                $("#loading").remove();
            }else{
                $('.errmg_box').text('');
                $('select[name="adselect"]').val(data[0]);
                $('input[name="adtext"]').val(data[2]+data[3]);
            }
        }).always(function(data){
            $("#loading").remove();
        });
    }
​
    //郵便番号チェック
    $("input[name='adcode']").blur(function(){
        zipcode = $('input[name="adcode"]').val() ;
        var zipcodecount = zipcode.length ;
        if(zipcodecount<6){
            $('.errmg_box').text('文字数が足りません。');
            $('#loading').remove();
            return;
        }
            postajax();
    });
​
});
</script>
