	   $(document).ready(function(e) {
		   $('#demo-alert').on('click', function(){
                notify({
                    type: "alert", //alert | success | error | warning | info
                    title: "Alert",
                    message: "jQuery Notify.js Demo. Super simple Notify plugin.",
                    position: {
                        x: "right", //right | left | center
                        y: "top" //top | bottom | center
                    },
                    icon: '<img src="images/paper_plane.png" />', //<i>
                    size: "normal", //normal | full | small
                    overlay: false, //true | false
                    closeBtn: true, //true | false
                    overflowHide: false, //true | false
                    spacing: 20, //number px
                    theme: "default", //default | dark-theme
                    autoHide: true, //true | false
                    delay: 2500, //number ms
                    onShow: null, //function
                    onClick: null, //function
                    onHide: null, //function
                    template: '<div class="notify"><div class="notify-text"></div></div>'
                });
           });
		   
        $('#demo-success').on('click', function(){
                notify({
                    type: "success", //alert | success | error | warning | info
                    title: "Success",
                    position: {
                        x: "right", //right | left | center
                        y: "top" //top | bottom | center
                    },
                    icon: '<img src="../images/success.png" />',
                    message: "jQuery Notify.js Demo. Super simple Notify plugin.",
                    autoHide: true, //true | false
                    delay: 2500 //number ms
                });
        });
        
        $('#demo-warning').on('click', function(){
                notify({
                    type: "warning", //alert | success | error | warning | info
                    title: "Warning",
                    //theme: "dark-theme",
                    position: {
                        x: "right", //right | left | center
                        y: "top" //top | bottom | center
                    },
                    icon: '<img src="images/notice.png" />',
                    message: "jQuery Notify.js Demo. Super simple Notify plugin.",
                    autoHide: true, //true | false
                    delay: 2500 //number ms
                });
        });

        $('#demo-error').on('click', function(){
                notify({
                    type: "error", //alert | success | error | warning | info
                    title: "Error",
                    //theme: "dark-theme",
                    position: {
                        x: "right", //right | left | center
                        y: "top" //top | bottom | center
                    },
                    icon: '<img src="images/error.png" />',
                    message: "jQuery Notify.js Demo. Super simple Notify plugin.",
                    autoHide: true, //true | false
                    delay: 2500 //number ms
                });
        });
        
        $('#demo-info').on('click', function(){
                notify({
                    type: "info", //alert | success | error | warning | info
                    title: "Info",
                    //theme: "dark-theme",
                    position: {
                        x: "right", //right | left | center
                        y: "top" //top | bottom | center
                    },
                    icon: '<img src="images/info.png" />',
                    message: "jQuery Notify.js Demo. Super simple Notify plugin.",
                    autoHide: true, //true | false
                    delay: 2500 //number ms
                });
        });
    });