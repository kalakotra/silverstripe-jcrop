<div class="jCrop-field">
	<% if getPredefinedDimensions %>
		<div class="dimensions">
			<strong>Predefined ratio:</strong><br />
			<% loop getPredefinedDimensions %>
				<a data-ref-width="{$Width}" data-ref-height="{$Height}">{$Width}x{$Height}</a>
			<% end_loop %>
		</div>
	<% end_if %>
	<% with $PreviewImage %><img src="$link" alt="" id="target" /><% end_with %>
	<div class="grid" title="Click on the subject of the image to ensure it is not lost during cropping"></div>
	<input $AttributesHTML />
	<input type="text" id="x1_field" value="$getImageFields(x1)" />
	<input type="text" id="y1_field" value="$getImageFields(y1)" />
	<input type="text" id="x2_field" value="$getImageFields(x2)" />
	<input type="text" id="y2_field" value="$getImageFields(y2)" />
</div>