<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ユーザー情報変更</title>
    </head>
    <body>
        <h1>ユーザー情報変更</h1>
        <form action="../controllers/user.php?mode=update&user_id=<?php echo $userInfo['id']; ?>" method="post">
            <table>
                <tr>
                    <th>お名前</th>
                    <td>
                        <input type="text" name="name" value="<?php echo $userInfo['name']; ?>"><span><?php if (isset($userInfoErrors['name'])) { echo $userInfoErrors['name']; } ?></span>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        <input type="text" name="tel" value="<?php echo $userInfo['tel']; ?>"><span><?php if (isset($userInfoErrors['tel'])) { echo $userInfoErrors['tel']; } ?></span>
                    </td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td>
                        <input type="text" name="postal_code" value="<?php echo $userInfo['postal_code']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>都道府県</th>
                    <td>
                        <input type="text" name="prefectures" value="<?php echo $userInfo['prefectures']; ?>">
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <input type="text" name="address" value="<?php echo $userInfo['address']; ?>">
                    </td>
                </tr>
            </table>
            <button type="submit" name="submit">更新する</button>
        </form>
    </body>
</html>
