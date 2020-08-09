<!DOCTYPE html>
<html>
    <head>
        <title>PHP CRUD</title>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <?php 
        
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>    
        </div>
        <?php endif ?>
        <div class="container">
        <?php
            $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            ?>

            <div class="row justify-content-center">
                <table class="table">
                    <thread>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thread>
                <?php
                    while ($row= $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>"
                                    class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>"
                                    class="btn btn-danger">Delete</a> 
                            </td>
                        </tr>
                    <?php endwhile; ?>        
                </table>
            </div>

            <?php 
            function pre_r($array){
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" 
                     value="<?php echo $name; ?>" placeholder="Enter your name">
              </div>
              <div class="form-group">
              <label>Location</label>
              <input type="text" name="location" class="form-control" 
                     value="<?php echo $location; ?>" placeholder="Enter your location">
              </div>
              <div class="form-group">
              <?php 
              if($update==true):
              ?>
              <button type="submit" name="update" class="btn btn-info">Update</button>
              <?php else: ?>
              <button type="submit" name="save" class="btn btn-primary">Save</button>
              <?php endif; ?>
              </div>
        </form>
        </div>
        </div>
    </body>
</html>