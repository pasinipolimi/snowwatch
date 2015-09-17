<script>
	var json = <?php echo $i18n->getJsonLang("client");?>;

	function translate(key){
		var result = "";
		if (json[key] != undefined){
			result = (json[key]);
		}
		return result;
	}
</script>