<script type="text/javascript">
function printdoc()
{
	var string = document.getElementById("sale_id").innerText.trim();
	if(!string){
		string = document.getElementById("sale_id").innerText.trim();
	}
	var sale_id = string.match(/\d+/)[0];
	console.log(sale_id);
	var ip = location.host;
	var url = "http://"+ip+"/extra/printRepeatedReceipts.php?sale_id="+sale_id;
	console.log(url);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
		}
	};
	xmlhttp.open("GET", url  , true);
	xmlhttp.send();

}
</script>