<link rel="stylesheet" href="/public/assets/css/output.css">
   <div class="w-full h-max p-2 flex justify-center">
        <form method="post" >
            <button name='back' value='back' class=" font-bold" type="submit">Retour</button>
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