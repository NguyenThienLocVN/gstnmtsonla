(function ($) {

    $("#dropdownlist-district").select2({});
    $("#dropdownlist-commune").select2({});
    $("#dropdownlist-construction").select2({});

    // Function remove duplicate from array
    function removeDuplicates(originalArray, prop) {
        var newArray = [];
        var lookupObject  = {};
   
        for(var i in originalArray) {
           lookupObject[originalArray[i][prop]] = originalArray[i];
        }
   
        for(i in lookupObject) {
            newArray.push(lookupObject[i]);
        }
         return newArray;
    }

    function fillConstructionInfo(id){
        $.ajax({
            url: window.location.origin+'/tai-nguyen-nuoc/cap-phep/'+id,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $("#loading-gif-image").show();
                $("#overlay").show();
            },
            success: function(response){
                $("#loading-gif-image").hide();
                $("#overlay").hide();
                
                $("#input-construction-name").val(response.construction_name);
                $("#input-investor").val(response.investor);
                $("#input-license-num").val(response.license_num);
                $("#input-license-date").val(response.license_date);
                $("#input-license-duration").val(response.license_duration);
                $("#input-license-by").val(response.license_by);
                $("#input-water-source").val(response.water_source);
                $("#input-location").val(response.commune +', '+ response.district);
                $("#input-lat-dams").val(response.lat_dams);
                $("#input-long-dams").val(response.long_dams);
                $("#input-lat-factory").val(response.lat_factory);
                $("#input-long-factory").val(response.long_factory);
                $("#input-extraction-mode").val(response.extraction_mode);
                $("#input-extraction-method").val(response.extraction_method);
                $("#input-flow").val(response.max_flow);
            }
        })
    }

    // Event click district on list
    $('#dropdownlist-district').on('change',function(){
        $('#dropdownlist-construction').empty();

        $('.form-control').val('');
        // AJAX request load construction when select district
        $.ajax({
            url: window.location.origin+'/tai-nguyen-nuoc/district/'+this.value,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $("#loading-gif-image").show();
                $("#overlay").show();
            },
            success: function(response){
                $("#loading-gif-image").hide();
                $("#overlay").hide();

                // Load constructions
                var uniqueConstruction = removeDuplicates(response.constructions, "id");
                for(var i=0; i < uniqueConstruction.length; i++)
                {
                    var option = "<option value='"+uniqueConstruction[i].id+"' onclick='setFocusByPosition("+uniqueConstruction[i].lat_dams+","+uniqueConstruction[i].long_dams+")'>"+uniqueConstruction[i].construction_name+"</option>";
                    $("#dropdownlist-construction").append(option);
                }

                $('#dropdownlist-construction').on('change',function(){
                    // AJAX load construction info
                    fillConstructionInfo(this.value);
                })
            }
        }); 
    })

    $('#dropdownlist-construction').on('change',function(){
        // AJAX load construction info
        fillConstructionInfo(this.value);
    })

    // Click to toggle expand sidebar
    $("#toggle-sidebar").on('click', function(){
        $("#sidebar").slideToggle("slow");
    })

})(jQuery);