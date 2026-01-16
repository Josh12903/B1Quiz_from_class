<?php
session_start();

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

Class DB {
    private $dsn = "mysql:host=localhost;dbname=db1225;charset=utf8";
    private $table;
    private $pdo;

    public function __construct($table){
        $this->table = $table;
        // 加入 PDO::ATTR_ERRMODE 確保 SQL 錯誤會噴出 Exception
        $this->pdo=new PDO($this->dsn,'root','');
        // , [
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        // ];
    }

    public function all(...$arg){
        $sql = "SELECT * FROM `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->arrayToSql($arg[0]);
                $sql .= " WHERE " . implode(" && ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find($id){
        $sql = "SELECT * FROM `$this->table` ";
        if(is_array($id)){
            $tmp = $this->arrayToSql($id);
            $sql .= " WHERE " . implode(" && ", $tmp);
        } else {
            $sql .= " WHERE `id`='$id' ";
        }
        return $this->pdo->query($sql)->fetch();
    }

    public function save($array){
        if(isset($array['id'])){
            return $this->update($array);
        } else {
            return $this->insert($array);
        }
    }

    public function count(...$arg){
        $sql = "SELECT COUNT(*) FROM `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp = $this->arrayToSql($arg[0]);
                $sql .= " WHERE " . implode(" && ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function update($array){
        $sql = "UPDATE `$this->table` SET ";
        $id = $array['id'];
        unset($array['id']); // 更新時 ID 不放在 SET 區塊
        $tmp = $this->arrayToSql($array);
        $sql .= implode(", ", $tmp);
        $sql .= " WHERE `id`='$id'";
        return $this->pdo->exec($sql);
    }

    function insert($array){
        $sql="INSERT INTO `{$this->table}` ";
        $keys=array_keys($array);
        $sql .="(`". join("`,`",$keys). "`)";
        $sql .=" VALUES ('". join("','",$array). "')";
        // echo $sql;
        //echo "<hr>";
        return $this->pdo->exec($sql);

    }

    public function del($id){
        $sql = "DELETE FROM `$this->table` ";
        if(is_array($id)){
            $tmp = $this->arrayToSql($id);
            $sql .= " WHERE " . implode(" && ", $tmp);
        } else {
            $sql .= " WHERE `id`='$id' ";
        }
        return $this->pdo->exec($sql);
    }

    private function arrayToSql($array){
        $tmp = [];
        foreach($array as $key => $value){
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }
}

function q($sql){
    $dsn = "mysql:host=localhost;dbname=db1225;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url){
    header("location:".$url);
}

// 實例化各個資料表物件
$Title  = new DB('title');
$Ad     = new DB('ad');
$Mvim   = new DB('mvim');
$News   = new DB('news');
$Image  = new DB('image');
$Admin  = new DB('admin');
$Menu   = new DB('menu');
$Total  = new DB('total');
$Bottom = new DB('bottom');

// 訪客計數邏輯
if(!isset($_SESSION['view'])){
    $_SESSION['view'] = 1;
    $total = $Total->find(1);
    $total['total']++;
    $Total->save($total);
}
?>