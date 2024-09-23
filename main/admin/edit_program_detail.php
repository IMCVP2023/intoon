<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php 
    $idx = $_GET["idx"] ?? 0;
    if($idx == 0){
        $program_query = "	SELECT * 
        FROM program_contents";
    }else{
        // $program_query = "	
        // SELECT * 
        // FROM program_contents
        // WHERE program_contents.program_idx = {$idx}
        // ";

        $program_query = "	
            SELECT es.nick_name, es.org, es.email, es.attendance_type, es.cv_path, es.abstract_path, es.is_mailed, es.idx AS email_idx,
			    p.program_name, p.contents_title, p.start_time, p.end_time, p.idx
            FROM program_contents AS p
            LEFT JOIN email_speaker AS es ON es.program_contents_idx = p.idx
            WHERE p.is_deleted = 'N' AND p.program_idx = {$idx}
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
    input{
        border: 1px solid #DDD;
        padding: 8px;
    }
    .loading_box {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .loading {
        width: 150px;
        height: 150px;
        position: absolute;
        top: 50%;
        left: 52%;
        transform: translate(-50%, -50%);
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
                            <th>시작시간</th>
                            <th>끝나는 시간</th>
                            <th>연자 성함</th>
                            <th>연자 소속</th>
                            <th>연자 email</th>
                            <th>테스트 메일 발송</th>
                            <th>연자 메일 발송</th>
                            <th>메일발송 유무</th>
                        </tr>
                        <?php 
                foreach($program_list as $program){
                    $program_name = "";

                    ?>
                        <tr>
                            <td><?php echo $program['program_name']; ?></td>
                            <?php if($program['attendance_type'] == 1){ ?>
                                <td>좌장</td>
                            <?php }else {?>
                            <td><?php echo $program['contents_title'] ?></td>
                            <?php } ?>
                            <td><?php echo $program['start_time'] ?></td>
                            <td><?php echo $program['end_time'] ?></td>
                            <td><input name="nickname" value="<?php echo $program['nick_name'] ?>" /></td>
                            <td><input name="org" value="<?php echo $program['org'] ?>" /></td>
                            <td><input name="email" value="<?php echo $program['email'] ?>" /></td>
                            <td><button class="btn test_save_btn" data-id="<?php echo $idx ?>" data-number="<?php echo $program['idx'] ?>"data-type="<?php echo $program['attendance_type'] ?>">테스트전송</button></td>
                            <td><button class="btn save_btn" data-id="<?php echo $idx ?>" data-number="<?php echo $program['idx'] ?>" data-type="<?php echo $program['attendance_type'] ?>" data-email="<?php echo $program['email_idx'] ?>">메일전송</button></td>
                            <?php if($program['is_mailed'] == "N"){ ?>
                             <td class="red_color bold centerT"><?php echo $program['is_mailed'] ?></td>
                            <?php }else{ ?>
                                <td class="blue_color bold centerT"><?php echo $program['is_mailed'] ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </table>
                    </div>
                </div>
            </div>    
        </div>
        <div style="display: none;" class="loading_box" onclick="alert('진행중입니다.')">
             <svg class="loading" version="1.1" id="L6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <rect fill="none" stroke="#fff" stroke-width="4" x="25" y="25" width="50px" height="50px">
                    <animateTransform
                        attributeName="transform"
                        dur="0.5s"
                        from="0 50 50"
                        to="180 50 50"
                        type="rotate"
                        id="strokeBox"
                        attributeType="XML"
                        begin="rectBox.end"/>
                    </rect>
                    <rect x="27" y="27" fill="#fff" width="46" height="50">
                    <animate
                        attributeName="height"
                        dur="1.3s"
                        attributeType="XML"
                        from="50" 
                        to="0"
                        id="rectBox" 
                        fill="freeze"
                        begin="0s;strokeBox.end"/>
                    </rect>
            </svg>
        </div>
    </section>
<script>
    const saveBtnList = document.querySelectorAll(".save_btn");
    const testBtnList = document.querySelectorAll(".test_save_btn");

    const loadingBox = document.querySelector(".loading_box");
    const loading = document.querySelector(".loading");

    function pending(){
        loadingBox.style.display = "";
        loading.style.display = "";
    }

    function pendingOff(){
        loadingBox.style.display = "none";
        loading.style.display = "none";
    }

    function changeMailStatus(emailId){
        pendingOff()
        //console.log(emailId)
        $.ajax({
                url:"../ajax/client/ajax_member.php",
                type: "POST",
                data: {
                    flag: "speaker_email",
                    idx : emailId
                },
                dataType: "JSON",
                success: function (res) {
                    console.log(res)
                    if (res.code == 200) {
                        window.location.reload();
                        return;
                    } else {
                       
                        return;
                    }
                }
            });
    }

    //메일전송 버튼 이벤트
    saveBtnList.forEach((saveBtn)=>{
        saveBtn.addEventListener("click", (e)=>{
             // 현재 버튼이 속한 행을 찾음
             const row = e.target.closest('tr');
    
            // 행에서 input 요소들을 찾아서 값을 가져옴
            const nickname = row.querySelector('input[name="nickname"]').value;
            const org = row.querySelector('input[name="org"]').value;
            const sendMail = row.querySelector('input[name="email"]').value;
            const program_idx = e.target.dataset.id;
            const program_contents_idx = e.target.dataset.number;
            const attendace_type =  e.target.dataset.type;
            const emailId = e.target.dataset.email;
            
            const data = {
                nickname:nickname, 
                org:org,
                email:sendMail,
                program_idx:program_idx,
                program_contents_idx : program_contents_idx,
                attendace_type: attendace_type
            }

            //console.log(emailId)
    
            if(window.confirm(`${sendMail}로 발송하시겠습니까?`)){
                pending()
                $.ajax({
                    url:"../ajax/client/ajax_gmail.php",
                    type: "POST",
                    data: {
                        flag: "speaker",
                        data
                    },
                    dataType: "JSON",
                    success: function (res) {
                        console.log(res)
                        if (res.code == 200) {
                            alert('메일발송이 완료되었습니다.')
                            changeMailStatus(emailId);
                            return;
                        } else {
                            alert('메일발송에 실패했습니다.')
                            return;
                        }
                    }
                });
            }
        })
    })

    

    //[240617] sujoeng / test 버튼
    testBtnList.forEach((testBtn)=>{
        testBtn.addEventListener("click", (e)=>{
             // 현재 버튼이 속한 행을 찾음
             const row = e.target.closest('tr');
    
            // 행에서 input 요소들을 찾아서 값을 가져옴
            const nickname = row.querySelector('input[name="nickname"]').value;
            const org = row.querySelector('input[name="org"]').value;
            const sendMail = "sujeong.shin@into-on.com"; //테스트 발송할 메일
            const program_idx = e.target.dataset.id;
            const program_contents_idx = e.target.dataset.number;
            const attendace_type =  e.target.dataset.type;
            
            const data = {
                nickname:nickname, 
                org:org,
                email:sendMail,
                program_idx:program_idx,
                program_contents_idx : program_contents_idx,
                attendace_type: attendace_type
            }
    
            if(window.confirm(`${sendMail}로 발송하시겠습니까?`)){
                $.ajax({
                    url:"../ajax/client/ajax_gmail.php",
                    type: "POST",
                    data: {
                        flag: "speaker",
                        data
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

    function goPenal(id){
        window.location.href = `/main/admin/edit_program_detail_panel.php?idx=${id}`;
    }
</script>
<?php include_once('./include/footer.php');?>