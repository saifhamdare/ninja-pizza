<?php
include('config/db_connect.php');
//write query for all pizza
$sql='SELECT title,ingredients,id FROM pizzas ORDER BY created_at';
//make query & get Result
$result=mysqli_query($conn,$sql);
//fetch the resulting rows as an aaray
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
//close connection
mysqli_close($conn);
explode(',',$pizzas[0]['ingredients']);

?>


<!DOCTYPE html>
<html>
<?php include('template/header.php');?>

<h4 class="center grey-text">Pizzas</h4>
<div class="container">
    <div class="row">
        <?php foreach($pizzas as $pizza){?>
            <div class="col s6 md3">
      
                <div class="card z-depth-0">
                <img src="images/pizza.svg" class="pizza">
                    <div class="card-conent center">
                    <h6><?php echo htmlspecialchars($pizza['title']);?></h6>
                    <ul>
                    <?php foreach(explode(',',$pizza['ingredients'])as $ing){ ?>
                    <li><?php echo htmlspecialchars($ing); ?></li>
                    <?php } ?>
                    </ul>
                    </div>
                    <div class="card-action right-aglin">
                    <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">more info</a></div>
                    </div>
                </div>
<?php } ?>
</div>
</div>
<?php include('template/footer.php');?>
</html>