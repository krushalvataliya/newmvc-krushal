var ajax = {
	"method":"b",
	"a1":"b",
	"aqw":"b",
	'setMethod':function(method) {
		return this.method = method;
	},
	'getMethod':function() {
		return this.method;
	}
}

ajax.setMethod('dd');
console.log(ajax.getMethod());
console.log(ajax);