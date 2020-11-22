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
        // AJAX request load construction when select district
        $.ajax({
            url: window.location.href+'/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                for(var i=0; i < response.length; i++)
                {
                    var li = "<li class='p-1 construction_id' id='"+response[i].id+"'>"+response[i].construction_name+"</li>";
                    $("#dropdownlist-construction").append(li);
                }

                $('#dropdownlist-construction li').on('click',function(){
                    $('#filter-construction').val(this.innerText);
                    $('#dropdownlist-construction').hide();
                    var id = $(this).attr('id');
                    $("#construction_id").val(id);
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

})(jQuery);