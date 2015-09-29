<!-- This file has to be required inside every page that uses translation for their included JS files -->
<script>
	var json = <?php echo $i18n->getJsonClientLang();?>;

	function translate(key){
		var result = "";
		if (json[key] != undefined){
			result = (json[key]);
		}
		return result;
	}
</script>