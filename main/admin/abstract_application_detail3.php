<!--[240225] sujeong / iscp admin 추가!!! -->
<?php
include_once('./include/head.php');
include_once('./include/header.php');
include_once('../include/submission_data.php');

if ($admin_permission["auth_apply_poster"] == 0) {
    echo '<script>alert("권한이 없습니다.");history.back();</script>';
}

// error_reporting( E_ALL );
// ini_set( "display_errors", 1 );

$submission_idx = $_GET["idx"];
$member_idx = $_GET["no"];

$member_info = "SELECT
						m.idx AS member_idx, m.email, n.nation_ko AS nation, CONCAT(m.first_name,' ',m.last_name) AS name, m.affiliation,
						DATE_FORMAT(m.register_date, '%y-%m-%d') AS member_register_date
					FROM member m
					JOIN nation n
					ON m.nation_no = n.idx
					WHERE m.idx = " . $member_idx;
$member_info_data = sql_fetch($member_info);

$registration_info = "SELECT * 
                      FROM request_registration
                      WHERE register =" . $member_idx;

$registration_info_data = sql_fetch($registration_info);
$registration_yn = "";

if(!$registration_info_data){
    $registration_yn = "N";
}else{
    $registration_yn = "Y";
}

$sql_detail = "
		SELECT
			rs.submission_code,
			`status`,
			preferred_presentation_type,
			topic, topic_detail, mail_status,
			title,
			objectives, methods, results, conclusions, keywords, etc1, etc2, etc1_date, etc3, etc4,
			IFNULL(CONCAT(fi_image1.path, '/', fi_image1.save_name), '') AS image1_path, fi_image1.original_name AS image1_original_name, rs.image1_caption,
			IFNULL(CONCAT(fi_image2.path, '/', fi_image2.save_name), '') AS image2_path, fi_image2.original_name AS image2_original_name, rs.image2_caption,
			IFNULL(CONCAT(fi_image3.path, '/', fi_image3.save_name), '') AS image3_path, fi_image3.original_name AS image3_original_name, rs.image3_caption,
			IFNULL(CONCAT(fi_image4.path, '/', fi_image4.save_name), '') AS image4_path, fi_image4.original_name AS image4_original_name, rs.image4_caption,
			IFNULL(CONCAT(fi_image5.path, '/', fi_image5.save_name), '') AS image5_path, fi_image5.original_name AS image5_original_name, rs.image5_caption,
			rs.similar_yn, rs.support_yn, rs.travel_grants_yn, rs.awards_yn, rs.investigator_grants_yn,
			IFNULL(CONCAT(fi_prove_age.path, '/', fi_prove_age.save_name), '') AS prove_age_path, fi_prove_age.original_name AS prove_age_original_name
		FROM request_submission AS rs
		LEFT JOIN `file` AS fi_image1
			ON fi_image1.idx = rs.image1_file
		LEFT JOIN `file` AS fi_image2
			ON fi_image2.idx = rs.image2_file
		LEFT JOIN `file` AS fi_image3
			ON fi_image3.idx = rs.image3_file
		LEFT JOIN `file` AS fi_image4
			ON fi_image4.idx = rs.image4_file
		LEFT JOIN `file` AS fi_image5
			ON fi_image5.idx = rs.image5_file
		LEFT JOIN `file` AS fi_prove_age
			ON fi_prove_age.idx = rs.prove_age_file
		WHERE rs.is_deleted = 'N'
		AND rs.idx = '" . $submission_idx . "'
		AND rs.register = '" . $member_idx . "'
	";

$detail = sql_fetch($sql_detail);

if (!$detail) {
    echo "<script>alert('Invalid abstract data.'); history.go(-1);</script>";
    exit;
}

// affiliations
$af_query = "
		SELECT
			rsaf.idx, rsaf.`order`, rsaf.affiliation, rsaf.department, rsaf.department_detail, rsaf.nation_no, n.nation_en AS nation_name_en
		FROM request_submission_affiliation AS rsaf
		LEFT JOIN nation AS n
			ON n.idx = rsaf.nation_no
		WHERE rsaf.is_deleted = 'N'
		AND rsaf.submission_idx = '" . $submission_idx . "'
		AND rsaf.register = '" . $member_idx . "'
		ORDER BY rsaf.`order`
	";
