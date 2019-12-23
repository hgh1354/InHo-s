<?php


        session_start();

//1 johon
//2 jeck
        $_SESSION['user_id'] = (int)2; // 사용자 아이디는 임의로 정해준다. 1 or 2
        $connect = mysqli_connect("localhost","ccit","ccit3124","ccit");
        
        $query = "
            select hVideo.vId, hVideo.vTitle, 
            count(hVideo_Likes.idx) as likes, 
            group_concat(member.id separator '|') as liked
            from hVideo
            left join hVideo_Likes 
            on hVideo_Likes.hVideo_idx = hVideo.vIdx 
                left join member1 
                on hVideo_Likes.memeber_idx = member1.idx
            group by hVideo.vIdx 
        ";


        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result))
        {
            echo '<h3>'.$row["vTitle"].'</h3>';
            echo '<a href="index.php?type=hVideo&vIdx='.$row["vIdx"].'">좋아요</a>';
            echo '<p>'.$row["likes"].' 명의 사람들이 좋아합니다.</p>';
            //echo '<p>'.$row["liked"].'</p>';
            
            if(count($row["liked"]))
            {
                $liked = explode("|", $row["liked"]);
                echo '<ul>';
                foreach($liked as $like)
                {
                    echo '<li>'.$like.'</li>';
                }
                echo '</ul>';
            }
        }



if(isset($_GET["type"], $_GET["id"]))
{
    $type = $_GET["type"];

    $id = (int)$_GET["id"]; // 콘텐츠 아이디

    if($type == "hVideo")
    {
            // 1 이상이면 즉 좋아요를 했으면 1 
            $check_query ="select count(*) as cnt from hVideo_Likes where member_idx = {$_SESSION["user_id"]} and hVideo_idx = {$id};";
            $result1 =mysqli_query($connect, $check_query);
            $row1 = mysqli_fetch_array($result1); //칼럼에 0 아니면 1

            //cnt가 1이면 좋아요누른 상태
            if($row1["cnt"]==1)
            {   
                // 좋아요 삭제
                 $query = "
                  delete from hVideo_Likes where hVideo_idx = {$id} and member_idx = {$_SESSION['user_id']};
                ";

                mysqli_query($connect, $query);
                header("location:index.php");  

            }else{

                //좋아요 표시
                $query = "
                insert into hVideo_Likes (member_idx, hVideo_idx) 
                select {$_SESSION['user_id']}, {$id} from hVideo 
                where 
                    exists(
                        select vIdx from hVideo where vIdx = {$id})
                    and 
                    not exists(
                        select idx from hVideo_Likes where member_idx = {$_SESSION['user_id']} and idx = {$id}) 
                        limit 1
                        ";

                    mysqli_query($connect, $query);
                    header("location:index.php");      
            }
                    
    }
}


// 중간에 mysql 부분 오류 해결
 //14:15:05 delete from article_likes where article = 4 and user = 2    Error Code: 1175. You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column To disable safe mode, toggle the option in Preferences -> SQL Editor and reconnect. 0.000 sec

 //SET SQL_SAFE_UPDATES =0;
