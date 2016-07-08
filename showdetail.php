<?php
    $query = "SELECT content.c_id, content.c_title, content.c_text, content.c_image, LKS.l_date
                FROM content
                LEFT JOIN (SELECT * FROM likes WHERE u_id = '$u_id') LKS
                ON content.c_id=LKS.c_id
                ORDER BY content.c_id DESC";
        if ($stmt = $mysqli->prepare($query)) {  
            $stmt->execute();
            $stmt->bind_result($c_id, $title, $text, $image, $l_date);
            $NowTime=$udate;
            if (!$stmt->fetch()) {
                echo "<p>no recently posts</p>";
            } else {  
                ?>

                <div class = "container-fluid imgcontainer"> 
                    <img src="<?php echo($image)?>">
                    <h1><a href="content-<?php echo($c_id); ?>" data-postId="<?php echo($c_id); ?>" ><?php echo($title)?></a></h1>
                    <p><?php echo($text)?></p>
                    
                    <span> 
                    <?php
                        if($l_date){


                    ?>
                            <a href="#likeContent" data-postId="<?php echo($c_id); ?>" ><img id ="like" src="image/like.png" width ="30px"></a>

                    <?php

                        }else{
                    ?>
                            <a href="#likeContent" data-postId="<?php echo($c_id); ?>" ><img id ="like" src="image/dlike.png" width ="30px"></a>
                    <?php

                        }

                    ?>
                         
                    
                         
                        <a href="#postComment" data-postId="<?php echo($c_id); ?>" ><img src="image/com.png" width ="30px"></a>
                    </span>

                </div>


                <?php

                while ($stmt->fetch()) {  
                    ?>
                
                <div class = "container-fluid imgcontainer"> 
                    <img src="<?php echo($image)?>">
                    <h1><a href="content-<?php echo($c_id); ?>"><?php echo($title)?></a></h1>
                    <p><?php echo($text)?></p>
                    
                    <span> 
                    <?php
                        if($l_date){


                    ?>
                            <a href="#likeContent" data-postId="<?php echo($c_id); ?>" ><img id ="like" src="image/like.png" width ="30px"></a>

                    <?php

                        }else{
                    ?>
                            <a href="#likeContent" data-postId="<?php echo($c_id); ?>" ><img id ="like" src="image/dlike.png" width ="30px"></a>
                    <?php

                        }

                    ?>
                         
                    
                         
                        <a href="#postComment" data-postId="<?php echo($c_id); ?>" data-uname="<?php echo($u_name); ?>"><img src="image/com.png" width ="30px"></a>
                    </span>

                </div>

                <?php  


                }
                    
            } 
              
            $stmt->close();

            //$mysqli->close();
        }
?>