$af_list = get_data($af_query);

// authors
$au_query = "
		SELECT
			rsau.idx, 
			rsau.`order`, 
			rsau.same_signup_yn, 
			rsau.presenting_yn, 
			rsau.corresponding_yn, 
			rsau.first_name, rsau.last_name, 
			rsau.name_kor, rsau.affiliation_kor,
			email, 
			affiliation_selected, 
			mobile
		FROM request_submission_author AS rsau
		WHERE rsau.is_deleted = 'N'
		AND rsau.submission_idx = '" . $submission_idx . "'
		AND rsau.register = '" . $member_idx . "'
		ORDER BY rsau.`order`
	";


$au_list = get_data($au_query);

$au_presenting = array();
$au_corresponding = array();
$au_co_author = array();
/*foreach($au_list as $au){
		if ($au['presenting_yn'] == "Y") {
			$au_presenting = $au;
			//echo "<u>".$au['first_name']." ".$au['last_name']."</u><sup>".$au['order']."</sup>";
		} 
		if ($au['corresponding_yn'] == "Y" && $au['corresponding_yn'] == "N") {
			$au_corresponding = $au;
		}
		if($au['corresponding_yn'] == "N" && $au['corresponding_yn'] == "N") {
			$au_co_author = $au;
		}
		if ($au['order'] < count($au_list)) {
			//echo ", ";
		}
		
		else {
			//echo $au['first_name']." ".$au['last_name']."<sup>".$au['order']."</sup>";
		}
	}*/

$topic;
$topic_detail;
if ($detail['topic'] == 0) {
}
foreach ($topic1_list as $tp) {
    if ($tp['idx'] == $detail['topic']) {
        $topic = $tp["idx"] . ". " . $tp["name_en"];
    }
}
// if ($detail['topic'] != 5) {
//     //echo " / ";
//     foreach ($topic2_list as $tp) {
//         if ($tp['idx'] == $detail['topic_detail']) {
//             $topic_detail = $tp["idx"] . ". " . $tp['order'] . ". " . $tp["name_en"];
//         }
//     }
// }

// 소속 구하기
function get_auther_affiliation($author_idx)
{
    $sql = "
			SELECT
				#rsaf1.affiliation AS af1, rsaf1.department AS dp1,
				#rsaf2.affiliation AS af2, rsaf2.department AS dp2,
				#rsaf3.affiliation AS af3, rsaf3.department AS dp3
				CONCAT(
					'#', af1, 
					IF(
						af2 = '', 
						'', 
						CONCAT(', #', af2)
					), 
					IF(
						af3 = '', 
						'', 
						CONCAT(', #', af3)
					)
				) AS `text`
			FROM (
				SELECT
					submission_idx, 
					affiliation_selected,
					SUBSTRING_INDEX(affiliation_selected, '|', 1) AS af1,
					SUBSTRING_INDEX(SUBSTRING_INDEX(affiliation_selected, '|', 2), '|', -1) AS af2,
					SUBSTRING_INDEX(affiliation_selected, '|', -1) AS af3 
				FROM request_submission_author
				WHERE idx = '" . $author_idx . "'
			) AS rsau
		";
    $result = sql_fetch($sql);

    return $result['text'];
}
?>

