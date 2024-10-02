<?php
include_once(__DIR__ . '/../../Controllers/PostController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');
include_once(__DIR__ . '/../../Controllers/ReactionController.php');
include(__DIR__ . '/../layouts/header.php');

$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$postController = new PostController($db);
$reactionController = new ReactionController($db);
// $basicOptions = ['commenter', 'reagir'];
$reactions = ['Love', 'Like', 'Haha', 'Grr'];
$VIPoptions = ['supprimer', 'modifier'];


if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['id_pub'])) {
        $post = $postController->getPostById($_POST['id_pub']);
        if ($_SESSION['id_account'] == $post['id_account']) {
            $options = array_merge($reactions, $VIPoptions);
        } else {
            $options = $reactions;
        }
?>
        <link rel="stylesheet" href="/public/assets/css/output.css">
        <div class="flex flex-col items-center justify-center ">
            <div class="  !bg-[#f2f8fc] w-1/2 rounded-md p-2 shadow-2xl ">
                <div class="font-bold text-2xl"><?php echo $post['nom'] . ' ' . $post['prenom']  ?></div>
                <div class="text-4xl !w-2/3"><?php echo $post['content'] ?></div>
                <div class="text-xs">Publié le <?php echo $post['date_heure'] ?> </div>
            </div>
            <div class="flex  gap-5 !bg-[#f4f1f8] shadow-2xl rounded-lg">
                <?php foreach ($options as $option): ?>
                    <form action="<?php if($option=='modifier') echo "update.php" ?>" method="post" class="">
                        <input type="text" name="options" value="<?php echo $option ?>" hidden>
                        <button type="submit" name="id_pub" value="<?php echo $post['id_post'] ?>"><?php echo $option ?></button>
                    </form>
                <?php endforeach ?>
            </div>
            <?php include(__DIR__ . '/../comments/create.php') ?>

        </div>
<?php  }
}
$reactionController = new ReactionController($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['options'])) {
        if(isset($_POST['id_pub'])){
            if ($_POST['options'] == 'supprimer') {
                $postController->deletePost($_POST['id_pub']);
                return ;
            }
            else if($_POST['options'] !=='modifier'){
              
                    $myReact = $reactionController->getAuthorReactionOnPost($_POST['id_pub'],$_SESSION['id_account']);
                
                    if($myReact){
                        if($myReact['react'] == $_POST['options']){
                            $reactionController->unsetReactionOnPost($_POST['id_pub'],$_SESSION['id_account']);
                        }
                        else{
                            $reactionController->updateReactionOnPost($_POST['id_pub'],$_POST['options'],$_SESSION['id_account']);
                        }
                    }
                    else{
                        $reactionController->setReactionOnPost($_POST['options'],$_SESSION['id_account'],$_POST['id_pub']);
                    }
                
            }
        }
        
        

    }
}

?>
            <?php include(__DIR__ . '/../comments/listComments.php') ?> 
