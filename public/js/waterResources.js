(function ($) {
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

    // Get construction data & fetch all
    function fillConstructionInfo(id){
        $.ajax({
            url: window.location.origin+'/gstnmtsonla/tai-nguyen-nuoc/cap-phep/'+id,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $("#loading-gif-image").show();
                $("#overlay").show();
            },
            success: function(response){
                $("#loading-gif-image").hide();
                $("#overlay").hide();
                
                $("#input-construction-name").text(response.construction_name);
                $("#input-investor").text(response.investor);
                $("#input-license-num").text(response.license_num);
                $("#input-license-date").text(response.license_date);
                $("#input-license-duration").text(response.license_duration);
                $("#input-license-by").text(response.license_by);
                $("#input-water-source").text(response.water_source);
                $("#input-location").text(response.commune +', '+ response.district);
                $("#input-lat-dams").text(response.lat_dams);
                $("#input-long-dams").text(response.long_dams);
                $("#input-lat-factory").text(response.lat_factory);
                $("#input-long-factory").text(response.long_factory);
                $("#input-extraction-mode").text(response.extraction_mode);
                $("#input-extraction-method").text(response.extraction_method);
                $("#input-max-flow").html(response.max_flow+" <span> m<sup>3</sup>/s</span>");
                $("#input-min-flow").html(response.min_flow+" <span> m<sup>3</sup>/s</span>");
                $("#input-wattage").text(response.wattage+' MW');
            }
        })
    }

    // Event select construction
    function selectConstruction(){
        $('#dropdownlist-construction').on('select2:select',function(e){
            // AJAX load construction info
            fillConstructionInfo(e.params.data.id);
            var idSelected = e.params.data.element.id;
            var splitId = idSelected.split(',');
            setFocusByPosition(splitId[0], splitId[1]);
        })
    }

    // Event click district on list
    $('#dropdownlist-district').on('select2:select',function(){
        $('#dropdownlist-construction').empty();
        $('#dropdownlist-commune').empty();

        $('.form-control').val('');
        // AJAX request load construction when select district
        $.ajax({
            url: window.location.origin+'/gstnmtsonla/tai-nguyen-nuoc/district/'+this.value,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $("#loading-gif-image").show();
                $("#overlay").show();
            },
            success: function(response){
                $("#loading-gif-image").hide();
                $("#overlay").hide();

                // Load communes
                var defaultCommuneOption = "<option value='' >Chọn xã..</option>";
                $("#dropdownlist-commune").append(defaultCommuneOption);
                for(var i=0; i < response.communes.length; i++)
                {
                    var option = "<option value='"+response.communes[i].code+"'>"+response.communes[i].name+"</option>";
                    $("#dropdownlist-commune").append(option);
                }

                // Load constructions
                var defaultOption = "<option value='' >Chọn công trình..</option>";
                $("#dropdownlist-construction").append(defaultOption);
                for(var i=0; i < response.constructions.length; i++)
                {
                    var option = "<option value='"+response.constructions[i].license_num+"' id='"+response.constructions[i].lat_dams+","+response.constructions[i].long_dams+"'>"+response.constructions[i].construction_name+"</option>";
                    $("#dropdownlist-construction").append(option);
                }

                selectConstruction();
            }
        }); 
    })


    // Event click commune on list
    $('#dropdownlist-commune').on('select2:select',function(){
        $('#dropdownlist-construction').empty();

        $('.form-control').val('');
        // AJAX request load construction when select commune
        $.ajax({
            url: window.location.origin+'/gstnmtsonla/tai-nguyen-nuoc/commune/'+this.value,
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
                var defaultOption = "<option value='' >Chọn công trình..</option>";
                $("#dropdownlist-construction").append(defaultOption);
                for(var i=0; i < response.constructions.length; i++)
                {
                    var option = "<option value='"+response.constructions[i].license_num+"' id='"+response.constructions[i].lat_dams+","+response.constructions[i].long_dams+"'>"+response.constructions[i].construction_name+"</option>";
                    $("#dropdownlist-construction").append(option);
                }

                selectConstruction();
            }
        }); 
    })

    selectConstruction();

    $("#dropdownlist-district").select2({dropdownCssClass: "font-13" });
    $("#dropdownlist-commune").select2({dropdownCssClass: "font-13" });
    $("#dropdownlist-construction").select2({dropdownCssClass: "font-13" });

    // Click to toggle expand sidebar
    $("#toggle-sidebar").on('click', function(){
        $("#sidebar").slideToggle("slow");
    })

})(jQuery);