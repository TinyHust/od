<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	@font-face {font-family: nbfonteed72e9e24;src: local('?'), url('http://dev.cmsmart.net:3000/wp46/wp-content/uploads/nbdesigner/fonts/2017/06/17/nbfonteed72e9e24.ttf') format('truetype')}
</style>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>

<script type="text/javascript">
(function(c) {
    var b, d, e, f, g, h = c.body,
        a = c.createElement("div");
    a.innerHTML = '<span style="' + ["position:absolute", "width:auto", "font-size:128px", "left:-99999px"].join(" !important;") + '">' + Array(100).join("wi") + "</span>";
    a = a.firstChild;
    b = function(b) {
        a.style.fontFamily = b;
        h.appendChild(a);
        g = a.clientWidth;
        h.removeChild(a);
        return g
    };
    d = b("monospace");
    e = b("serif");
    f = b("sans-serif");
    window.isFontAvailable = function(a) {
		console.log(b(a + ",monospace"));
		console.log(b(a + ",sans-serif"));
		console.log(b(a + ",serif"));
        return d !== b(a + ",monospace") || f !== b(a + ",sans-serif") || e !== b(a + ",serif")
    }
})(document);
console.log(isFontAvailable('Roboto'));
setTimeout(function(){
	console.log(isFontAvailable('Roboto'));
}, 3000);

</script>
</body>
</html>