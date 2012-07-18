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

function ISODateString(d) {
	function pad(n) {
		return n<10 ? '0'+n : n;
	}
	return d.getUTCFullYear() + '-'
		+ pad(d.getUTCMonth() +1) + '-'
		+ pad(d.getUTCDate()) + 'T'
		+ pad(d.getUTCHours()) + ':'
		+ pad(d.getUTCMinutes()) + ':'
		+ pad(d.getUTCSeconds()) + 'Z'
}
