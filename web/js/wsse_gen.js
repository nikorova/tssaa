// WS-Security WSSE Nonce Generator
function generateNonce(length) {
    var nonceChars = "0123456789abcdef";
    var result = "";
    for (var i = 0; i < length; i++) {
        result += nonceChars.charAt(Math.floor(Math.random() * nonceChars.length));
    }
    return result;
}

// ISO8601 Date String Generator
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
