<?php
require '../common.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:dbname=shop;host=localhost;port=8889", "root", "root");
    }

    // 一旦返り値の型指定だけ、メソッドコメントも目的を持ってかけるように
    public function getInfo($userId): array
    {
        // この辺のくだりはprivateにきれる
        $sql = 'SELECT * FROM users WHERE id = :id AND is_deleted = 0';
        $prepare = $this->pdo->prepare($sql);
        $prepare->bindValue(':id', $userId, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }

    public function updateInfo($id, $info): bool
    {
        try {
            $sql ='
UPDATE users
SET name = :name, tel = :tel, postal_code = :postal_code, prefectures = :prefectures, address = :address
WHERE id = :id';
            $prepare = $this->pdo->prepare($sql);
            $result = $prepare->execute([
                ':name' => $info['name'],
                ':tel' => $info['tel'],
                ':postal_code' => $info['postal_code'],
                ':prefectures' => $info['prefectures'],
                ':address' => $info['address'],
                ':id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        }
        return $result;
    }

    public function insertInfo($info){
        try {
            $sql ='
INSERT INTO users
SET name = :name, tel = :tel, postal_code = :postal_code, prefectures = :prefectures, address = :address;';

            $prepare = $this->pdo->prepare($sql);
            $result = $prepare->execute([
                ':name' => $info['name'],
                ':tel' => $info['tel'],
                ':postal_code' => $info['postal_code'],
                ':prefectures' => $info['prefectures'],
                ':address' => $info['address'],
            ]);
        } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        }
        return $this->pdo->lastInsertId();
    }


    public function infoErrors($userInfo): array
    {
        $errors = [];
        if (!isset($userInfo['name'])) {
            $errors['name'] = '名前は必須項目です。';
        }

        if (!is_numeric($userInfo['tel'])) {
            $errors['tel'] = '電話番号は数字で入力してください。';
        }

        // めんどうだったので2つだけ作った

        return $errors;
    }
}
