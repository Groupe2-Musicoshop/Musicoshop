$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Moyenne Mensuelle des Ventes'
        },
        subtitle: {
            text: 'Source: Musicoshop.com'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quantité Vendue'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Accordéon',
            data: [49, 71, 106, 129, 144, 176, 135, 148, 216, 194, 95, 54]

        }, {
            name: 'Corne de brume',
            data: [83, 78, 98, 93, 106, 84, 105, 104, 91, 83, 106, 92]

        }, {
            name: 'Piano à queue',
            data: [48, 38, 39, 41, 47, 48, 59, 59, 52, 65, 59, 51]

        }, {
            name: 'Violon',
            data: [42, 33, 34, 39, 52, 75, 57, 60, 47, 39, 46, 51]

        }]
    });
});