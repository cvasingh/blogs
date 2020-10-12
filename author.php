<?php include 'header.php'; ?>
    <div id="main-content">

                 <!-- post-container -->
                <div class="post-container">
                  <?php
                                          
                        if(isset($_GET['aid'])){
                            $aut_id=$_GET['aid'];
                           }
                  $sql1 = "select * from post join user on post.author = user.user_id "
                          . "where post.author = {$aut_id}";
                  $result1 = mysqli_query($conn, $sql1);
                  $total_row= mysqli_fetch_assoc($result1);
                  
                  ?>
                    <h2 class="page-heading"><?php echo $total_row['username'];?></h2>
                            <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-sroll">
                        <?php
                        include 'common.php';
                        
                        if(isset($_GET['aid'])){
                            $aut_id=$_GET['aid'];
                           }
                    //page
                        $limit = 5;
                        if(isset($_GET['page'])){
                            $page = $_GET['page']; 
                        } else {
                            $page = 1;
                        }
                     $offset = ($page - 1) * $limit;
                     $sql = "select * from post "
                            . "left join category on post.category = category.category_id "
                            . "left join user on post.author = user.user_id "
                             . "where post.author ={$aut_id} "
                            . "order by post.post_id desc limit {$offset},{$limit} ";
                  
                     
                        $result = mysqli_query($conn,$sql) or die("query failed");
                           if(mysqli_num_rows($result)>0){
                               while ($row = mysqli_fetch_assoc($result)){
                                                   
                        ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description"><?php echo substr($row['description'],0,80)."..."; ?></p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                               }
                           } else {
                                   echo 'NO POST FOUND!!';
                               }?>
                        </div>
                                   <?php
                  
                     if(mysqli_num_rows($result1) >0){
                        $total_record = mysqli_num_rows($result1);
                        $total_page = ceil($total_record / $limit);
                      
                         echo "<ul class='pagination admin-pagination'>";
                         if($page > 1){
                            echo '<li><a href="index.php?aid='.$aut_id.'&page='.($page-1).'"<i class="fa fa-arrow-left "></a></li>';
                         }
                         for($i=1;$i<=$total_page;$i++){
                            if($i == $page){
                                $active ="background-color:#000;";
                            }else{
                                $active = "";
                            }
                            echo '<li style="'.$active.'"><a href="index.php?aid='.$aut_id.'&page='.$i.'">'.$i.'</a></li>';
                      }
                        if($total_page > $page){
                            echo '<li><a href="index.php?aid='.$aut_id.'&page='.($page+1).'" <i class="fa fa-arrow-right "></a></li>';
                         }
                      echo "</ul>";
                  }
                  
                  ?>
                    </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
    </div>
<?php include 'footer.php'; ?>
