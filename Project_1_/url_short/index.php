//connection to the file that contains the database connection setup.
<?php require "config.php"; ?>
<?php 
//retireve data from database 
//Here, a SQL query (SELECT * FROM urls) fetches all records from the urls table.
    $select = $conn->query('SELECT * FROM urls');
    $select->execute();
//fetchAll(PDO::FETCH_OBJ) retrieves the results as an array of objects, each representing a row in the urls table.
    $rows = $select->fetchAll(PDO::FETCH_OBJ);


    if(isset($_POST['submit'])){
        //If the URL input ($_POST['url']) is empty, it shows a message prompting the user to enter a URL.
        if($_POST['url']== ''){
            echo "imput empty ,Please enter the URL.";
        }else{
            //If a URL is entered, the code prepares an SQL INSERT statement to add the URL into the database.
            $url = $_POST['url'];
            $insert = $conn->prepare("INSERT INTO urls (url) VALUES (:url)");
           //execute(['url' => $url]) binds the value to :url to prevent SQL injection and adds it to the database.
            $insert->execute([
                'url' => $url
            ]);
         }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {overflow: hidden;}
            
            .margin {
                margin-top: 200px
            }
        </style>
    </head>
    <body>
       
        <div class="conatiner">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form class="card p-2 margin"  method="POST"  action="index.php">


                        <div class="input-group">
                        <input type="text" name='url' class="form-control" placeholder="your url">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-success">Shorten</button>
                        </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>

        <div class="conatiner" id='refresh'>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                            <th scope="col">Long_url</th>
                            <th scope="col">Short_url</th>
                            <th scope="col">Clicks</th>
            
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $row) : ?>
                            <tr>
                            <th scope="row"><?php echo $row->url; ?></th>
                            <td><a href="http://localhost/url_shortner/u/index.php?id=<?php echo $row->id; ?>" target="_blank">http://localhost/url_shortner/u/index.php?id=<?php echo $row->id; ?><a></td>
                            <td><?php echo $row->clicks; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                 </div>
             </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
        <!-- Core theme JS-->
         <script>
         $(document).ready(function() {

            $("#refresh").click(function(){

                setInterval(function() {
                     $("body").load('index.php')
                },5000);

            });

         });

         </script>
    </body>
</html>