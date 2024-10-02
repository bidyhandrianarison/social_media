<?php
// session_start();
// include('../../config/database.php');
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['id_pub'])) {
?>
        <!-- <link rel="stylesheet" href="../../output.css">
        <form method="post">
            <input type="hidden" name="id_post" value="<?php //echo $_POST['id_pub']; ?>">
            <button type="submit" class="w-max !rounded-xl font-bold !bg-green-200" name="reaction" value="like">Like</button>
            <button type="submit" class="w-max !rounded-xl font-bold !bg-red-500" name="reaction" value="love">Love</button>
            <button type="submit" class="w-max !rounded-xl font-bold !bg-yellow-400" name="reaction" value="haha">Haha</button>
            <?php 
            // $sql = 'SELECT * FROM react_post WHERE (id_post = ? AND react IS NOT NULL AND id_account = ? )';
            // $result = $conn->prepare($sql);
            // $result->execute([$_POST['id_pub'], $_SESSION['id_account']]);
            // $data = $result->fetch(PDO::FETCH_ASSOC);
            // if ($data) { 
            ?>
               <form action="" method="post">
                    <button type="submit" name="reaction" value="unreact">Unreact</button>
                </form> -->
            <!-- <?php 
            //}

            ?>

        </form> -->
<?php
//     }
// }
// if (isset($_POST['id_post'])) {
//     if ($_POST['reaction'] == 'unreact') {
//         $sql = 'DELETE FROM react_post WHERE id_post= ?';
//         $result = $conn->prepare($sql);
//         $result->execute([$_POST['id_post']]);
//     } else {
//         $sql = 'SELECT * FROM react_post WHERE (id_post = ? AND id_account = ?)';
//         $result = $conn->prepare($sql);
//         $result->execute([$_POST['id_post'], $_SESSION['id_account']]);
//         $data = $result->fetch(PDO::FETCH_ASSOC);
//         if (!$data) {
//             $sql = 'INSERT INTO react_post(react, id_post, id_account) VALUES(?, ?, ?)';
//             $result = $conn->prepare($sql);
//             $result->execute([$_POST['reaction'], $_POST['id_post'], $_SESSION['id_account']]);
//         } else {
//             if ($_POST['reaction'] == $data['react']) {
//                 $sql = 'DELETE FROM react_post WHERE id_post= ?';
//                 $result = $conn->prepare($sql);
//                 $result->execute([$_POST['id_post']]);
//             }
//             else{
//                 $sql = 'UPDATE react_post SET react = ? WHERE (id_post = ? AND id_account = ?)';
//                 $result = $conn->prepare($sql);
//                 $result->execute([$_POST['reaction'],$_POST['id_post'], $_SESSION['id_account']]);
//             }
//         }
//     }

//     header('Location: ../Views/layouts/index.php');
// }
?>
<?php
class Reaction{
    protected $conn;
    private $table_name;
    private $id;

    public function __construct($db,$table,$idTable){
        $this->conn = $db;
        $this->table_name=$table;
        $this->id=$idTable;
    }
    public function reactTo($typeOfReact, $idCard, $idReacter ){
        $sql = 'INSERT INTO '.$this->table_name. '(react,'. $this->id .', id_account) VALUES(?, ?, ?)';
        $result = $this->conn->prepare($sql);
        $result->execute([$typeOfReact, $idCard, $idReacter]);
    }
    public function unreact($idCard,$id_author){
        $sql='DELETE FROM '.$this->table_name.' WHERE (' .$this->id.'= ? AND id_account = ?)';
        $result=$this->conn->prepare($sql);
        $result->execute([$idCard,$id_author]);
    }
    public function getReact($idCard,$id_author){
        $sql= 'SELECT * FROM '.$this->table_name.' WHERE ('.$this->id.' = ? AND id_account = ?)';
        $result = $this->conn->prepare($sql);
        $result->execute([$idCard,$id_author]);
        $data=$result->fetch();
        return $data;
    }
    public function updateReact($idCard,$react,$idReacter){
        $sql='UPDATE '.$this->table_name.' SET react = ? WHERE ('.$this->id.'= ? AND id_account = ? )';
        $result=$this->conn->prepare($sql);
        $result->execute([$react, $idCard, $idReacter]);

    }   
    
}
?>