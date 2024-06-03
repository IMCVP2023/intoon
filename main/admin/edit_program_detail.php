<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php 
    $idx = $_GET["idx"] ?? 0;
    if($idx == 0){
        $program_query = "	SELECT * 
        FROM program_contents";
    }else{
        $program_query = "	
        SELECT * 
        FROM program_contents
        WHERE program_contents.program_idx = {$idx}
        ";
    }
    
    $program_list = get_data($program_query);

?>
<style>
    .y_scroll{
        width: 85vw;
        height: 80vh;
        overflow-y: scroll;
        margin-left : auto;
    }
</style>
    <section class="list">
        <div class="container">
            <div class="title clearfix2">
                <h1 class="font_title">프로그램 메일 전송하기</h1>
                <div class="y_scroll">
                <div class="contwrap">
                    <table>
                       
                        <tr>
                            <th>프로그램 이름</th>
                            <th>제목</th>
                            <th>연자이름(소속)</th>
                            <th>시작시간</th>
                            <th>끝나는 시간</th>
                            <th></th>
                        </tr>
                        <?php 
                foreach($program_list as $program){
                    $program_name = "";
                    
                    // if($program['program_idx'] == "1"){
                    //     $program_name = "Pre-congress Symposium 1";
                    // }
                    // else if($program['program_idx'] == 2){
                    //     $program_name = "Pre-congress Symposium 2";
                    // }
                    // else if($program['program_idx'] == 3){
                    //     $program_name = "Satellite Symposium 1";
                    // }
                    // else if($program['program_idx'] == 4){
                    //     $program_name = "Satellite Symposium 2";
                    // }
                    // else if($program['program_idx'] == 5){
                    //     $program_name = "Welcome Cocktail Party";
                    // }
                    // else if($program['program_idx'] == 6){
                    //     $program_name = "Breakfast Symposium 1";
                    // }
                    // else if($program['program_idx'] == 7){
                    //     $program_name = "Breakfast Symposium 2";
                    // }
                    // else if($program['program_idx'] == 8){
                    //     $program_name = "Breakfast Symposium 3";
                    // }
                    // else if($program['program_idx'] == 9){
                    //     $program_name = "Opening Address";
                    // }
                    // else if($program['program_idx'] == 10){
                    //     $program_name = "Symposium 1";
                    // }
                    // else if($program['program_idx'] == 11){
                    //     $program_name = "Symposium 2";
                    // }
                    // else if($program['program_idx'] == 12){
                    //     $program_name = "Symposium 3";
                    // }
                    // else if($program['program_idx'] == 14){
                    //     $program_name = "Symposium 4";
                    // }
                    // else if($program['program_idx'] == 15){
                    //     $program_name = "Symposium 5";
                    // }
                    // else if($program['program_idx'] == 16){
                    //     $program_name = "Symposium 6";
                    // }
                    // else if($program['program_idx'] == 22){
                    //     $program_name = "Symposium 7";
                    // }
                    // else if($program['program_idx'] == 23){
                    //     $program_name = "Symposium 8";
                    // }
                    // else if($program['program_idx'] == 24){
                    //     $program_name = "Symposium 9";
                    // }
                    // else if($program['program_idx'] == 29){
                    //     $program_name = "Symposium 10";
                    // }
                    // else if($program['program_idx'] == 30){
                    //     $program_name = "Symposium 11";
                    // }
                    // else if($program['program_idx'] == 31){
                    //     $program_name = "Symposium 12";
                    // }
                    // else if($program['program_idx'] == 13){
                    //     $program_name = "Oral Presentation 1";
                    // }
                    // else if($program['program_idx'] == 17){
                    //     $program_name = "Luncheon Lecture 1";
                    // }
                    // else if($program['program_idx'] == 18){
                    //     $program_name = "Luncheon Lecture 2";
                    // }
                    // else if($program['program_idx'] == 19){
                    //     $program_name = "Luncheon Lecture 3";
                    // }
                    // else if($program['program_idx'] == 20){
                    //     $program_name = "Plenary Lecture";
                    // }
                    // else if($program['program_idx'] == 21){
                    //     $program_name = "문석학술상";
                    // }
                    // else if($program['program_idx'] == 25){
                    //     $program_name = "Oral Presentation 2";
                    // }
                    // else if($program['program_idx'] == 26){
                    //     $program_name = "Keynote Lecture 1";
                    // }
                    // else if($program['program_idx'] == 27){
                    //     $program_name = "Keynote Lecture 2";
                    // }   
                    // else if($program['program_idx'] == 28){
                    //     $program_name = "젊은연구자상";
                    // }  
                    // else if($program['program_idx'] == 32){
                    //     $program_name = "Award & Closing";
                    // }

                    ?>
                        <tr>
                            <td><?php echo $program['program_name']; ?></td>
                            <td><?php echo $program['contents_title'] ?></td>
                            <td><?php echo $program['speaker'] ?></td>
                            <!-- <td><input type="text" name="contents_title" value="<?php echo $program['contents_title'] ?>"/></td>
                            <td><input type="text" name="contents_speaker" value="<?php echo $program['speaker'] ?>"/></td> -->
                            <td><?php echo $program['start_time'] ?></td>
                            <td><?php echo $program['end_time'] ?></td>
                            <td><button class="btn save_btn" data-id="<?php echo $program['idx'] ?>">저장</button></td>
                        </tr>
                        <?php } ?>
                    </table>
                    </div>
                </div>
            </div>    
        </div>
    </section>
<script>
    const saveBtnList = document.querySelectorAll(".save_btn");
    
    saveBtnList.forEach((saveBtn)=>{
        saveBtn.addEventListener("click", (e)=>{
             // 현재 버튼이 속한 행을 찾음
             const row = e.target.closest('tr');
    
            // 행에서 input 요소들을 찾아서 값을 가져옴
            const contentsTitle = row.querySelector('input[name="contents_title"]').value;
            const contentsSpeaker = row.querySelector('input[name="contents_speaker"]').value;
            const id = e.target.dataset.id;
            const data = {
               idx:id, 
               title:contentsTitle, 
               speaker:contentsSpeaker
            }
            console.log(id, contentsTitle, contentsSpeaker);
            if(contentsTitle && contentsSpeaker){
                $.ajax({
                    url:"../ajax/admin/ajax_update_program.php",
                    type: "POST",
                    data: {
                        flag: "modify_program_detail",
                        idx:id, 
                        title:contentsTitle, 
                        speaker:contentsSpeaker
                    },
                    dataType: "JSON",
                    success: function (res) {
                        // console.log(res)
                        if (res.code == 200) {
                            alert('수정이 완료되었습니다.')
                            return;
                        } else {
                            alert('수정에 실패했습니다.')
                            return;
                        }
                    }
                });
            }
        })
    })
</script>
<?php include_once('./include/footer.php');?>