function buildAnthroPanel(availableMeasures){

// LOAD DATA IN ANTHROPOMETRY PANE	
availableMeasures = availableMeasures.split(",");
var numberOfEntries = availableMeasures.length;
var anthro_html = '';
var anthroPopup = '';
	
	anthro_html+='<fieldset data-role="controlgroup" data-mini="true">';
	anthro_html+='<ul data-role="listview" data-split-icon="info" data-split-theme="a" data-inset="true">';
	anthro_html+='<li ><a style="padding:0;"><input type="checkbox" checked="checked" name="STATURE" id="STATURE" onChange="dimSwitch(\'STATURE\');" data-mini="true"/>';
	anthro_html+='<label style="border:none !important; " for="STATURE">Stature</label></a>';
	anthro_html+='<a href="#popup_STATURE" data-rel="popup"></a></li>';
	anthro_html+='<li ><a style="padding:0;"><input type="checkbox" checked="checked" name="BMI" id="BMI" onChange="dimSwitch(\'BMI\');" data-mini="true"/>';
	anthro_html+='<label style="border:none !important; " for="BMI">BMI</label></a>';
	anthro_html+='<a href="#popup_BMI" data-rel="popup"></a></li>';
	anthro_html+='</ul>';
	anthro_html+='</fieldset>';

	anthro_html+='<div data-role="collapsible" data-mini="true"><h5>Whole body &amp; functional measures</h5><fieldset data-role="controlgroup" id="whole_body_fieldset" data-mini="true">';
	anthro_html+='<ul data-role="listview" data-split-icon="info" data-split-theme="a" data-inset="true">';
	for (i=1; i<numberOfEntries; i++){
		if (category[availableMeasures[i]]=='1_whole_body') {
			anthro_html+='<li><a style="padding:0;"><input type="checkbox" name="' + availableMeasures[i] + '" id="' + availableMeasures[i] + '" onClick="dimSwitch(\'' + availableMeasures[i] + '\');" />';
			anthro_html+='<label style="border:none !important; " for="' + availableMeasures[i] + '">' + fullName[availableMeasures[i]] + '</label></a>';
			anthro_html+='<a href="#popup_'+availableMeasures[i]+'" data-rel="popup"></a></li>';
			anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_'+availableMeasures[i]+'" data-role="popup"  data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName[availableMeasures[i]]+'</h3><img src="./images/anthro/'+image[availableMeasures[i]]+'" style="float:left;max-width:200px;max-height:300px;margin-right:10px;"><p>'+description[availableMeasures[i]]+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_'+availableMeasures[i]+'\').popup(\'close\');">Close</a></p></div>';
		}
	}
	anthro_html+='</ul></fieldset></div>';
	
	anthro_html+='<div data-role="collapsible" data-mini="true"><h5>Head measures</h5><fieldset data-role="controlgroup" id="head_fieldset" data-mini="true">';
	anthro_html+='<ul data-role="listview" data-split-icon="info" data-split-theme="a" data-inset="true">';
	for (i=1; i<numberOfEntries; i++){
		if (category[availableMeasures[i]]=='2_head') {
			anthro_html+='<li ><a style="padding:0;"><input type="checkbox" name="' + availableMeasures[i] + '" id="' + availableMeasures[i] + '" onClick="dimSwitch(\'' + availableMeasures[i] + '\');" />';
			anthro_html+='<label style="border:none !important; " for="' + availableMeasures[i] + '">' + fullName[availableMeasures[i]] + '</label></a>';
			anthro_html+='<a href="#popup_'+availableMeasures[i]+'" data-rel="popup"></a></li>';
			anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_'+availableMeasures[i]+'" data-role="popup" data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName[availableMeasures[i]]+'</h3><img src="./images/anthro/'+image[availableMeasures[i]]+'" style="float:left;max-width:200px;max-height:300px;margin-right:10px;"><p>'+description[availableMeasures[i]]+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_'+availableMeasures[i]+'\').popup(\'close\');">Close</a></p></div>';
		}
	}
	anthro_html+='</ul></fieldset></div>';
	
	anthro_html+='<div data-role="collapsible" data-mini="true"><h5>Hand and arm measures</h5><fieldset data-role="controlgroup" id="hands_arms_fieldset" data-mini="true">';	
	anthro_html+='<ul data-role="listview" data-split-icon="info" data-split-theme="a" data-inset="true">';	
	for (i=1; i<numberOfEntries; i++){
		if (category[availableMeasures[i]]=='3_hands_arms') {
			anthro_html+='<li><a style="padding:0;"><input type="checkbox" name="' + availableMeasures[i] + '" id="' + availableMeasures[i] + '" onClick="dimSwitch(\'' + availableMeasures[i] + '\');" />';
			anthro_html+='<label style="border:none !important; " for="' + availableMeasures[i] + '">' + fullName[availableMeasures[i]] + '</label></a>';
			anthro_html+='<a href="#popup_'+availableMeasures[i]+'" data-rel="popup"></a></li>';
			anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_'+availableMeasures[i]+'" data-role="popup" data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName[availableMeasures[i]]+'</h3><img src="./images/anthro/'+image[availableMeasures[i]]+'" style="float:left; max-width:200px;max-height:300px;margin-right:10px;"><p>'+description[availableMeasures[i]]+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_'+availableMeasures[i]+'\').popup(\'close\');">Close</a></p></div>';
		}
	}
	anthro_html+='</ul></fieldset></div>';
	
	anthro_html+='<div data-role="collapsible" data-mini="true"><h5>Torso measures</h5><fieldset data-role="controlgroup" id="torso_fieldset" data-mini="true">';
	anthro_html+='<ul data-role="listview" data-split-icon="info" data-split-theme="a" data-inset="true">';	
	for (i=1; i<numberOfEntries; i++){
		if (category[availableMeasures[i]]=='4_torso') {
			anthro_html+='<li ><a style="padding:0;"><input type="checkbox" name="' + availableMeasures[i] + '" id="' + availableMeasures[i] + '" onClick="dimSwitch(\'' + availableMeasures[i] + '\');" />';
			anthro_html+='<label style="border:none !important; " for="' + availableMeasures[i] + '">' + fullName[availableMeasures[i]] + '</label></a>';
			anthro_html+='<a href="#popup_'+availableMeasures[i]+'" data-rel="popup"></a></li>';
			anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_'+availableMeasures[i]+'" data-role="popup" data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName[availableMeasures[i]]+'</h3><img src="./images/anthro/'+image[availableMeasures[i]]+'" style="float:left;max-width:200px;max-height:300px;margin-right:10px;"><p>'+description[availableMeasures[i]]+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_'+availableMeasures[i]+'\').popup(\'close\');">Close</a></p></div>';
		}
	}
	anthro_html+='</ul></fieldset></div>';
	
		
	anthro_html+='<div data-role="collapsible" data-mini="true"><h5>Foot and leg measures</h5><fieldset data-role="controlgroup" id="feet_legs_fieldset" data-mini="true">';
	anthro_html+='<ul data-role="listview" data-split-icon="info" data-split-theme="a" data-inset="true">';	
	for (i=1; i<numberOfEntries; i++){
		if (category[availableMeasures[i]]=='5_feet_legs') {
			anthro_html+='<li ><a style="padding:0;"><input type="checkbox" name="' + availableMeasures[i] + '" id="' + availableMeasures[i] + '" onClick="dimSwitch(\'' + availableMeasures[i] + '\');" />';
			anthro_html+='<label style="border:none !important; " for="' + availableMeasures[i] + '">' + fullName[availableMeasures[i]] + '</label></a>';
			anthro_html+='<a href="#popup_'+availableMeasures[i]+'" data-rel="popup"></a></li>';
			anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_'+availableMeasures[i]+'" data-role="popup" data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName[availableMeasures[i]]+'</h3><img src="./images/anthro/'+image[availableMeasures[i]]+'" style="float:left;max-width:200px;max-height:300px;margin-right:10px;"><p>'+description[availableMeasures[i]]+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_'+availableMeasures[i]+'\').popup(\'close\');">Close</a></p></div>';
		}
	}
	anthro_html+='</ul></fieldset></div>';
	
anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_STATURE" data-role="popup" data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName['STATURE']+'</h3><img src="./images/anthro/'+image['STATURE']+'" style="float:left;max-width:200px;max-height:300px;margin-right:10px;"><p>'+description['STATURE']+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_STATURE\').popup(\'close\');">Close</a></p></div>';
anthroPopup+='<div class="anthro_popup" data-theme="g" id="popup_BMI" data-role="popup" data-arrow="l" style="max-width:400px"><h3 style="text-align:center">'+fullName['BMI']+'</h3><p>'+description['BMI']+'</p><br style="clear:both"><p style="text-align:center"><a href="#" onClick="$(\'#popup_BMI\').popup(\'close\');">Close</a></p></div>';

$('#anthroPopups').html(anthroPopup);
$('#anthroPopups div').popup();

$('#anthroPickerForm').html(anthro_html).trigger('create');

}