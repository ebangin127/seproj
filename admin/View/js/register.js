function showSellerOnlyForms(str){
	var els = document.getElementsByClassName("seller-only");
	[].forEach.call(els, function (e) {
		e.style.display = 'block';
	});
}
function hideSellerOnlyForms(sign){
	var els = document.getElementsByClassName("seller-only");
	[].forEach.call(els, function (e) {
		e.style.display = 'none';
	});
}