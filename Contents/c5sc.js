function Notify(){};
function Server(){};

var dd = function(x,d){
    return ("00" + x).slice(d||-2)
};

function toExcel(pin,name)
{
    $(pin).table2excel({
        name: name,
        filename: name+".xls",
        preserveColors: false // set to true if you want background colors and font colors preserved
    });
}
function Tarih(date)
{
    var _d = new Date(date);
    var year = dd(_d.getFullYear(),4);
    var month = dd(_d.getMonth()+1,2);
    var day = dd(_d.getDate(),2);
    var hour = dd(_d.getHours(),2);
    var minute = dd(_d.getMinutes(),2);
    return `${hour}:${minute} | ${day}/${month}/${year}`;
}

Server._ajax = function(url,data,callback,error,uploadEvent){
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
    error && xhttp.addEventListener("error",function(){
        var t = xhttp.getResponseHeader("Content-Type");
        if(t.indexOf("application/json") != -1)
        {
            error(JSON.parse(xhttp.responseText));
        }else{
            error(xhttp.responseText)
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
Notify.confirm = function(opt){
    swal({
        title: opt.title,
        text: opt.text,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: opt.confirmText || "Tamam",
        cancelButtonText: opt.cancelText || "İptal"
    },function(thn){
        if(thn) opt.confirm();
        else opt.cancel&&opt.cancel();
    })
}
Notify.errorText = function(title,text,t,delay){
    var k = {
        title: title,
        text: text,
        icon: 'icon-blocked',
        type: 'error'
    };
    if(t){
        t.update(k);
    }else t = new PNotify(k);
    if(delay) setTimeout(function(){
        t.remove();
    },delay);
    return t;
}
Notify.successText = function(title,text,t,delay){
    var k = {
        title: title,
        text: text,
        icon: 'icon-checkmark3',
        type: 'success'
    };
    if(t){
        t.update(k);
    }else t = new PNotify(k);
    if(delay) setTimeout(function(){
        t.remove();
    },delay);
    return t;
}
Notify.progress = function(title,text,t,delay){
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
    }else t = new PNotify(k);
    if(delay) setTimeout(function(){
        t.remove();
    },delay);
    return t;
}
Notify.failedForm = function(title,text,t,delay){
    var k = {
        title: title,
        text: text,
        icon: 'icon-blocked',
        type: 'error'
    };
    if(t){
        t.update(k);
    }else t = new PNotify(k);
    if(delay) setTimeout(function(){
        t.remove();
    },delay);
    return t;
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
                    window.location = ans.data.newURL;
                },500)
            },1000);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Form Reddedildi",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "NOUSER":{
                    Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    });
};
Server.yeniAcente = function(form)
{
    var progress = Notify.progress("Acente","Yeni Acente Oluşturuluyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","yeniAcente");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            Notify.successText("Acente Oluşturma","Yeni Acente oluşturdunuz",progress,3000);
            setTimeout(function(){
                window.location = ans.data.path;
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Acente Oluşturma",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS":{
                    Notify.failedForm("Acente Oluşturma",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    });
};
Server.changeAcenteName = function(form)
{
    var progress = Notify.progress("Acente","Değişim iletiyor...");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","changeAcenteName");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            Notify.successText("Acente Oluşturma","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location = ans.data.path;
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Acente Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS":{
                    Notify.failedForm("Acente Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    });
};
Server.deletePersonel = function(id,callback,infoCallback)
{
    var data = new FormData();
    data.append("action","deletePersonel");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
        }else if(ans.status == "fail"){
            infoCallback();
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    });
};
Server.deleteKullanici = function(id,callback,infoCallback)
{
    var data = new FormData();
    data.append("action","deleteKullanici");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
        }else if(ans.status == "fail"){
            infoCallback();
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    });
};

