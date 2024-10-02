<?php
include_once(__DIR__ . '/../../Controllers/CommentController.php');
include_once(__DIR__ . '/../../Controllers/AuthController.php');


$database = new Database();
$db = $database->getConnection();
$authController = new AuthController($db);
$commentController = new CommentController($db);
$reactionController = new ReactionController($db);
$reactions = ['Love', 'Like', 'Haha', 'Grr'];
$VIPoptions = ['supprimer', 'modifier'];


if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['id_pub'])){
      $comments =$commentController->getCommentsForPost($_POST['id_pub']);
      foreach ($comments as $comment){
        if ($_SESSION['id_account'] == $comment['id_account']) {

            $options = array_merge($reactions, $VIPoptions);
      } else {
          $options = $reactions;
      }
      
    
?>
<link rel="stylesheet" href="/public/assets/css/output.css">
<div class="flex flex-col  w-full items-center gap-2 bg-[#fffff0]" >

       <div  class="w-1/2 justify-center p-2 flex flex-col bg-[#f2f8fc] shadow-lg rounded-sm " >
       <div class="font-bold"><?php echo $comment['nom'].' '.$comment['prenom'] ?></div>
        <div><?php echo $comment['content'] ?></div>
       </div>
       <div class="flex  gap-5">
                <?php foreach ($options as $option): ?>
                    <form action="<?php if($option=='modifier') echo "/src/Views/comments/update.php" ?>" method="post" class="">
                        <input type="text" name="optionCom" value="<?php echo $option ?>" hidden>
                        <button type="submit" name="id_coms" value="<?php echo $comment['id_comment'] ?>"><?php echo $option ?></button>
                    </form>
                                    <?php endforeach ?>
            </div>
                <?php }
    }
}
    ?>
     <?php   $reactionController = new ReactionController($db);
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        
                        if (isset($_POST['optionCom'])) {
                            
                            if(isset($_POST['id_coms'])){
                            if ($_POST['optionCom'] == 'supprimer') {
                                $commentController->deleteComment($_POST['id_coms']);
                                header('Location: /src/Views/posts/list.php');
                                exit() ;
                            }
                            else if($_POST['optionCom'] !=='modifier'){
                            
                                    $myReactOncoms = $reactionController->getAuthorReactionOnComs($_POST['id_coms'],$_SESSION['id_account']);
                                
                                    if($myReactOncoms){
                                        if($myReactOncoms['react'] == $_POST['optionCom']){
                                            $reactionController->unsetReactionOnComs($_POST['id_coms'],$_SESSION['id_account']);
                                        }
                                        else{
                                            $reactionController->updateReactionOnComs($_POST['id_coms'],$_POST['optionCom'],$_SESSION['id_account']);
                                        }
                                    }
                                    else{
                                        $reactionController->setReactionOnComs($_POST['optionCom'],$_SESSION['id_account'],$_POST['id_coms']);
                                    }
                                
                            }
                            
                            
                        }
                        }

                    } ?>
</div>
<?php     include(__DIR__.'/../../Helpers/backToHome.php');
 
 ?>