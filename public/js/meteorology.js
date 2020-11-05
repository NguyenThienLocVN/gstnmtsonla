const loadMeteorology = (id) => {
    $.ajax({
    url:window.location.href+"/"+id, // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
    method:"GET", // phương thức gửi dữ liệu.
    data:{id:id},
    beforeSend: function(){
      // Show image container
      $("#loading-gif-image").show();
      $("#overlay").show();
    }, 
    success:function(data){
      $("#loading-gif-image").hide();
      $("#overlay").hide();
    
    const arrayDate = [];
    // Get array of all date
     data.meteorologyData.forEach(function(e){
      arrayDate.push(e.Date_Time);
     })

    // Get the last date in data, and retrieved 90 days earlier
    const fromDate = arrayDate[arrayDate.length - 90];
    const toDate = arrayDate[arrayDate.length - 1];

    // Set that values for input
    document.getElementById('meteorology-start-picker').value = fromDate;
    document.getElementById('meteorology-end-picker').value = toDate;

    if(data.meteorologyData.length == 0)
    {
      $('#meteorology-start-picker').val("")
      $('#meteorology-end-picker').val("")
      $('#meteorology-monitoring-time').html("");
      alert("Dữ liệu trạm đang được cập nhật. Vui lòng thử lại sau.")
    }
    else
    {
      $('#meteorology-monitoring-time').html($('#meteorology-start-picker').val()+' - '+$('#meteorology-end-picker').val());
    }

    // Get index of this date in data
    const indexOfFrom = arrayDate.indexOf(fromDate);
    const indexOfTo = arrayDate.indexOf(toDate) + 1;

    // Filter data by fromDate and toDate
    const filterArray = data.meteorologyData.slice(indexOfFrom, indexOfTo);

    const filterMuddySand = [];
    filterArray.forEach(function(e){
      filterMuddySand.push(e.Result);
    })

    const filterDate = [];
    filterArray.forEach(function(e){
      filterDate.push(e.Date_Time);
    })

    //  Max do duc trong thang
     function maxOfMonth(month){
       return Math.max.apply(Math, month);
     }

     //  Min do duc trong thang
     function minOfMonth(month){
      return Math.min.apply(Math, month);
    }

     // Do duc trung binh cua thang
      function averageOfMonth(month){
        var sum = 0;
        var avg;

        for(var i = 0; i < month.length; i++)
        {
          sum += parseFloat(month[i]);
          avg = sum / month.length;
        } return avg;
      }

      // Get data of month by index
      var JanuaryTurbidity, FebruaryTurbidity, MarchTurbidity, AprilTurbidity, MayTurbidity, JuneTurbidity, JulyTurbidity, AugustTurbidity, SeptemberTurbidity, OctorberTurbidity, NovemberTurbidity, DecemberTurbidity;
      
      var muddySandOfYear = [], arrayDateOfYear = [], muddySandOfDrySeason = [], muddySandOfWetSeason = [], arrayDateOfWetSeason = [], arrayDateOfDrySeason = [];
      var turbidityData = [];
      function getMonthData(year){
        var indexOfFirstDay = arrayDate.indexOf("01/01/"+year);
        var indexOfLastDay = arrayDate.indexOf("31/12/"+year)+1;
        const filterArray = data.meteorologyData.slice(indexOfFirstDay, indexOfLastDay);

        muddySandOfYear = [];
        filterArray.forEach(function(e){
          muddySandOfYear.push(e.Result);
        })

        arrayDateOfYear = [];
        filterArray.forEach(function(e){
          arrayDateOfYear.push(e.Date_Time);
        })

        JanuaryTurbidity = muddySandOfYear.slice(0,31);
        var startYear = document.getElementById('meteorology-start-picker').value.slice(-4);
        if(startYear % 4 == 0){
          FebruaryTurbidity = muddySandOfYear.slice(31, 60);
          MarchTurbidity = muddySandOfYear.slice(60, 91);
          AprilTurbidity = muddySandOfYear.slice(91, 121);
          MayTurbidity = muddySandOfYear.slice(121, 152);
          JuneTurbidity = muddySandOfYear.slice(152, 182);
          JulyTurbidity = muddySandOfYear.slice(182, 213);
          AugustTurbidity = muddySandOfYear.slice(213, 244);
          SeptemberTurbidity = muddySandOfYear.slice(244, 274);
          OctorberTurbidity = muddySandOfYear.slice(274, 305);
          NovemberTurbidity = muddySandOfYear.slice(305, 335);
          DecemberTurbidity = muddySandOfYear.slice(335, 366);

          muddySandOfDrySeason = [], muddySandOfWetSeason = [], arrayDateOfWetSeason = [], arrayDateOfDrySeason = []
          muddySandOfDrySeason = muddySandOfYear.slice(0,121).concat(muddySandOfYear.slice(305,366))
          arrayDateOfDrySeason = arrayDateOfYear.slice(0,121).concat(arrayDateOfYear.slice(305,366))

          muddySandOfWetSeason = muddySandOfYear.slice(121,305)
          arrayDateOfWetSeason = arrayDateOfYear.slice(121,305)
        }
        else
        {
          FebruaryTurbidity = muddySandOfYear.slice(31, 59);
          MarchTurbidity = muddySandOfYear.slice(59, 90);
          AprilTurbidity = muddySandOfYear.slice(90, 120);
          MayTurbidity = muddySandOfYear.slice(120, 151);
          JuneTurbidity = muddySandOfYear.slice(151, 181);
          JulyTurbidity = muddySandOfYear.slice(181, 212);
          AugustTurbidity = muddySandOfYear.slice(212, 243);
          SeptemberTurbidity = muddySandOfYear.slice(243, 273);
          OctorberTurbidity = muddySandOfYear.slice(273, 304);
          NovemberTurbidity = muddySandOfYear.slice(304, 334);
          DecemberTurbidity = muddySandOfYear.slice(334, 365);

          muddySandOfDrySeason = [], muddySandOfWetSeason = [], arrayDateOfWetSeason = [], arrayDateOfDrySeason = []
          muddySandOfWetSeason = muddySandOfYear.slice(120,304)
          arrayDateOfWetSeason = arrayDateOfYear.slice(120,304)

          arrayDateOfDrySeason = arrayDateOfYear.slice(0,120).concat(arrayDateOfYear.slice(304,365))
          muddySandOfDrySeason = muddySandOfYear.slice(0,120).concat(muddySandOfYear.slice(304,365))
        }

        turbidityData.months = [JanuaryTurbidity, FebruaryTurbidity, MarchTurbidity, AprilTurbidity, MayTurbidity, JuneTurbidity, JulyTurbidity, AugustTurbidity, SeptemberTurbidity, OctorberTurbidity, NovemberTurbidity, DecemberTurbidity ];
        turbidityData.seasons = [muddySandOfWetSeason, muddySandOfDrySeason];

        return turbidityData;
      }

      // Do duc trung binh nam
     function averageTurbidityOfYear(year){
      var monthData = getMonthData(year);

      if(data.meteorologyData.length == 0)
      {
        var avgMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }
      else
      {
        var avgMonth = [averageOfMonth(monthData['months'][0]).toFixed(1), averageOfMonth(monthData['months'][1]).toFixed(1),
        averageOfMonth(monthData['months'][2]).toFixed(1), averageOfMonth(monthData['months'][3]).toFixed(1), averageOfMonth(monthData['months'][4]).toFixed(1),
        averageOfMonth(monthData['months'][5]).toFixed(1), averageOfMonth(monthData['months'][6]).toFixed(1), averageOfMonth(monthData['months'][7]).toFixed(1),
        averageOfMonth(monthData['months'][8]).toFixed(1), averageOfMonth(monthData['months'][9]).toFixed(1), averageOfMonth(monthData['months'][10]).toFixed(1),
        averageOfMonth(monthData['months'][11]).toFixed(1) ]
      }
      

        // Get average of 12 months in year
        var total = 0;
        for(var i = 0; i < avgMonth.length; i++) {
            total += parseFloat(avgMonth[i]);
        }
        var avg = total / avgMonth.length;
        $('#meteorology-average-value').html(avg.toFixed(1));

        var avgTurbidityOfYear = [];
        avgMonth.forEach(function(e){
          avgTurbidityOfYear.push(parseFloat(e))
        })
        return avgTurbidityOfYear;
      }

      function indexOfDateInMonth(month, value){
        return month.indexOf(value) + 1;
      }

    //  Do duc lon nhat nam
    function maxTurbidityOfYear(year){
      var monthData = getMonthData(year);

      if(data.meteorologyData.length == 0)
      {
        var maxMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }
      else
      {
        var maxMonth = [maxOfMonth(monthData['months'][0]).toFixed(1), maxOfMonth(monthData['months'][1]).toFixed(1),
        maxOfMonth(monthData['months'][2]).toFixed(1), maxOfMonth(monthData['months'][3]).toFixed(1), maxOfMonth(monthData['months'][4]).toFixed(1),
        maxOfMonth(monthData['months'][5]).toFixed(1), maxOfMonth(monthData['months'][6]).toFixed(1), maxOfMonth(monthData['months'][7]).toFixed(1),
        maxOfMonth(monthData['months'][8]).toFixed(1), maxOfMonth(monthData['months'][9]).toFixed(1), maxOfMonth(monthData['months'][10]).toFixed(1),
        maxOfMonth(monthData['months'][11]).toFixed(1) ]
      }
      
        // Get max value & max date and show them
        var maxValue = Math.max.apply(Math, maxMonth);
        var indexOfMaxValue = muddySandOfYear.indexOf(maxValue);
        var dateMaxOfYear = arrayDateOfYear[indexOfMaxValue];

        if(maxValue == 0)
        {
          $('#meteorology-max-value').html("0");
          $('#meteorology-max-date').html("0");
        }
        else
        {
          $('#meteorology-max-value').html(maxValue);
          $('#meteorology-max-date').html(dateMaxOfYear);
        }
        

        // Get max date of each month
        
        for(var i = 0; i <= 11; i++)
        {
          $(".meteorology-date-max-appear").find('.date').eq(i).html(indexOfDateInMonth(monthData['months'][i], parseFloat(maxMonth[i])))
        }

        var maxxTurbidityOfYear = [];
        maxMonth.forEach(function(e){
          maxxTurbidityOfYear.push(parseFloat(e))
        });

        return maxxTurbidityOfYear;
     }

    //  Do duc nho nhat nam
     function minTurbidityOfYear(year){
      var monthData = getMonthData(year);
      if(data.meteorologyData.length == 0)
      {
        var minMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }
      else
      {
        var minMonth = [minOfMonth(monthData['months'][0]).toFixed(1), minOfMonth(monthData['months'][1]).toFixed(1),
        minOfMonth(monthData['months'][2]).toFixed(1), minOfMonth(monthData['months'][3]).toFixed(1), minOfMonth(monthData['months'][4]).toFixed(1),
        minOfMonth(monthData['months'][5]).toFixed(1), minOfMonth(monthData['months'][6]).toFixed(1), minOfMonth(monthData['months'][7]).toFixed(1),
        minOfMonth(monthData['months'][8]).toFixed(1), minOfMonth(monthData['months'][9]).toFixed(1), minOfMonth(monthData['months'][10]).toFixed(1),
        minOfMonth(monthData['months'][11]).toFixed(1) ]
      }

        // Get min value & min date and show them
        var minValue = Math.min.apply(Math, minMonth);
        var indexOfMinValue = muddySandOfYear.indexOf(minValue);
        if(data.meteorologyData.length == 0)
        {
          var dateMinOfYear = 0;
        }
        else
        {
          var dateMinOfYear = arrayDateOfYear[indexOfMinValue];
        }
        

        $('#meteorology-min-value').html(minValue);
        $('#meteorology-min-date').html(dateMinOfYear);

        // Get min date of each month
        for(var i = 0; i <= 11; i++)
        {
          $(".meteorology-date-min-appear").find('.date').eq(i).html(indexOfDateInMonth(monthData['months'][i], parseFloat(minMonth[i])))
        }

        var minnTurbidityOfYear = [];
        minMonth.forEach(function(e){
          minnTurbidityOfYear.push(parseFloat(e))
        });

        return minnTurbidityOfYear;
     }

    //  Wet season - Mua mua
    function wetSeasonTurbidity(year){
      var monthData = getMonthData(year); 
      if(data.meteorologyData.length == 0)
      {
        var minWetSeason = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var maxWetSeason = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }
      else
      {
        var minWetSeason = [minOfMonth(monthData['seasons'][0]).toFixed(1)];
        var maxWetSeason = [maxOfMonth(monthData['seasons'][0]).toFixed(1)];
      }

        // Get min value & min date and show them
        var minValue = Math.min.apply(Math, minWetSeason); 
        var indexOfMinValue = muddySandOfWetSeason.indexOf(minValue);
        var dateMinOfWetSeason = arrayDateOfWetSeason[indexOfMinValue];
        $('#meteorology-wet-season-min-value').html(minValue);

        // Get max value & max date and show them
        var maxValue = Math.max.apply(Math, maxWetSeason); 
        var indexOfMaxValue = muddySandOfWetSeason.indexOf(maxValue); 
        var dateMaxOfWetSeason = arrayDateOfWetSeason[indexOfMaxValue];
        $('#meteorology-wet-season-max-value').html(maxValue);

        if(data.meteorologyData.length == 0)
        {
          $('#meteorology-wet-season-max-date').html("0");
          $('#meteorology-wet-season-min-date').html("0");
        }
        else
        {
          $('#meteorology-wet-season-max-date').html(dateMaxOfWetSeason);
          $('#meteorology-wet-season-min-date').html(dateMinOfWetSeason);
        }
    }

    //  Dry season - Mua kho
    function drySeasonTurbidity(year){
      var monthData = getMonthData(year);
      if(data.meteorologyData.length == 0)
      {
        var minDrySeason = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var maxDrySeason = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }
      else
      {
        var minDrySeason = [minOfMonth(monthData['seasons'][1]).toFixed(1)];
        var maxDrySeason = [maxOfMonth(monthData['seasons'][1]).toFixed(1) ];
      }

        // Get min value & min date and show them
        var minValue = Math.min.apply(Math, minDrySeason); 
        var indexOfMinValue = muddySandOfDrySeason.indexOf(minValue);
        var dateMinOfDrySeason = arrayDateOfDrySeason[indexOfMinValue];
        $('#meteorology-dry-season-min-value').html(minValue);
        
        // Get max value & max date and show them
        var maxValue = Math.max.apply(Math, maxDrySeason); 
        var indexOfMaxValue = muddySandOfDrySeason.indexOf(maxValue);
        var dateMaxOfDrySeason = arrayDateOfDrySeason[indexOfMaxValue];
        $('#meteorology-dry-season-max-value').html(maxValue);
        
        if(data.meteorologyData.length == 0)
        {
          $('#meteorology-dry-season-min-date').html("0");
          $('#meteorology-dry-season-max-date').html("0");
        }
        else
        {
          $('#meteorology-dry-season-min-date').html(dateMinOfDrySeason);
          $('#meteorology-dry-season-max-date').html(dateMaxOfDrySeason);
        }
    }

    var startYear = document.getElementById('meteorology-start-picker').value.slice(-4);
    var endYear = document.getElementById('meteorology-end-picker').value.slice(-4);
    
    if(startYear == endYear)
    {
      averageTurbidityOfYear(startYear);
      wetSeasonTurbidity(startYear);
      drySeasonTurbidity(startYear);
      maxTurbidityOfYear(startYear);
      minTurbidityOfYear(startYear);

      // Print year value
      $('.year-value').html("năm "+startYear);
    }

    // Draw line chart 
    muddySandChart = Highcharts.chart('meteorology-container', {
      title: {
        text: 'BIỂU ĐỒ KHÍ TƯỢNG NGÀY'
      },
      yAxis: {
          title: {
              text: '(mm)'
          }
      },
      xAxis: {
          gridLineWidth: 1,
          categories: filterDate,
      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
      },
      plotOptions: {
          series: {
              label: {
                  connectorAllowed: false
              },
          }
      },
      series: [{
              name: 'Lưu lượng',
              color: '#006dc3',
              data: filterMuddySand
          },
      ],
      responsive: {
          rules: [{
              condition: {
                  maxWidth: 550
              }
          }]
      },
    });

    // Draw avg colummn chart
    $('#meteorology-avg-chart').highcharts({
      chart: {
        type: 'column'
      },
      title: {
        text: 'BIỂU ĐỒ KHÍ TƯỢNG TRUNG BÌNH THÁNG / NĂM ' + startYear
      },
      yAxis: {
        title: {
            text: '(mm)'
        }
    },
    xAxis: {
        categories: [
            'I',
            'II',
            'III',
            'IV',
            'V',
            'VI',
            'VII',
            'VIII',
            'IX',
            'X',
            'XI',
            'XII'
        ],
        crosshair: true
    },
    series: [{
        name: "Lưu lượng",
        data: averageTurbidityOfYear(startYear)
    }]
    })

    // Draw max colummn chart
    maxChart = Highcharts.chart('meteorology-max-chart', {
      chart: {
        type: 'column'
    },
    yAxis: {
        title: {
            text: '(mm)'
        }
    },
    title: {
      text: 'BIỂU ĐỒ KHÍ TƯỢNG LỚN NHẤT THÁNG NĂM ' + startYear
    },
    xAxis: {
        categories: [
          'I',
          'II',
          'III',
          'IV',
          'V',
          'VI',
          'VII',
          'VIII',
          'IX',
          'X',
          'XI',
          'XII'
      ],
        crosshair: true
    },
    series: [{
        name: "Lưu lượng",
        color: '#ff8138',
        data: maxTurbidityOfYear(startYear)
    }]
    })

    $("#btn-show-download").click(function(){
      $("#btn-export-png").toggleClass("d-none");
      $("#btn-export-xls").toggleClass("d-none");
  
      $('#btn-export-png').click(function () {
        var chart = $('#meteorology-container').highcharts();
        chart.exportChartLocal({
          type: 'image/png'
        });
      });
      
      // Export TO XLS
      $('#btn-export-xls').click(function () {
          var chart = $('#meteorology-container').highcharts();
          chart.downloadXLS();
      });
    })

    // Filter by date picker
    document.getElementById('search-rain-btn').addEventListener('click', function(){
      var inputFrom = document.getElementById('meteorology-start-picker').value;
      var inputTo = document.getElementById('meteorology-end-picker').value;

      $('#meteorology-monitoring-time').html($('#meteorology-start-picker').val()+' - '+$('#meteorology-end-picker').val());

      // Get index
      var indexOfInputFrom = arrayDate.indexOf(inputFrom);
      var indexOfInputTo = arrayDate.indexOf(inputTo) + 1;

      // Filter data
      var filterArrayByInput = data.meteorologyData.slice(indexOfInputFrom, indexOfInputTo);

      var filterMuddySandByInput = [];
      filterArrayByInput.forEach(function(e){
        filterMuddySandByInput.push(e.Result);
      })

      var filterDateByInput = [];
      filterArrayByInput.forEach(function(e){
        filterDateByInput.push(e.Date_Time);
      })

      var turbidityChart = $('#meteorology-container').highcharts();
      turbidityChart.series[0].setData(filterMuddySandByInput);
      turbidityChart.xAxis[0].setCategories(filterDateByInput);

      var startYear = document.getElementById('meteorology-start-picker').value.slice(-4);
      var endYear = document.getElementById('meteorology-end-picker').value.slice(-4);

      if(startYear === endYear)
      {
        $('.year-value').html("năm "+startYear)

        wetSeasonTurbidity(startYear)
        drySeasonTurbidity(startYear)

        // Update max data
        var maxChart = $('#meteorology-max-chart').highcharts();
        maxChart.series[0].setData(maxTurbidityOfYear(startYear));
        maxChart.setTitle({text: "BIỂU ĐỒ LƯU LƯỢNG LỚN NHẤT THÁNG NĂM "+startYear});

        // Update avg data
        var avgChart = $('#meteorology-avg-chart').highcharts();
        avgChart.series[0].setData(averageTurbidityOfYear(startYear));
        avgChart.setTitle({text: "BIỂU ĐỒ LƯU LƯỢNG TRUNG BÌNH THÁNG NĂM "+startYear});

      }
      else {
        $(".same-year-value").html('-.')
      }
    })
   },

 });
}

const openMuddySand = (id) => {
  loadMuddySand(id);
}

function toPdf(){
    var val = htmlToPdfmake(document.getElementById('meteorology-info').outerHTML);
    var dd = {
      content:val,
      styles:{
        'font-weight-bold':{
          bold:true,
          marginBottom: 10
        },
        'wet-season-title':{
          background:"lightblue"
        },
        'dry-season-title':{
          background:"navajowhite"
        }
      }
    };
    pdfMake.createPdf(dd).download();
  }