<?php

if (empty($_SESSION["USER"])) {
    echo "
            <script>
                if (typeof(window.AndroidScript) != 'undefined' && window.AndroidScript != null) {
                    window.AndroidScript.logout();
                    window.location.href = '/main/app_login.php';
                }
            
                if (webkit.messageHandlers!=null) {
                    try{
                        window.webkit.messageHandlers.logout.postMessage('');
                        window.location.href = '/main/app_login.php';
                    } catch (err){
                        console.log(err);
                    }
                }
            </script>
        ";
}
?>
<script>
    if (typeof(window.AndroidScript) != "undefined" && window.AndroidScript != null) {
        try{
            window.AndroidScript.getDeviceToken();
        } catch (err){
            alert(err);
        }
    } else if (window.webkit && window.webkit.messageHandlers!=null) {
        try{
            window.webkit.messageHandlers.getDeviceToken.postMessage('');
        } catch (err){
            console.log(err);
        }
    }

    getDeviceTokenCallback = (device, deviceToken) => {

        $.ajax({
            url: "./ajax/client/ajax_app_check.php",
            type: "POST",
            data: {
                flag: "updateDeviceToken",
                device: device,
                deviceToken: deviceToken
            },
            dataType: "JSON",
            success: function (res) {
                //alert("hello");
		    }
        });
    }
</script>