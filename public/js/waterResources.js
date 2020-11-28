(function ($) {
    // Dropdown select district
    $('#btn-select-dropdown-district').on('click', function(){
        $('#dropdownlist-district').slideToggle();
        $('#dropdownlist-subregion').hide();
        $('#dropdownlist-construction').hide();
    })
    $("#filter-district").on('focus',function(){
        $('#dropdownlist-district').show();
        $('#dropdownlist-subregion').hide();
        $('#dropdownlist-construction').hide();
    })

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

    // Function AJAX load construction by subregion
    function ajaxConstructionBySubregion(id){
        $.ajax({
            url: window.location.origin+'/tai-nguyen-nuoc/subregion/'+id,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $("#loading-gif-image").show();
                $("#overlay").show();
            },
            success: function(response){
                $("#loading-gif-image").hide();
                $("#overlay").hide();
                var uniqueConstruction = removeDuplicates(response, "id");
                for(var i=0; i < uniqueConstruction.length; i++)
                {
                    var li = "<li class='p-1 construction_id' id='"+uniqueConstruction[i].id+"'>"+uniqueConstruction[i].construction_name+"</li>";
                    $("#dropdownlist-construction").append(li);
                }

                $('#dropdownlist-construction li').on('click',function(){
                    $('#filter-construction').val(this.innerText);
                    $('#dropdownlist-construction').hide();
                    var id = $(this).attr('id');
                    $("#construction_id").val(id);
                    
                    // AJAX load construction info
                    fillConstructionInfo(id);
                })
            }
        }); 
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
    $('#dropdownlist-district li').on('click',function(){
        $('#filter-district').val(this.innerText);
        $('#dropdownlist-district').hide();
        var id = $(this).attr('id');
        $("#district_id").val(id);
        
        $("#dropdownlist-subregion li").remove();
        $("#dropdownlist-construction li").remove();
        $('#filter-construction').val('');
        $('#filter-subregion').val('');

        $('.form-control').val('');
        // AJAX request load construction when select district
        $.ajax({
            url: window.location.origin+'/tai-nguyen-nuoc/district/'+id,
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
                    var li = "<li class='p-1 construction_id' id='"+uniqueConstruction[i].id+"'>"+uniqueConstruction[i].construction_name+"</li>";
                    $("#dropdownlist-construction").append(li);
                }

                $('#dropdownlist-construction li').on('click',function(){
                    $('#filter-construction').val(this.innerText);
                    $('#dropdownlist-construction').hide();
                    var id = $(this).attr('id');
                    $("#construction_id").val(id);

                    // AJAX load construction info
                    fillConstructionInfo(id);
                })

                // Load subregion
                var uniqueSubregion = removeDuplicates(response.subregions, "id");
                for(var i=0; i < uniqueSubregion.length; i++)
                {
                    var li = "<li class='p-1 subregion_id' id='"+uniqueSubregion[i].id+"'>"+uniqueSubregion[i].subregion_name+"</li>";
                    $("#dropdownlist-subregion").append(li);
                }

                $('#dropdownlist-subregion li').on('click',function(){
                    $("#dropdownlist-construction li").remove();
                    $('#filter-construction').val('');
                    $('#filter-subregion').val(this.innerText);
                    $('#dropdownlist-subregion').hide();
                    var id = $(this).attr('id');
                    $("#subregion_id").val(id);

                    ajaxConstructionBySubregion(id);
                })
            }
        }); 
    })

    // Event search district by input
    $('#filter-district').on('keyup',function(){
        var input = this.value.toUpperCase();

        var ul = document.getElementById("dropdownlist-district");
        var li = ul.getElementsByTagName('li');
        for(var i = 0; i < li.length; i++)
        {
            var result = li[i].innerText.toUpperCase();
            if(result.indexOf(input) > -1)
            {
                li[i].style.display = '';
            }
            else
            {
                li[i].style.display = 'none';
            }
        }
    });

    // Dropdown select subregion
    $('#btn-select-dropdown-subregion').on('click', function(){
        $('#dropdownlist-subregion').slideToggle();
        $('#dropdownlist-district').hide();
        $('#dropdownlist-construction').hide();
    })
    $("#filter-subregion").on('focus',function(){
        $('#dropdownlist-subregion').show();
        $('#dropdownlist-district').hide();
        $('#dropdownlist-construction').hide();
    })
    $('#dropdownlist-subregion li').on('click',function(){
        $('#filter-subregion').val(this.innerText);
        $('#dropdownlist-subregion').hide();
        var id = $(this).attr('id');
        $("#subregion_id").val(id);

        $("#dropdownlist-construction li").remove();
        $('#filter-construction').val('')

        $('.form-control').val('');
        // AJAX request load construction when select subregion
        ajaxConstructionBySubregion(id);
    })



    // Event search subregion by input
    $('#filter-subregion').on('keyup',function(){
        var input = this.value.toUpperCase();

        var ul = document.getElementById("dropdownlist-subregion");
        var li = ul.getElementsByTagName('li');
        for(var i = 0; i < li.length; i++)
        {
            var result = li[i].innerText.toUpperCase();
            if(result.indexOf(input) > -1)
            {
                li[i].style.display = '';
            }
            else
            {
                li[i].style.display = 'none';
            }
        }
    });

    // Dropdown select construction
    $('#btn-select-dropdown-construction').on('click', function(){
        $('#dropdownlist-construction').slideToggle();
        $('#dropdownlist-district').hide();
        $('#dropdownlist-subregion').hide();
    })
    $("#filter-construction").on('focus',function(){
        $('#dropdownlist-construction').show();
        $('#dropdownlist-district').hide();
        $('#dropdownlist-subregion').hide();
    })
    $('#dropdownlist-construction li').on('click',function(){
        $('#filter-construction').val(this.innerText);
        $('#dropdownlist-construction').hide();
        var id = $(this).attr('id');
        $("#construction_id").val(id);

        // AJAX load construction info
        fillConstructionInfo(id);
    })
    // Event search construction by input
    $('#filter-construction').on('keyup',function(){
        var input = this.value.toUpperCase();

        var ul = document.getElementById("dropdownlist-construction");
        var li = ul.getElementsByTagName('li');
        for(var i = 0; i < li.length; i++)
        {
            var result = li[i].innerText.toUpperCase();
            if(result.indexOf(input) > -1)
            {
                li[i].style.display = '';
            }
            else
            {
                li[i].style.display = 'none';
            }
        }
    });

    // Click to toggle expand sidebar
    $("#toggle-sidebar").on('click', function(){
        $("#sidebar").slideToggle("slow");
    })

})(jQuery);