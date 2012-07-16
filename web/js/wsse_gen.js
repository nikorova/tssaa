// abstractificated wsse header generator

// lol headers
//"X-WSSE: UsernameToken Username=\"" 
//         + userName + "\", PasswordDigest=\""
//         + passwordDigest + "\", Nonce=\""
//         + nonce64 + "\", Created=\""
//         + created + "\"\n"

// more or less workflow
//generated_nonce = generateNonce(16);
//nonce64 = base64encode(generated_nonce);
//created = getW3CDate(new Date());
//password = scrapePassword();
//digest = b64_sha1(generated_nonce, created, password);

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
