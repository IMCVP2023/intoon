<?php include_once('./include/head.php');?>
<?php include_once('./include/header.php');?>
<?php 

//sujeong / left-join query => email_speaker가 없으면 안 나옴
//     $program_query = "
//     SELECT p.idx, p.program_name, p.chairpersons, p.preview, p.program_place_idx, 
// 			p.program_category_idx, p.program_date, p.start_time, p.end_time, p.is_deleted,
// 			es.nick_name, es.org, es.email, es.cv_path, es.abstract_path, es.attendance_type, es.is_mailed
// FROM program AS p
// LEFT JOIN email_speaker AS es ON es.program_idx = p.idx
// WHERE es.attendance_type = 0 AND p.is_deleted = 'N'
//     ";

    $program_query = "	SELECT * 
                        FROM program";

//     $program_query = "
//         SELECT p.idx, p.program_name, p.chairpersons, p.preview, p.program_place_idx, 
//     			p.program_category_idx, p.program_date, p.start_time, p.end_time, p.is_deleted,
//     			es.nick_name, es.org, es.email, es.cv_path, es.abstract_path, es.attendance_type, es.is_mailed
//     FROM program AS p
//     LEFT JOIN email_speaker AS es ON es.program_idx = p.idx
//     WHERE  p.is_deleted = 'N'
//  ";

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
</style>
    <section class="list">
        <div class="container">
            <div class="title clearfix2">
                <h1 class="font_title">프로그램 메일 전송하기</h1>
                <div class="y_scroll">
                <div class="contwrap">
                    <table>
                        <colgroup>
                            <!-- <col width="18%">
                            <col width="26%">
                            <col width="26%">
                            <col width="10%">
                            <col width="10%"> -->
                            <col>
                        </colgroup>
                        <tr>
                            <th>프로그램 이름</th>
                            <th>좌장</th>
                            <th>시작시간</th>
                            <th>끝나는 시간</th>
                            <th>메일발송 유무</th>
                        </tr>
                        <?php 
                foreach($program_list as $program){
                  
                    ?>
                        <tr>
                            <td style="cursor: pointer;color:blue;" onclick="goDetail(<?php echo $program['idx']?>)"><?php echo $program['program_name']; ?></td>
                            <td><?php echo $program['chairpersons'] ?></td>
                            <td><?php echo $program['start_time'] ?></td>
                            <td><?php echo $program['end_time'] ?></td>
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

    function goDetail(id){
        window.location.href = `/main/admin/edit_program_detail.php?idx=${id}`;
    }
</script> 
<?php include_once('./include/footer.php');?>