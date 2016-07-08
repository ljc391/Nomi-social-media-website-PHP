<?php
	if ($stmt = $mysqli->prepare("SELECT l_date FROM likes WHERE c_id = ?")) {
                $stmt->bind_param("s", $postId);
                $stmt->execute();
                $stmt->bind_result($l_date);
                $stmt->fetch();
                $stmt->close();
                if (!$l_date ) {
                	?>
					<a href="#likeContent" data-postId="<?php echo($c_id); ?>" ><img id ="like" src="image/dlike.png" width ="30px"></a>
				<?php
                  
                } else { 
                ?>
					<a href="#likeContent" data-postId="<?php echo($c_id); ?>" ><img id ="like" src="image/like.png" width ="30px"></a>
				<?php
                    
                }

                
                $mysqli->close(); 


?>