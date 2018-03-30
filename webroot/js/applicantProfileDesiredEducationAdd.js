jQuery(document).ready(function() {
	//alert('Document Ready to be processed by javascript');

    var language = $('html').attr('lang');
    if (language == 'en_US') {
        var fieldName = 'name_en';
    } else {
        var fieldName = 'name_ara';
    }
	
	//
	// Initializing default values
	//

	getNarrowsByCore($('#core').val(), language, function f(data){
		buildDropdown(data, '#narrow', 'id', fieldName);
		getSubsByNarrow($('#narrow').val(), language, function f(data){
			buildDropdown(data, '#sub', 'id', fieldName);
		});
	});

	//
	// Events
    //
    

    $('#core').on('change', function(){
        getNarrowsByCore($('#core').val(), language, function f(data){
            buildDropdown(data, '#narrow', 'id', fieldName);
            getSubsByNarrow($('#narrow').val(), language, function f(data){
                buildDropdown(data, '#sub', 'id', fieldName);
            });
        });
    });

    $('#narrow').on('change', function(){
            getSubsByNarrow($('#narrow').val(), language, function f(data){
                buildDropdown(data, '#sub', 'id', fieldName);
            });
    });

});



function getNarrowsByCore(coreId, language, dataHandler){
    if (language == 'en_US') {
        var path = '/education-isced-narrow-fields/getNamesEnByCores/';
    } else {
        var path = '/education-isced-narrow-fields/getNamesAraByCores/';
    }

	$.ajax({
        type: "GET",
        url: window.location.protocol+"//" +window.location.host + path + coreId,
        dataType: "json",
        cache: false,

        success: function(data,textStatus,xhr){
        	console.log('Success retrieving getNarrowsByCore');
        	dataHandler(data['data']);
        },
        error: function(xhr,textStatus,error){
        	console.log('Error retrieving getNarrowsByCore');
 			dataHandler(null);
        }
    });
}

function getSubsByNarrow(narrowId, language, dataHandler){
    if (language == 'en_US') {
        var path = '/education-field-of-study-subs/getNamesEnByNarrowField/';
    } else {
        var path = '/education-field-of-study-subs/getNamesAraByNarrowField/';
    }
    console.log(path);

	$.ajax({
        type: "GET",
        url: window.location.protocol+"//" +window.location.host + path + narrowId,
        dataType: "json",
        cache: false,

        success: function(data,textStatus,xhr){
        	console.log('Success retrieving getFacultyNamesByInstitution');
        	dataHandler(data['data']);
        },
        error: function(xhr,textStatus,error){
        	console.log('Error retrieving getFacultyNamesByInstitution');
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