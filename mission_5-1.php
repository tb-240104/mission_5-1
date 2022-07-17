<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント">
        <input type="number" name="delnum" placeholder="削除対象番号">
        <input type="number" name="editnum" placeholder="編集対象番号">
        <input type="text" name="pass" placeholder="パスワード">
        <input type="submit" name="submit">
        <input type="submit" name="delete" value="削除">
        <input type="submit" name="edit" value="編集">
    </form>
    <?php
        $dsn = 'データベース名';
        $user = 'ユーザ名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = "CREATE TABLE IF NOT EXISTS mission5_1(id INT AUTO_INCREMENT PRIMARY KEY,name char(32),comment TEXT)";
        $name=filter_input(INPUT_POST,"name");
        $comment=filter_input(INPUT_POST,"comment");
        $pass=filter_input(INPUT_POST,"pass");
        $delnum=filter_input(INPUT_POST,"delnum");
        $editnum=filter_input(INPUT_POST,"editnum");
        $date = date("Y/m/d H:i:s");
        if (isset($_POST['submit']) && !empty($name && $comment && $pass)){
            $sql = $pdo -> prepare("INSERT INTO mission5_1 (name,comment) VALUES (:name,:comment)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $pass=$_POST["pass"];
            $sql->execute();
                if($pass=$password){
                $sql = 'SELECT * FROM mission5_1';
                $stmt = $pdo->query($sql);
                $results=$stmt->fetchAll();
                foreach ($results as $row){
                    echo $row['id'].',';
                    echo $row['name'].',';
                    echo $row['comment'].'<br>';
                echo "<hr>";
                }
            }else{
            }
        }elseif(isset($_POST['delete']) && !empty($delnum && $pass)){
            $delnum=$_POST["delnum"];
            $pass=$_POST["pass"];
            $id=$delnum;
            $sql = 'delete from mission5_1 where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if($pass=$password){
                $sql = 'SELECT * FROM mission5_1';
                $stmt = $pdo->query($sql);
                $results=$stmt->fetchAll();
                foreach ($results as $row){
                    echo $row['id'].',';
                    echo $row['name'].',';
                    echo $row['comment'].'<br>';
                echo "<hr>";
                }
            }else{
            }
        }elseif(isset($_POST['edit']) && !empty($editnum && $name && $comment && $pass)){
            $editnum=$_POST["editnum"];
            $pass=$_POST["pass"];
            $id = $editnum;
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $sql = 'UPDATE mission5_1 SET name=:name,comment=:comment WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if($pass=$password){
                $sql = 'SELECT * FROM mission5_1';
                $stmt = $pdo->query($sql);
                $results=$stmt->fetchAll();
                foreach ($results as $row){
                    echo $row['id'].',';
                    echo $row['name'].',';
                    echo $row['comment'].'<br>';
                echo "<hr>";
                }
            }else{
            }
        }else{
            $sql = 'SELECT * FROM mission5_1';
            $stmt = $pdo->query($sql);
            $results=$stmt->fetchAll();
            foreach ($results as $row){
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].'<br>';
            }
            echo "<hr>";
        }
    ?>
</body>
</html>