jQuery(document).ready(function() {
	//alert('Document Ready to be processed by javascript');
	
	//
	// Initializing default values
	//
    
    showHideDisabilityDescriptionPanel();

    $('#has_disability').on('change', function(){
		//alert('item changed');
		showHideDisabilityDescriptionPanel();
    });
	
});


// Show or Hide the Applicant General disability description depending on the has_disability
function showHideDisabilityDescriptionPanel(){
    if ($('#has_disability').val() == 0){
        $('#disability_description').hide();
    } else {
        $('#disability_description').show();
    }
}
