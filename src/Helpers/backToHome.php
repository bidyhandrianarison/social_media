<link rel="stylesheet" href="/public/assets/css/output.css">
   <div class="w-max h-max p-2">
        <form method="post" >
            <button name='back' value='back' class="!bg-green-200 font-bold" type="submit">Retour</button>
        </form>
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
      if(isset($_POST['back'])){
       
        header('Location: /src/Views/posts/list.php');
        exit();
       }
      
    }
    ?>