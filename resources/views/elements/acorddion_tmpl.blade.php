
<script id="tmpl-accordion-add" type="text/x-dot-template">
<div class="card">
	<div class="card-header">
		<h5>
		<button class="btn btn-link" data-toggle="collapse" data-target="{%=it.targetContent%}" aria-expanded="true" aria-controls="{%=it.targetContent.substring(1)%}">
			{%=it.titleHead%}
 		</button>
		</h5>
		
		
	</div>
	<div id="{%=it.targetContent.substring(1)%}" class="collapse" data-parent="{%=it.target%}">
		<div  class="card-body" >
			{%=it.body %}
		</div>
	</div>
</div>

</script>