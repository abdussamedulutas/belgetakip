function Notify(){};
function Server(){};

Server._ajax = function(url,data,callback,uploadEvent){
    var xhttp;
    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    } else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    };
    callback && xhttp.addEventListener("load",function(){
        var t = xhttp.getResponseHeader("Content-Type");
        if(t.indexOf("application/json") != -1)
        {
            callback(JSON.parse(xhttp.responseText));
        }else{
            callback(xhttp.responseText)
        }
    });
    uploadEvent && oReq.upload.addEventListener("progress",function(oEvent){
        if (oEvent.lengthComputable) {
          var percentComplete = oEvent.loaded / oEvent.total * 100;
          uploadEvent(percentComplete);
        }
    });
    xhttp.open("POST", url, true);
    xhttp.send(data);
    return xhttp;
}
Notify.errorText = function(title,text,t){
    var k = {
        title: title,
        text: text,
        icon: 'icon-blocked',
        type: 'error'
    };
    if(t){
        t.update(k);
        return t;
    }else return new PNotify(k);
}
Notify.successText = function(title,text,t){
    var k = {
        title: title,
        text: text,
        icon: 'icon-checkmark3',
        type: 'success'
    };
    if(t){
        t.update(k);
        return t;
    }else return new PNotify(k);
}
Notify.progress = function(title,text,t)
{
    var k = {
        title:title,
        text: text,
        addclass: 'bg-primary',
        type: 'info',
        icon: 'icon-spinner4 spinner',
        hide: false,
        buttons: {
            closer: false,
            sticker: false
        },
        opacity: .9
    };
    if(t){
        t.update(k);
        return t;
    }else return new PNotify(k);
}
Notify.failedForm = function(title,text,t){
    var k = {
        title: title,
        text: text,
        icon: 'icon-blocked',
        type: 'error',
        buttons: {
            closer: true
        }
    };
    if(t){
        t.update(k);
    }else t = new PNotify(k);
    setTimeout(function(){
        t.remove();
    },3000);
};

Server.Login = function(form)
{
    var progress = Notify.progress("Kullanıcı Hesabı","Oturum Açılıyor");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","Login");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            setTimeout(function(){
                Notify.successText("Kullanıcı Hesabı","Oturum Açıldı<br>Yönlendiriliyorsunuz...",progress);
                setTimeout(function(){
                    window.location = '/'
                },500)
            },1000);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Form Reddedildi",ans.data.text,progress);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                }
                case "NOUSER":{
                    Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress);
                }
            }
        }
    });
};
