jQuery(document).ready(function() {
	//alert('Document Ready to be processed by javascript');
	
	//
	// Initializing default values
	//

	showHideInstitutionPanel();

	getInstitutionNamesByCountries($('#selector_education_country').val(), function f(data){
		buildDropdown(data, '#selector_education_institution', 'id', 'name');

		getFacultyNamesByInstitution($('#selector_education_institution').val(), function f(data){
			buildDropdown(data, '#selector_education_faculty', 'id', 'name');

			getCourseNamesByFaculties($('#selector_education_faculty').val(), function f(data){
   				buildDropdown(data, '#selector_education_course', 'id', 'name');
			});
		});
	});

	//getFacultyNamesByInstitution($('#selector_education_institution').val(), function f(data){
	//		buildDropdown(data, '#selector_education_faculty', 'id', 'name');
	//});
	
	//
	// Events
    //
    
    $('#selector_education_level').on('change', function(){
		//alert('item changed');
		showHideInstitutionPanel();
    });

    $('#has_disability').on('change', function(){
		//alert('item changed');
		showHideDisabilityDescriptionPanel();
    });

    $('#selector_education_country').on('change', function(){
		getInstitutionNamesByCountries($('#selector_education_country').val(), function f(data){
   			buildDropdown(data, '#selector_education_institution', 'id', 'name');
   			getFacultyNamesByInstitution($('#selector_education_institution').val(), function f(data){
   				buildDropdown(data, '#selector_education_faculty', 'id', 'name');
	   			getCourseNamesByFaculties($('#selector_education_faculty').val(), function f(data){
		   			buildDropdown(data, '#selector_education_course', 'id', 'name');
				});
			});
		});
    });

    $('#selector_education_institution').on('change', function(){
		getFacultyNamesByInstitution($('#selector_education_institution').val(), function f(data){
   			buildDropdown(data, '#selector_education_faculty', 'id', 'name');
   			getCourseNamesByFaculties($('#selector_education_faculty').val(), function f(data){
	   			buildDropdown(data, '#selector_education_course', 'id', 'name');
			});
		});
    });

    $('#selector_education_faculty').on('change', function(){
		getCourseNamesByFaculties($('#selector_education_faculty').val(), function f(data){
   			buildDropdown(data, '#selector_education_course', 'id', 'name');
		});
    });


});


// Show or Hide the Applicant Education Institution Panel depending on the level of education selected
function showHideInstitutionPanel(){
	if ($('#selector_education_level').val() == 1){
		$('#institution-panel').hide();
	} else {
		$('#institution-panel').show();
	}
}


function getInstitutionNamesByCountries(countryId, dataHandler){
	$.ajax({
        type: "GET",
        url: window.location.protocol+"//" +window.location.host +"/institutionHigherEducations/getNamesByCountry/" + countryId,
        dataType: "json",
        cache: false,

        success: function(data,textStatus,xhr){
        	console.log('Success retrieving getInstitutionNamesByCountries');
        	//console.log(data);
        	dataHandler(data['data']);
        },
        error: function(xhr,textStatus,error){
        	console.log('Error retrieving getInstitutionNamesByCountries');
 			dataHandler(null);
        }
    });
}

function getFacultyNamesByInstitution(institutionId, dataHandler){
	$.ajax({
        type: "GET",
        url: window.location.protocol+"//" +window.location.host +"/institutionHigherEducationFaculties/getNamesByInstitution/" + institutionId,
        dataType: "json",
        cache: false,

        success: function(data,textStatus,xhr){
        	console.log('Success retrieving getFacultyNamesByInstitution');
        	//console.log(data);
        	dataHandler(data['data']);
        },
        error: function(xhr,textStatus,error){
        	console.log('Error retrieving getFacultyNamesByInstitution');
 			dataHandler(null);
        }
    });
}

function getCourseNamesByFaculties(facultyId, dataHandler){
	$.ajax({
        type: "GET",
        url: window.location.protocol+"//" +window.location.host +"/institutionHigherEducationCourses/getNamesByFaculty/" + facultyId,
        dataType: "json",
        cache: false,

        success: function(data,textStatus,xhr){
        	console.log('Success retrieving getCourseNamesByFaculties');
        	//console.log(data);
        	dataHandler(data['data']);
        },
        error: function(xhr,textStatus,error){
        	console.log('Error retrieving getCourseNamesByFaculties');
 			dataHandler(null);
        }
    });
}



//
// drop down list Builder
//
function buildDropdown(data, domItem, nameFieldId, nameFieldValue) {
	var r="";
	$.each(data, function(index, data){
		r+="<option value="+data[nameFieldId]+">"+data[nameFieldValue]+"</option>";
	});
	$(domItem).html(r);
}