var Index = function() {

    var dashboardMainChart = null;

    return {

        //main function
        init: function() {
            Metronic.addResizeHandler(function() {
                jQuery('.vmaps').each(function() {
                    var map = jQuery(this);
                    map.width(map.parent().width());
                });
            });

            Index.initCharts();
        },

        

        initCharts: function() {
            if (Morris.EventEmitter) {
                // Use Morris.Area instead of Morris.Line
                dashboardMainChart = Morris.Area({
                    element: 'sales_statistics',
                    padding: 0,
                    behaveLikeLine: false,
                    gridEnabled: false,
                    gridLineColor: false,
                    axes: false,
                    fillOpacity: 1,
                    data: [{
                        Date: '16-11-2015',
                        Cases: 400
                    }, {
                         Date: '17-11-2015',
                        Cases: 600
                    }, {
                         Date: '18-11-2015',
                        Cases: 1200
                    }, {
                        Date: '19-11-2015',
                        Cases: 2400
                    }, {
                        Date: '20-11-2015',
                        Cases: 2500
                    }, {
                        Date: '21-11-2015',
                        Cases: 2700
                    }, {
                        Date: '22-11-2015',
                        Cases: 2800
                    }],
                    lineColors: ['#399a8c', '#92e9dc'],
                    xkey: 'Date',
                    ykeys: ['Cases'],
                    labels: ['Cases'],
                    pointSize: 0,
                    lineWidth: 0,
                    hideHover: 'auto',
                    resize: true
                });

            }
        },

        redrawCharts: function() {
            dashboardMainChart.resizeHandler();
        }

    };

}();