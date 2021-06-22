<!-- //database connecion// -->


<?php

 $db = mysqli_connect("localhost", "root", "", "jamalpurtoday");

  if($db){
    // echo "The connection is alright";
  }else{
    echo"Connection is error";

    ob_start();
  }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Ticket</title>

    <link rel="stylesheet" type="text/css" href="css/tyle.css">
  </head>
  <body>
    <center>
      <h1 class="my-5">CRUD Operation in PHP</h1>
    </center>

    <div class="container">
      <div class="row">

        <!-- //form design// -->
        <div class="col-md-6">
          
           <form method="POST">
             
             <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Add a new Category</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="cat_name" placeholder="Category Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Category Descrpion</label>
  <textarea  name ="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>

  <input type="submit" class="btn btn-primary" name="add_cat" value="Add Category">
           </form>

          

           


           <?php

           if(isset($_GET['update_id'])){

            $up=$_GET['update_id'];

            $sql4="SELECT * FROM category WHERE c_id='$up'";
                    $result2=mysqli_query($db,$sql4);

                    while($val = mysqli_fetch_assoc($result2)){
             
                          $name= $val['c_name'];
                          $desc=$val['c_desc'];

           }
            
      
         ?>

      <form method="POST">
             
             <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Add a new Category</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="cat_name" value="<?php echo $name  ?>" placeholder="Category Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Category Descrpion</label>
  <textarea  name ="desc" class="form-control" id="exampleFormControlTextarea1" rows="3">
   <?php echo $desc ?>"
  </textarea>
</div>

  <input type="submit" class="btn btn-primary" name="update_cat" value="add Category">
           </form>

    <?php
}


           ?>







            <?php

    if(isset($_POST['add_cat'])){
         
         $cat_name=$_POST['cat_name'];
         $cat_desc=$_POST['desc'];

         echo $cat_name ." ". $cat_desc;

                             
         $sql= "INSERT INTO category(c_name,c_desc) VALUES ('$cat_name','$cat_desc')";
         
         $result = mysqli_query($db,$sql);

       if($result){

        // echo "value inserted";
       }else{

        echo "error";
       }



}

   
   if(isset($_POST['update_cat'])){
    
         $name=$_POST['cat_name'];
         $desc=$_POST['desc'];

       $sql5="UPDATE category SET c_name='$name', c_desc='$desc' WHERE c_id='$up'";

       $result5=mysqli_query($db,$sql5);

       if($result5){
        header('location:index.php');
       }else{
        echo "error";
       }

   }





   ?>

</div>
        
         


        <div class="col-md-6">
          <table class="table  table-dark table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
     
    </tr>
  </thead>
  <tbody>

   <?php

         
    $sql2 ="SELECT * FROM category";
    $result = mysqli_query($db,$sql2);

     $count=0;

          while($val = mysqli_fetch_assoc($result)){
              $id= $val['c_id'];
             $name= $val['c_name'];
            $desc=$val['c_desc'];
            $count++;
       
        ?>
        
       <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $name; ?></td>
      <td><?php echo $desc; ?></td>
      <td><a href="index.php?update_id=<?php echo $id;?>" class="badge bg-primary"> <span>Edit</span> </a>

      <a href="index.php?delete_id=<?php echo $id;?>" class="badge bg-danger"> 

        <span>Delete</span> 
      </a> 

      </td>
    </tr>
         <?php  
 


         }  



   ?>


    
    
  </tbody>
</table>
        </div>
        
      </div>
      
    </div>
     

             <?php

     if(isset($_GET['delete_id'])){

      $del=$_GET['delete_id'];
     
       
       $sql3 = "DELETE FROM category WHERE c_id='$del'";

        $result=mysqli_query($db,$sql3);

        if($result){

          header('location: index.php');
        }else{

          echo"error";
        }



     }
 


             ?>
  
        






   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    
<?php

ob_end_flush();

?>


  </body>
</html>