Server.deleteYonetici = function(id,callback,infoCallback)
{
    var data = new FormData();
    data.append("action","deleteAdmin");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
        }else if(ans.status == "fail"){
            infoCallback();
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    });
};
Server.deleteAcente = function(id,callback,infoCallback)
{
    var data = new FormData();
    data.append("action","deleteAcente");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
        }else if(ans.status == "fail"){
            infoCallback();
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu");
    });
};
Server.createPersonel = function(form)
{
    var progress = Notify.progress("Personel Oluşturma","Personel Bilgileri İletiliyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","createPersonel");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            $("#add-personel").modal("hide");
            Notify.successText("Personel Oluşturma","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location.reload();
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Personel Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS":{
                    Notify.failedForm("Personel Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.editPersonel = function(form)
{
    var progress = Notify.progress("Personel Düzenleme","Personel Bilgileri İletiliyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","editPersonel");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            Notify.successText("Personel Düzenleme","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location.reload();
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Personel Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS ":{
                    Notify.failedForm("Personel Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.getPersonelInfo = function(id,btn,callback)
{
    var progress = Notify.progress("Personel","Personel Bilgileri Alınıyor");
    var btnText = $(btn).text();
    $(btn).html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData();
    data.append("action","getPersonelInfo");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(btn).html(btnText).removeAttr("disabled","");
        if(ans.status == "success")
        {
            progress.remove();
            callback(ans.data);
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        $(btn).html(btnText);
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.createKullanici = function(form)
{
    var progress = Notify.progress("Kullanıcı Oluşturma","Kullanıcı Bilgileri İletiliyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","createKullanici");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            $("#add-personel").modal("hide");
            Notify.successText("Kullanıcı Oluşturma","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location.reload();
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS":{
                    Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.editKullanici = function(form)
{
    var progress = Notify.progress("Kullanıcı Düzenleme","Kullanıcı Bilgileri İletiliyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","editKullanici");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            Notify.successText("Kullanıcı Düzenleme","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location.reload();
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS ":{
                    Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.getKullaniciInfo = function(id,btn,callback)
{
    var progress = Notify.progress("Kullanıcı","Kullanıcı Bilgileri Alınıyor");
    var btnText = $(btn).text();
    $(btn).html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData();
    data.append("action","getKullaniciInfo");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(btn).html(btnText).removeAttr("disabled","");
        if(ans.status == "success")
        {
            progress.remove();
            callback(ans.data);
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        $(btn).html(btnText);
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.createAdmin = function(form)
{
    var progress = Notify.progress("Yönetici Oluşturma","Yönetici Bilgileri İletiliyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","createAdmin");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            $("#add-personel").modal("hide");
            Notify.successText("Yönetici Oluşturma","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location.reload();
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Yönetici Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS":{
                    Notify.failedForm("Yönetici Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.editAdmin = function(form)
{
    var progress = Notify.progress("Yönetici Düzenleme","Yönetici Bilgileri İletiliyor");
    var btnText = $(form).find(".actionbtn").text();
    $(form).find(".actionbtn").html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData(form);
    $(form).find(".validation-error-label").remove();
    data.append("action","editAdmin");
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(form).find(".actionbtn").html(`${btnText}`).removeAttr("disabled");
        if(ans.status == "success")
        {
            Notify.successText("Yönetici Düzenleme","Değişim kaydedildi",progress,3000);
            setTimeout(function(){
                window.location.reload();
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    Notify.failedForm("Yönetici Hesabı",ans.data.text,progress,3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                    break;
                }
                case "ALREADYEXISTS ":{
                    Notify.failedForm("Yönetici Hesabı",ans.data.text,progress,3000);
                    break;
                }
                default:{
                    progress.remove();
                }
            }
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.getAdminInfo = function(id,btn,callback)
{
    var progress = Notify.progress("Yönetici","Yönetici Bilgileri Alınıyor");
    var btnText = $(btn).text();
    $(btn).html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    var data = new FormData();
    data.append("action","getAdminInfo");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        $(btn).html(btnText).removeAttr("disabled","");
        if(ans.status == "success")
        {
            progress.remove();
            callback(ans.data);
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        $(btn).html(btnText);
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};

Server.createFormType = function(name,callback)
{
    var progress = Notify.progress("Form Türü","Bilgiler iletiliyor");
    var data = new FormData();
    data.append("action","createFormType");
    data.append("name",name);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
            progress.remove();
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.updateFormType = function(id,name,callback)
{
    var progress = Notify.progress("Form Türü","Bilgiler iletiliyor");
    var data = new FormData();
    data.append("action","updateFormType");
    data.append("id",id);
    data.append("name",name);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
            progress.remove();
            Notify.successText("Form Türü","Başarıyla güncellendi",progress,3000);
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.deleteFormType = function(id,callback)
{
    var progress = Notify.progress("Form Türü","Bilgiler iletiliyor");
    var data = new FormData();
    data.append("action","deleteFormType");
    data.append("id",id);
    data.append("language",navigator.language);
    Server._ajax(window.location.pathname,data,function(ans) {
        if(ans.status == "success")
        {
            callback();
            progress.remove();
            Notify.successText("Form Türü","Başarıyla silindi",progress,3000);
        }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
    });
};
Server.request = function(obj,callback)
{
    var data;
    if(obj instanceof FormData){
        data = obj;
    }else{
        data = new FormData();
        for(var name in obj){
            data.append(name,obj[name]);
        };
    }
    data.append("language",navigator.language);
    Server._ajax(window.location,data,function(ans) {
        callback(ans);
    },function(){
        errcallback && errcallback();
    });
};
function reinitialize()
{
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            infoFiltered:"(_MAX_ kayıt filtrelendi)",
            info:"_TOTAL_ kayıttan _START_ ile _END_ arası gösteriliyor",
            zeroRecords: "Hiç bir şey yok",
            infoEmpty: "Herhangi bir kayıt yok",
            search: '<span>Filtre:</span> _INPUT_',
            searchPlaceholder: 'Arama...',
            lengthMenu: '<span>Girdi Sayısı:</span> _MENU_',
            paginate: { 'first': 'İlk', 'last': 'Son', 'next': 'Sonraki', 'previous': 'Önceki' },
            emptyTable:"Veri yok"
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $(".datatablepin:not(.inited)").each(function(){
        $(this).DataTable({
            colReorder: true,
            fixedHeader: {
                header: true,
                footer: true
            },
            paginate:false,
            searching:!$(this).hasClass("no-searching"),
            ordering: !$(this).hasClass("no-order")
        });
    });
    $('.pickadate:not(.inited)').pickadate({
        monthsFull: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
        monthsShort: ['Ock', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağus', 'Eyl', 'Ekm', 'Kas', 'Ar'],
        weekdaysFull: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşemde', 'Cuma', 'Cumartesi'],
        weekdaysShort: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt'],
        format: 'yyyy-m-d',
    });
    $(".select2:not(.inited):not(.no-search)").select2({
        "language": {
            "noResults": function(){
                return "Burası Boş";
            }
        },
    });
    $(".select2:not(.inited).no-search").select2({
        "minimumResultsForSearch":-1,
        "language": {
            "noResults": function(){
                return "Burası Boş";
            }
        }
    });
    $('.datatablepin:not(.inited),.pickadate:not(.inited),.select2:not(.inited)').addClass("inited");
}
function block(id)
{
    var k = $(id).block({ 
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });
    return function(){
        k.unblock();
    };
}
reinitialize();
window.wait2 = (window.requestIdleCallback !== undefined ? window.requestIdleCallback : function(C){setTimeout(C,1)});
function blockbtn(btn)
{
    var btnText = $(btn).html();
    $(btn).html(`<i class="icon-spin icon-spinner2 spinner"></i> ${btnText}`).attr("disabled","");
    return function(){
        $(btn).html(btnText).removeAttr("disabled");
    }
}