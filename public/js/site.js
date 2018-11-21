

// Pie chart for testingProjectReport

$(document).ready(function() {
    var isBugNumber = parseInt(document.getElementById("isBugNumber").innerHTML);
    var isReopened = parseInt(document.getElementById("isReopened").innerHTML);
    var isOpen = parseInt(document.getElementById("isOpen").innerHTML);
    var isRejected = parseInt(document.getElementById("isRejected").innerHTML);
    var isAssigned = parseInt(document.getElementById("isAssigned").innerHTML);
    var isTest = parseInt(document.getElementById("isTest").innerHTML);
    var isDeferred = parseInt(document.getElementById("isDeferred").innerHTML);
    var isClosed = parseInt(document.getElementById("isClosed").innerHTML);

    var chart = {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false
    };
    var title = {
        text: 'Project Report Chart: Bug State'
    };
    var tooltip = {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    };
    var plotOptions = {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    };
    var series= [{
        type: 'pie',
        name: 'Browser share',
        data: [
            ['Reopened '+ isReopened,   isReopened/isBugNumber * 100],
            ['Rejected ' + isRejected,   isRejected/isBugNumber * 100],
            {
                name: 'Open ' + isOpen,
                y: isOpen/isBugNumber * 100,
                sliced: true,
                selected: true
            },
            ['Assigned ' + isAssigned,   isAssigned/isBugNumber * 100],
            ['Test ' + isTest,   isTest/isBugNumber * 100],
            ['Deferred ' + isDeferred,   isDeferred/isBugNumber * 100],
            ['Closed ' + isClosed,   isClosed/isBugNumber * 100]
        ]
    }];

    var json = {};
    json.chart = chart;
    json.title = title;
    json.tooltip = tooltip;
    json.series = series;
    json.plotOptions = plotOptions;
    $('#testingProjectReport').highcharts(json);
});


// Bar chart for ProjectReport
$(document).ready(function() {

    var isFunctional = parseInt(document.getElementById("isFunctional").innerHTML);
    var isSystem = parseInt(document.getElementById("isSystem").innerHTML);
    var isProcess = parseInt(document.getElementById("isProcess").innerHTML);
    var isData = parseInt(document.getElementById("isData").innerHTML);
    var isCode = parseInt(document.getElementById("isCode").innerHTML);
    var isDuplicate = parseInt(document.getElementById("isDuplicate").innerHTML);
    var isOther = parseInt(document.getElementById("isOther").innerHTML);
    var isNAP = parseInt(document.getElementById("isNAP").innerHTML);
    var isBadUnit = parseInt(document.getElementById("isBadUnit").innerHTML);
    var isStandards = parseInt(document.getElementById("isStandards").innerHTML);
    var isRCN = parseInt(document.getElementById("isRCN").innerHTML);
    var isUnknown = parseInt(document.getElementById("isUnknown").innerHTML);
    var isNoTaxonomy = parseInt(document.getElementById("isNoTaxonomy").innerHTML);
    var  isDocumentation=parseInt(document.getElementById("isDocumentation").innerHTML);

    var chart = {
        type: 'column'
    };
    var title = {
        text: 'Bug Taxonomy'
    };
    var subtitle = {
        text: ' --Project Report Chart '
    };
    var xAxis = {
        categories: ['Type'],
        crosshair: true
    };
    var yAxis = {
        min: 0,
        title: {
            text: 'Number'
        }
    };
    var tooltip = {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    };
    var plotOptions = {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    };
    var credits = {
        enabled: false
    };

    var series= [{
        name: 'Functional',
        data: [isFunctional]
    }, {
        name: 'System',
        data: [isSystem]
    }, {
        name: 'Process',
        data: [isProcess]
    }, {
        name: 'Data',
        data: [isData]
    }, {
        name: 'Code',
        data: [isCode]
    }, {
        name: 'Duplicate',
        data: [isDuplicate]
    }, {
        name: 'NAP',
        data: [isNAP]
    }, {
        name: 'BadUnit',
        data: [isBadUnit]
    }, {
        name: 'Standards',
        data: [isStandards]
    }, {
        name: 'RCN',
        data: [isRCN]
    }, {
        name: 'Unknown',
        data: [isUnknown]
    }, {
        name: 'NoTaxonomy',
        data: [isNoTaxonomy]
    }, {
        name: 'Documente',
        data: [isDocumentation]
    }, {
        name: 'Other',
        data: [isOther]
    }];

    var json = {};
    json.chart = chart;
    json.title = title;
    json.subtitle = subtitle;
    json.tooltip = tooltip;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.series = series;
    json.plotOptions = plotOptions;
    json.credits = credits;
    $('#projectReportBar').highcharts(json);

});


// Line chart for ProjectReport
$(document).ready(function() {
    var title = {
        text: 'Bug Open and Close Track'
    };
    var subtitle = {
        text: ' --Project Report Chart '
    };
    var xAxis = {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    };
    var yAxis = {
        title: {
            text: 'Number'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    };

    var tooltip = {
        valueSuffix: '\xB0C'
    }

    var legend = {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    };

    var series =  [
        {
            name: 'Open',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2,
                26.5, 23.3, 18.3, 13.9, 9.6]
        },
        {
            name: 'Closed',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8,
                24.1, 20.1, 14.1, 8.6, 2.5]
        }
    ];

    var json = {};

    json.title = title;
    json.subtitle = subtitle;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.tooltip = tooltip;
    json.legend = legend;
    json.series = series;

    $('#projectReportLine').highcharts(json);
});