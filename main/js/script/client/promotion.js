$(document).ready(function() {

    $(".apply_btn").on("click", function () {
        const promotionCode = $("input[name=promotion_code]").val();
        const recommender = $("input[name=recommended_by]").val();

        if($("input[name=reg_fee]").val()==0){
            alert("Please Check the paticipation type");
            return
        }

        if (!promotionCode) {
            $("input[name=promotion_code]").focus();
            alert("Please Enter the code.");
            return
        }

        // if (!recommender) {
        //     $("input[name=recommended_by]").focus();
        //     alert("Please Enter the recommender.");
        //     return
        // }

        select_promotion_code(promotionCode,recommender);
    });

    function select_promotion_code(promotion_code, recommender) {
        $.ajax({
            url: PATH + "ajax/client/ajax_promotion.php",
            type: "POST",
            data: {
                flag: "select",
                promotion_code: promotion_code
            },
            dataType: "JSON",
            success: function (res) {
                if (res.code == 200) {
                    var result=res.result;
                    if(result.count_limit==0){
                        alert("This code has already been used.");
                        $("input[name=promotion_code]").val('');
                        $("input[name=recommended_by]").val('');
                        return;
                    } else{
                        var discount_rate=result.discount_rate;
                            $("input[name=promotion_code_idx]").val(result.idx).change();
                            if(discount_rate == 0){
                                $("input[name=promotion_confirm_code]").val(0).change();
                            } else if (discount_rate == 1) {
                                $("input[name=promotion_confirm_code]").val(1).change();
                            } else if (discount_rate == 2) {
                                $("input[name=promotion_confirm_code]").val(2).change();
                        }
                    }
                } else {
                    alert("Please check the promotion code.");
                    return;
                }
            }
        });
    }

});