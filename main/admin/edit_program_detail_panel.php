<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php 
    $idx = $_GET["idx"] ?? 0;
    if($idx == 0){
        $program_query = "	SELECT * 
        FROM program_contents";
    }else{
        // $program_query = "	
        //     SELECT * 
        //     FROM program_contents
        //     WHERE program_contents.idx = {$idx}
        // ";

            $program_query = "
                SELECT  es.nick_name, es.org, es.email, es.cv_path, es.abstract_path, es.is_mailed,
			p.program_name,p.contents_title, p.start_time, p.end_time
            FROM program_contents AS p
            LEFT JOIN email_speaker AS es ON es.program_contents_idx = p.idx
            WHERE es.attendance_type = 1 AND p.is_deleted = 'N' AND p.idx = {$idx}
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
                <h1 class="font_title">프로그램 메일 전송하기(패널)</h1>
                <div class="y_scroll">
                <div class="contwrap">
                    <table>
                       
                        <tr>
                            <th>프로그램 이름</th>
                            <th>제목</th>
                            <th>시작시간</th>
                            <th>끝나는 시간</th>
                            <th>패널 성함</th>
                            <th>패널 소속</th>
                            <th>패널 email</th>
                            <th>패널 메일 발송</th>
                            <th>메일발송 유무</th>
                        </tr>
                        <?php 
                foreach($program_list as $program){
                    $program_name = "";

                    ?>
                        <tr>
                            <td><?php echo $program['program_name']; ?></td>
                            <td><?php echo $program['contents_title'] ?></td>
                            <td><?php echo $program['start_time'] ?></td>
                            <td><?php echo $program['end_time'] ?></td>
                            <td><input name="nickname" value="<?php echo $program['nick_name'] ?>" /></td>
                            <td><input name="org" value="<?php echo $program['org'] ?>" /></td>
                            <td><input name="email" value="<?php echo $program['email'] ?>" /></td>
                            <td><button class="btn save_btn" data-id="<?php echo $program['idx'] ?>">메일전송</button></td>
                            <td><?php echo $program['is_mailed'] ?></td>
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
            const nickname = row.querySelector('input[name="nickname"]').value;
            const org = row.querySelector('input[name="org"]').value;
            const sendMail = row.querySelector('input[name="email"]').value;

            // const id = e.target.dataset.id;
            const data = {
                nickname:nickname, 
                org:org,
                email:sendMail
            }

                $.ajax({
                    url:"../ajax/admin/ajax_send_email.php",
                    type: "POST",
                    data: {
                        flag: "panel_mail",
                        data:data
                    },
                    dataType: "JSON",
                    success: function (res) {
                        // console.log(res)
                        if (res.code == 200) {
                            
                            return;
                        } else {
                            alert('수정에 실패했습니다.')
                            return;
                        }
                    }
                });
            
        })
    })
</script>
<?php include_once('./include/footer.php');?>