<body>
    <section class="detail">
    <div style="display: none;" class="loading_box" onclick="alert('진행중입니다.')">
                <svg class="loading" version="1.1" id="L5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" width="70px" height="70px">
                    <circle fill="#fff" stroke="none" cx="6" cy="50" r="6">
                        <animateTransform attributeName="transform" dur="1s" type="translate" values="0 15 ; 0 -15; 0 15" repeatCount="indefinite" begin="0.1" />
                    </circle>
                    <circle fill="#fff" stroke="none" cx="30" cy="50" r="6">
                        <animateTransform attributeName="transform" dur="1s" type="translate" values="0 10 ; 0 -10; 0 10" repeatCount="indefinite" begin="0.2" />
                    </circle>
                    <circle fill="#fff" stroke="none" cx="54" cy="50" r="6">
                        <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.3" />
                    </circle>
                </svg>
            </div>
        <div class="container">
            <div class="title">
                <h1 class="font_title">Poster Abstract Submission</h1>
            </div>
            <div id="print_1" class="contwrap has_fixed_title" style="background-color: #fff;">
                
                <!-- <div class="tab_box">
					<ul class="tab_wrap clearfix">
						<li class="active"><a href="./abstract_application_detail.php">기본 정보</a></li>
						<li><a href="./abstract_application_detail2.php">댓글</a></li>
					</ul>
				</div> -->
                <h2 class="sub_title">회원 정보</h2>
                <table>
                    <colgroup>
                        <col width="10%">
                        <col width="40%">
                        <col width="10%">
                        <col width="40%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>ID(Email)</th>
                            <td><a href="./member_detail.php?idx=<?= $member_info_data["member_idx"] ?>"><?= $member_info_data["email"] ?></a>
                            </td>
                            <th>Name / Country</th>
                            <td><?= $member_info_data["name"] ?> / <?= $member_info_data["nation"] ?></td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td><?= $member_info_data["member_register_date"] ?></td>
                            <th>Sumission Code</th>
                            <td><?= $detail["submission_code"] ?></td>
                        </tr>
                        <tr>
                            <th>회원 등록 여부</th>
                            <td><?php echo $registration_yn; ?></td>
                            <th>회원 등록 코드</th>
                            <td><?php 
                            if($registration_yn === "Y"){
                                if(!empty($registration_info_data["idx"])){
                                    $code_number = $registration_info_data["idx"];
                        
                                    while (strlen("" . $code_number) < 4) {
                                        $code_number = "0" . $code_number;
                                    }
                        
                                    $register_no = "IMCVP2024". "-" . $code_number;
                                }
                                echo $register_no; 
                            }else{
                                echo "-";
                            }
                            ?></td>
                        </tr>
                        <tr>
                            <th>초록 심사 여부</th>
                            <td>
                                <input type="radio" value="Y" id="etc1_y" <?=($detail["etc1"] == 'Y' ? "checked" : "")?> name="etc1"/>
                                <label for="etc1_y">Yes</label>
                                <input type="radio" value="N" id="etc1_n" <?=($detail["etc1"] == 'N' ? "checked" : "")?> name="etc1"/>
                                <label for="etc1_n">No</label>
                                <button class="border_btn etc1_save">Save</button>
                            </td>
                            <th>초록 채택 여부</th>
                            <td>
                                <input type="radio" value="Y" id="etc2_y" <?=($detail["etc2"] == 'Y' ? "checked" : "")?> name="etc2"/>
                                <label for="etc2_y">Yes</label>
                                <input type="radio" value="N" id="etc2_n" <?=($detail["etc2"] == 'N' ? "checked" : "")?> name="etc2"/>
                                <label for="etc2_n">No</label>
                                <button class="border_btn etc2_save">Save</button>
                            </td>
                        </tr>
                        <tr>
                            <th>초록 프로모션코드</th>
                            <td>
                                <input type="text" name="etc3" value="<?php echo $detail["etc3"]; ?>" class=""/>
                                <button class="border_btn etc3_save">Save</button>
                            </td>
                            <th>Travel Grants 채택 여부</th>
                            <td>
                                <input type="radio" value="Y" id="etc4_y" <?=($detail["etc4"] == 'Y' ? "checked" : "")?> name="etc4"/>
                                <label for="etc4_y">Yes</label>
                                <input type="radio" value="N" id="etc4_n" <?=($detail["etc4"] == 'N' ? "checked" : "")?> name="etc4"/>
                                <label for="etc4_n">No</label>
                                <button class="border_btn etc4_save">Save</button>
                            </td>
                        </tr>
                        <tr>
                            <th>초록 심사 일자</th>
                            <td><?php echo $detail['etc1_date'] ?></td>
                            <th>발송 초록 메일</th>
                            <td>
                                <input type="radio" value="1" id="mail_status_1" <?=($detail["mail_status"] == '1' ? "checked" : "")?> name="mail_status"/>
                                <label for="mail_status_1">1. Poster Oral & TG - O</label>
                                <input type="radio" value="2" id="mail_status_2" <?=($detail["mail_status"] == '2' ? "checked" : "")?> name="mail_status"/>
                                <label for="mail_status_2">2. Poster Exhibition & TG - O</label>
                                <br/>
                                <input type="radio" value="3" id="mail_status_3" <?=($detail["mail_status"] == '3' ? "checked" : "")?> name="mail_status"/>
                                <label for="mail_status_3">3. Poster Exhibition & TG - X</label>
                                <input type="radio" value="4" id="mail_status_4" <?=($detail["mail_status"] == '4' ? "checked" : "")?> name="mail_status"/>
                                <label for="mail_status_4">4. TG - X</label>
                                <button class="border_btn mail_status_save">Save</button>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <h2 class="sub_title">소속 정보</h2>
                <?php
                foreach ($af_list as $aff) {
                ?>
                    <table>
                        <colgroup>
                            <col width="10%">
                            <col width="40%">
                            <col width="10%">
                            <col width="40%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th colspan="4"># <?= $aff["order"] ?></th>
                            </tr>
                            <tr>
                                <th>Affiliation</th>
                                <td><?= $aff["affiliation"] ?></td>
                                <th>Country</th>
                                <td><?= $aff["nation_name_en"] ?></td>
                            </tr>
                            <tr>
                                <th>Department </th>
                                <?php
                                foreach ($department_list as $dl) {
                                    if ($aff["department"] == $dl["idx"]) {
                                        $de_name = $dl["name_en"];
                                    }
                                }

                                $de_detail = ($aff["department_detail"] != "") ? "(" . $aff["department_detail"] . ")" : "";
                                ?>
                                <td colspan="3"><?= $de_name . "" . $de_detail ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
                ?>

                <h2 class="sub_title">저자 정보</h2>
                <?php
                foreach ($au_list as $au) {
                ?>
                    <table>
                        <colgroup>
                            <col width="10%">
                            <col width="40%">
                            <col width="10%">
                            <col width="40%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th colspan="4"># <?= $au["order"] ?></th>
                            </tr>
                            <?php
                            if ($au['same_signup_yn'] == "Y") {
                            ?>
                                <tr>
                                    <th colspan="4">Same as sign-up information</th>
                                </tr>
                            <?php
                            }

                            if ($au['presenting_yn'] == "Y") {
                            ?>
                                <tr>
                                    <th colspan="4">Presenting author</th>
                                </tr>
                            <?php
                            }

                            if ($au['corresponding_yn'] == "Y") {
                            ?>
                                <tr>
                                    <th colspan="4">Corresponding author</th>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <th>Name</th>
                                <td><?= $au['first_name'] . " " . $au['last_name'] ?></td>
                                <th>Affiliation / Department</th>
                                <td><?= get_auther_affiliation($au['idx']) ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $au['email']; ?></td>
                                <th>Phone Number</th>
                                <td><?= $au['mobile'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
            <div id="print_2" class="contwrap has_fixed_title" style="background-color: #fff;">
                <h2 class="sub_title">Abstract 정보</h2>
                <table class="resize_img">
                    <colgroup>
                        <col width="10%">
                        <col width="40%">
                        <col width="10%">
                        <col width="40%">
                    </colgroup>
                    <tbody>
                   
                        <tr>
                            <th>Abstract title</th>
                            <td colspan="3"><?= htmlspecialchars_decode(stripslashes($detail["title"])) ?></td>
                            <!-- <th>Abstract file</th> -->
                            <!-- <td> -->
                            <?php
                            //if ($author_detail["image1_file"]) {
                            ?>
                            <!-- <a href="<?= $author_detail["path"] ?>"><?= $author_detail["file_name"] ?></a> -->
                            <?php
                            //} else {
                            //	echo "-";
                            //	}
                            ?>
                            <!-- </td> -->
                        </tr>
                        <tr>
                            <th>Preferred presentation type</th>
                            <td colspan="3">
                            <?php
                                if ($detail["preferred_presentation_type"] == 0) {
                                    echo "Poster Oral";
                                } else if ($detail["preferred_presentation_type"] == 1) {
                                    echo "Poster Exhibition only";
                                } else if ($detail["preferred_presentation_type"] == 2) {
                                    echo "Either";
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Topic</th>
                            <td colspan="3"><?= $topic; ?></td>
                            <!-- <th>Topic detail</th>
                            <td><?= $topic_detail; ?></td> -->
                        </tr>
                        <!-- ra.objectives, ra.method, ra.results, ra.conclusions, ra.keywords -->
                        <tr>
                            <th>Objectives</th>
                            <td colspan="3"><?= htmlspecialchars_decode(stripslashes($detail["objectives"])) ?></td>
                        </tr>
                        <tr>
                            <th>Materials and Methods</th>
                            <td colspan="3"><?= htmlspecialchars_decode(stripslashes($detail["methods"])) ?></td>
                        </tr>
                        <tr>
                            <th>Results</th>
                            <td colspan="3"><?= htmlspecialchars_decode(stripslashes($detail["results"])) ?></td>
                        </tr>
                        <tr>
                            <th>Conclusions</th>
                            <td colspan="3"><?= htmlspecialchars_decode(stripslashes($detail["conclusions"])) ?></td>
                        </tr>
                        <tr>
                            <th>Keywords</th>
                            <td colspan="3"><?= htmlspecialchars_decode(stripslashes($detail["keywords"])) ?></td>
                        </tr>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $key_prefix = "image" . $i . "_";
                            $key_path = $key_prefix . "path";
                            if ($detail[$key_path] != "") {
                                $key_original_name = $key_prefix . "original_name";
                                $key_caption = $key_prefix . "caption";
                        ?>
                                <tr>
                                    <th>Image <?= $i ?></th>
                                    <td colspan="3">
                                        <img src="<?= $detail[$key_path] ?>" download="<?= $detail[$key_original_name] ?>"><br><br><?= $detail[$key_caption] ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th>Q1. Have you submitted this abstract or ab abstract of a similar topic at another conference?</th>
                            <td><?= $detail["similar_yn"] == "Y" ? "Yes" : "No" ?></td>
                            <th>Q2. This research is supported by the grant of Korean Society of Cardiovascular Disease Prevention</th>
                            <td><?= $detail["support_yn"] == "Y" ? "Yes" : "No" ?></td>
                        </tr>
                        <tr>
                            <th>Ask for IMCVP 2024 Travel Grants</th>
                            <td colspan="3"><?= $detail["travel_grants_yn"] == "Y" ? "Yes" : "No" ?></td>
                            <!-- <th>Apply for APSAVD Young Investigator Awards</th>
                            <td><?= $detail["awards_yn"] == "Y" ? "Yes" : "No" ?></td> -->
                        </tr>
                        <!-- <tr>
                            <th>Ask for IAS Asia-Pacific Federation Young Investigator Grants</th>
                            <td colspan="3"><?= $detail["investigator_grants_yn"] == "Y" ? "Yes" : "No" ?></td>
                             <th>Funding Acknowledgments</th> 
                              <td><?= $detail["funding_yn"] == "Y" ? "Yes" : "No" ?></td>
                        </tr> -->
                        <?php
                        $key_prefix = "prove_age_";
                        $key_path = $key_prefix . "path";
                        if ($detail["prove_age_path"] != "") {
                            $key_original_name = $key_prefix . "original_name";
                        ?>
                            <tr>
                                <th>Copy of documents(passport) that prove age</th>
                                <td colspan="3">
                                    <a href="<?= $detail[$key_path] ?>" target="_BLANK"><?= $detail[$key_original_name] ?></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="btn_wrap">
                <button type="button" class="border_btn" onclick="location.href='./abstract_application_list.php'">목록</button>
                <!-- <button type="button" class="border_btn" onclick="createPDFfromHTML()">다운로드</button> -->
                <button type="button" class="border_btn" onclick="deleteAbstract()">삭제</button>
            </div>
        </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script>

    const loading = document.querySelector(".loading_box")

    function createPDFfromHTML() {
        const print_1 = document.querySelector("#print_1");
        const print_2 = document.querySelector("#print_2");

        const buttonBox = document.querySelector(".btn_wrap");
        const buttons = document.querySelectorAll(".border_btn");

        buttons.forEach((button) => {
            buttonBox.removeChild(button);
        });

        // Create a new jsPDF instance
        let doc = new jsPDF('p', 'mm', 'a4');
        let totalPages = 0;

        // Function to add HTML content to PDF
        const addHTMLToPDF = (element) => {
            return new Promise((resolve) => {
                html2canvas(element, {
                    onrendered: function(canvas) {
                        let imgData = canvas.toDataURL('image/png');
                        let imgWidth = doc.internal.pageSize.width; // Updated line
                        let imgHeight = canvas.height * imgWidth / canvas.width;

                        if (totalPages === 0) {
                            // Add the first page without creating a new page
                            doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                            totalPages++;
                            resolve();
                        } else {
                            doc.addPage();
                            doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                            totalPages++;
                            resolve();
                        }
                    }
                });
            });
        };

        // Add print_1 HTML to PDF
        addHTMLToPDF(print_1)
            .then(() => {
                // Add print_2 HTML to PDF
                return addHTMLToPDF(print_2);
            })
            .then(() => {
                // Update page numbering
                for (let i = 1; i <= totalPages; i++) {
                    doc.setPage(i);
                }

                // Save the PDF file
                doc.save('abstract.pdf');

                // Restore buttons
                buttons.forEach((button) => {
                    buttonBox.appendChild(button);
                });
            });
    }

    async function deleteAbstract() {
        const idx = new URLSearchParams(window.location.search).get("idx");
        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "delete",
                idx: idx
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    alert("complet_submission_delete");
                    location.href = './abstract_application_list2.php'
                } else if (res.code == 400) {
                    alert("error_submission_cancel");
                    return false;
                } else {
                    alert("reject_msg");
                    return false;
                }
            }
        });
        // const url = "../ajax/client/ajax_submission2022.php"
        // const data = {
        //     flag: "delete",
        //     idx: idx
        // }
        // const response = await fetch(url, {
        //     method: "POST",
        //     body: JSON.stringify(data)
        // }).then((response) => {
        //     if (response.status === 200) {
        //         window.alert("삭제되었습니다.")
        //         location.href = './abstract_application_list2.php'
        //     }
        // })
        $("input[name='etc1']").change(function(){
            if($("input[id='etc1_y']").is(":checked")){
                $("input:radio[id='etc1_n']").prop("checked", false); 
            }else if($("input[id='etc1_n']").is(":checked")){
                $("input:radio[id='etc1_y']").prop("checked", false); 
            }
        })
    }

    $(".etc1_save").click(function(){
        const idx = new URLSearchParams(window.location.search).get("idx");
        let etc1Value = '';

        if($("input[id='etc1_y']").is(":checked")){
            etc1Value = 'Y';
        }else if($("input[id='etc1_n']").is(":checked")){
            etc1Value = 'N';
        }
       
        loading.style.display = ""

        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "etc1",
                idx: idx,
                etc1 : etc1Value
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    alert("초록 심사가 업데이트 되었습니다.");
                     loading.style.display = "none"
                } else if (res.code == 400) {
                    alert("초록 심사 업데이트에 실패했습니다.");
                    return false;
                } else {
                    alert("초록 심사 업데이트에 실패했습니다.");
                    return false;
                }
            }
        });
    })

    $(".etc2_save").click(function(){
        const idx = new URLSearchParams(window.location.search).get("idx");
        let etc2Value = '';

        if($("input[id='etc2_y']").is(":checked")){
            etc2Value = 'Y'
        }else if($("input[id='etc2_n']").is(":checked")){
            etc2Value = 'N'
        }
        loading.style.display = ""

        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "etc2",
                idx: idx,
                etc2 : etc2Value
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    alert("초록 채택 여부가 업데이트 되었습니다.");
                    loading.style.display = "none"
                    // if(etc2Value == 'Y'){
                    //     if(window.confirm("채택자에게 메일을 발송하시겠습니까?")){
                    //         postGmail()
                    //     }
                    // }
                } else if (res.code == 400) {
                    alert("초록 채택 여부가 업데이트에 실패했습니다.");
                    return false;
                } else {
                    alert("초록 채택 여부가 업데이트에 실패했습니다.");
                    return false;
                }
            }
        });
    })

    
    $(".etc3_save").click(function(){
        const idx = new URLSearchParams(window.location.search).get("idx");
        loading.style.display = ""

        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "etc3",
                idx: idx,
                etc3 :  $("input[name='etc3']").val()
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    alert("프로모션 코드가 업데이트 되었습니다.");
                    loading.style.display = "none"
                } else if (res.code == 400) {
                    alert("프로모션 코드 업데이트에 실패했습니다.");
                    return false;
                } else {
                    alert("프로모션 코드 업데이트에 실패했습니다.");
                    return false;
                }
            }
        });
    })

    $(".etc4_save").click(function(){
        const idx = new URLSearchParams(window.location.search).get("idx");
        let etc4Value = '';

        if($("input[id='etc4_y']").is(":checked")){
            etc4Value = 'Y'
        }else if($("input[id='etc4_n']").is(":checked")){
            etc4Value = 'N'
        }
        loading.style.display = ""

        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "etc4",
                idx: idx,
                etc4 : etc4Value
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    alert("TG 여부가 업데이트 되었습니다.");
                    loading.style.display = "none"
                } else if (res.code == 400) {
                    alert("TG 여부가 업데이트에 실패했습니다.");
                    return false;
                } else {
                    alert("TG 여부가 업데이트에 실패했습니다.");
                    return false;
                }
            }
        });
    })

    $(".mail_status_save").click(function(){
        const idx = new URLSearchParams(window.location.search).get("idx");
        const checkedValue = $('input[name="mail_status"]:checked').val();
        if(!checkedValue){
            alert('발송할 초록 메일을 확인해주세요!')
        }
        loading.style.display = ""
        $.ajax({
            url: "https://imcvp.org/main/" + "ajax/client/ajax_submission2024.php",
            type: "POST",
            data: {
                flag: "mail_status",
                idx: idx,
                mail_status : checkedValue
            },
            dataType: "JSON",
            success: function(res) {
                if (res.code == 200) {
                    if(window.confirm(`${checkedValue}번 템플릿의 메일을 발송하시겠습니까?`)){
                        postGmail(checkedValue)
                    }else{
                         loading.style.display = "none"
                    }
                } else if (res.code == 400) {
                    alert("프로모션 코드 업데이트에 실패했습니다.");
                    return false;
                } else {
                    alert("프로모션 코드 업데이트에 실패했습니다.");
                    return false;
                }
            }
        });
       
    })

    //[240419] sujoeng / 초록 채택 메일 추가
    function postGmail(mailValue){
        const email = "<?php echo $member_info_data['email']; ?>";
        const nickname = "<?php echo $member_info_data['name']; ?>";
        const org = "<?php echo $member_info_data['affiliation']; ?>";
        const submissionCode = "<?php echo $detail['submission_code']; ?>";
        const abstractTitle = `<?php echo strip_tags(htmlspecialchars_decode(stripslashes($detail['title']))); ?>`;
        const titleWithoutTags = abstractTitle.replace(/&nbsp;/g, ' ');
        const topic = "<?php echo $topic; ?>";
        const idx = "<?php echo $submission_idx; ?>"

        $.ajax({
                url: "https://imcvp.org/main/" + "ajax/client/ajax_gmail.php",
                type: "POST",
                data: {
                    flag: "abstract_etc2",
                    idx : idx,
                    org : org,
                    email: email,
                    name: nickname,
                    title: titleWithoutTags,
                    topic_text: topic,
                    mail_status : mailValue
                },
                dataType: "JSON",
                success: function(res) {
                    if(res.code === 200){
                        alert("초록 채택 메일 발송 완료했습니다.")
                        loading.style.display = "none"
                    }else{
                        alert("초록 채택 메일 발송 실패했습니다.")
                    }
                }
            });
        }
</script>
<?php include_once('./include/footer.php'); ?>