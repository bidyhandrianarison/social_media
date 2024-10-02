<?php if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['id_pub'])){
        $id_pub=$_POST['id_pub'];
    }
} ?>
<link rel="stylesheet" href="/public/assets/css/output.css">
   <div class="w-full !bg-[#fffff0] items-center justify-center  flex " >
        <form  class="flex flex-col w-1/2 !h-screen p-5 shadow-2xl border-black  rounded-lg" method="post">
            <div><?php   echo '<span class="font-bold text-md">' .$_SESSION['firstName'].' '.$_SESSION['lastName']  .'</span>' ?></div>
            <textarea class="!outline-none " name="comment" id="" placeholder="Votre commentaire..."  ></textarea>
            <button name='id_pub' value="<?php echo $id_pub ?>" type="submit" class="!bg-blue-600 w-max py-2 px-1  rounded-lg text-md text-[#fcf2f8] shadow-lg">Commenter</button>
        </form>
    </div>
    
    <?php

include_once(__DIR__ . '/../../Controllers/CommentController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');


$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$commentController = new CommentController($db);
if ($_SERVER['REQUEST_METHOD']) {
    if (isset($_POST['comment'])) {
       $commentController->createComment($_POST['id_pub'], $_SESSION['id_account'],$_POST['comment']);
    }
}
?>