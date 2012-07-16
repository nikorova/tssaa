// NOT FIT FOR USE WITHOUTH TWEAKING
// override sha1.js default setting.
b64pad  = "=";

function calc() {
     var f = document.forms['f'];
     var userName = f.elements['username'].value;
     var password = f.elements['password'].value;
     var nonce = f.elements['nonce'].value;
     var autoNonce = f.elements['autoNonce'].checked;
     if (autoNonce) {         
         nonce = generateNonce(16);
         f.elements['nonce'].value = nonce;
     }

     var nonce64 = base64encode(nonce);
     var created = f.elements['created'].value;
     var autoCreated = f.elements['autoCreated'].checked;

     if (autoCreated) {
         created = getW3CDate(new Date());
         f.elements['created'].value = created;
     }

     var before = f.elements['before'].value;
     var after = f.elements['after'].value;

     var basicUsername = f.elements['basicUsername'].value;
     var basicPassword = f.elements['basicPassword'].value;
     var basicAuth = "";
     if (basicUsername != null && basicUsername != "" ||
         basicPassword != null && basicPassword != "") {
         basicAuth = "Authorization: Basic " + base64encode(basicUsername + ":" + basicPassword) + "\n";
     }

     var passwordDigest = b64_sha1(nonce + created + password);
     f.elements['output'].value = 
         before
         + "X-WSSE: UsernameToken Username=\"" 
         + userName + "\", PasswordDigest=\""
         + passwordDigest + "\", Nonce=\""
         + nonce64 + "\", Created=\""
         + created + "\"\n"
         + basicAuth
         + after;
     
}


function generateNonce(length) {
    var nonceChars = "0123456789abcdef";
    var result = "";
    for (var i = 0; i < length; i++) {
        result += nonceChars.charAt(Math.floor(Math.random() * nonceChars.length));
    }
    return result;
}

function getW3CDate(date) {
    var yyyy = date.getUTCFullYear();
    var mm = (date.getUTCMonth() + 1);
    if (mm < 10) mm = "0" + mm;
    var dd = (date.getUTCDate());
    if (dd < 10) dd = "0" + dd;
    var hh = (date.getUTCHours());
    if (hh < 10) hh = "0" + hh;
    var mn = (date.getUTCMinutes());
    if (mn < 10) mn = "0" + mn;
    var ss = (date.getUTCSeconds());
    if (ss < 10) ss = "0" + ss;
    return yyyy+"-"+mm+"-"+dd+"T"+hh+":"+mn+":"+ss+"Z";
}
