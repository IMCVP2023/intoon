$(document).ready(function() {
    let checkIsAlarm = false;
    let checkPermission = false;

    const getIsAlarm = () => {
        $.ajax({
            url: PATH + "ajax/client/ajax_app_setting.php",
            type: "POST",
            data: {
                flag: "select"
            },
            dataType: "JSON",
            success: function (res) {
                if (res.code === 200) {
                    if(res.is_alarm === 'Y') {
                        checkIsAlarm=true
                        $("#app_push_switch").prop("checked", true);
                    }else {
                        checkIsAlarm=false
                        $("#app_push_switch").prop("checked", false);
                        updateIsAlarm(false)
                    }
                } else {
                    alert("select permission error.");
                    return;
                }
            }
        });
    }

    getIsAlarm();

    if (typeof (window.AndroidScript) != "undefined" && window.AndroidScript != null) {
        window.AndroidScript.checkNotiPermission();
    } else if (window.webkit && window.webkit.messageHandlers != null) {
        try {
            window.webkit.messageHandlers.checkNotiPermission.postMessage('');
        } catch (err) {
            console.log(err);
        }
    }

    checkNotiPermissionCallback = async (res) => {
        await getIsAlarm()

        const result = JSON.parse(res);
        checkPermission = result

        if(result===null){
            alert("callback error");
            return;
        }

        if(result === false) {
            $("#app_push_switch").prop("checked", false);
        }else {
            $("#app_push_switch").prop("checked", checkIsAlarm);
        }

        updateIsAlarm(result);

    }

    moveSettingPageDone = (res) => {
        const result = JSON.parse(res);

        if(result===false){
            $("#app_push_switch").prop("checked", false);
            updateIsAlarm(result);
        }
        checkPermission = result;
    }

    function updateIsAlarm(_isAlarm){
        $.ajax({
            url: PATH + "ajax/client/ajax_app_setting.php",
            type: "POST",
            data: {
                flag: "update",
                is_alarm : _isAlarm ? 'Y' : 'N'
            },
            dataType: "JSON",
            success: function (res) {
                if (res.code === 200) {
                    // app_push_switch 버튼 토글
                    //$("#app_push_switch").prop("checked", true);
                } else {
                    alert("update permission error.");
                    return;
                }
            }
        });
    }

    $('input[type=checkbox][id=app_push_switch]').change(function(e) {

        if(checkPermission === false) {
            if (typeof (window.AndroidScript) != "undefined" && window.AndroidScript != null) {
                window.AndroidScript.moveSettingPage();
            } else if (window.webkit && window.webkit.messageHandlers != null) {
                try {
                    window.webkit.messageHandlers.moveSettingPage.postMessage('');
                } catch (err) {
                    console.log(err);
                }
            }
            $("#app_push_switch").prop("checked", false);
            return
        }
        const isAlarm = $('#app_push_switch').is(':checked');

        updateIsAlarm(isAlarm);
    });

});