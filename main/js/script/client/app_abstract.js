function openPDF(path) {
    if(path==='javascript:void(0)') {
        alert('Updates are planned.')
        return false;
    } else {
        if (typeof (window.AndroidScript) != "undefined" && window.AndroidScript != null) {
            window.AndroidScript.openPDF(path);
        } else if (window.webkit && window.webkit.messageHandlers != null) {
            try {
                window.webkit.messageHandlers.openPDF.postMessage(path);
            } catch (err) {
                console.log(err);
            }
        }
    }
}

function selectAbstract(){
    let category_idx = $("#abstract_category option:selected").val();

    $.ajax({
        url: PATH + "ajax/client/ajax_app_abstract.php",
        type: "POST",
        data: {
            flag: "select",
            category_idx : category_idx
        },
        dataType: "JSON",
        success: function (res) {
            if (res.code == 200) {
                let abstract_list = res.result;
                console.log(res);
                let _html = "";
                $('.pdf_list').html(_html);

                Object.values(abstract_list).forEach(al=> {
                    if(al.path==null){
                        al.path='javascript:void(0)'
                    }
                    _html += '<li class="pdf"><a href="'+al.path+'" class="pdf_viewer">' + al.name + '</a></li>';
                });

                $('.pdf_list').html(_html);

                $(".pdf_viewer").click(function(event){
                    event.preventDefault();
                    let path = event.target.href;
                    openPDF(path);
                });
            } else {
                alert("abstract error.");
                return;
            }
        }
    });
}