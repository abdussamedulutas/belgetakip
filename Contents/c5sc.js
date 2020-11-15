function Notify(){};
function Server(){};

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
                    var k = Notify.failedForm("Form Reddedildi",ans.data.text,progress);
                    setTimeout(function(){k.remove()},3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                }
                case "NOUSER":{
                    var k = Notify.failedForm("Kullanıcı Hesabı",ans.data.text,progress);
                    setTimeout(function(){k.remove()},3000);
                }
                default:{
                    progress.remove();
                }
            }
        }
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
            var k = Notify.successText("Acente Oluşturma","Yeni Acente oluşturdunuz",progress);
            setTimeout(function(){
                window.location = ans.data.path;
            },100);
        }else if(ans.status == "fail"){
            switch(ans.code)
            {
                case "REQUIRED_FIELD":
                case "INVALID_FIELD":{
                    var k = Notify.failedForm("Acente Oluşturma",ans.data.text,progress);
                    setTimeout(function(){k.remove()},3000);
                    var t = $("[name='"+ans.data.fieldName+"']").parent();
                    if(t.find(".validation-error-label").length == 0){
                        t.append("<label class='validation-error-label'>"+ans.data.text+"</label>");
                    };
                }
                case "ALREADYEXISTS":{
                    var k = Notify.failedForm("Acente Oluşturma",ans.data.text,progress);
                    setTimeout(function(){k.remove()},3000);
                }
                default:{
                    progress.remove();
                }
            }
        }
    },function(){
        Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress);
    });
};
$.extend($.fn.dataTable.defaults, {
    autoWidth: false,
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
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
$(".datatablepin").DataTable({
    colReorder: true,
    fixedHeader: {
        header: true,
        footer: true
    }
}) 