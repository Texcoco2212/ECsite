<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ユーザー情報確認</title>
    </head>
    <body>
        <h1>ユーザー情報確認</h1>
        <table>
            <tr>
                <th>お名前</th>
                <td><?php echo $userInfo['name']; ?></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td><?php echo $userInfo['tel']; ?></td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td><?php echo $userInfo['postal_code']; ?></td>
            </tr>
            <tr>
                <th>都道府県</th>
                <td><?php echo $userInfo['prefectures']; ?></td>
            </tr>
            <tr>
                <th>住所</th>
                <td><?php echo $userInfo['address']; ?></td>
            </tr>
        </table>
        <input type="button" value="編集画面に移動" onClick="location.href='../controllers/user.php?mode=edit&user_id=<?php echo $userInfo['id']; ?>'">
    </body>
</html>
