<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>新規登録</title>
    </head>
    <body>
        <h1>新規登録</h1>
        <form action="../controllers/user.php?mode=insert" method="post">
            <table>
                <tr>
                    <th>お名前</th>
                    <td>
                        <input type="text" name="name"><span><?php if (isset($userInfoErrors['name'])) { echo $userInfoErrors['name']; } ?></span>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        <input type="text" name="tel" ><span><?php if (isset($userInfoErrors['tel'])) { echo $userInfoErrors['tel']; } ?></span>
                    </td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td>
                        <input type="text" name="postal_code">
                    </td>
                </tr>
                <tr>
                    <th>都道府県</th>
                    <td>
                        <input type="text" name="prefectures">
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <input type="text" name="address">
                    </td>
                </tr>
            </table>
            <button type="submit" name="submit">登録</button>
        </form>
    </body>
</html>
