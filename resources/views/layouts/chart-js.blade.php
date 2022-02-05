<script>
    var ctx = document.getElementById("barChart");
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["{{getMonth(Session::get('month'))}}"],
			datasets: [{
				label: "Pagamentos",
				data: [{{$totalPayment ?? 0.00}}],
				borderColor: "#5964ff",
				borderWidth: "0",
				backgroundColor: "#5964ff"
			}, {
				label: "Compras",
				data: [{{$totalPurchase ?? 0.00}}],
				borderColor: "#ff5964",
				borderWidth: "0",
				backgroundColor: "#ff5964"
			},]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			scales: {
				xAxes: [{
					ticks: {
						fontColor: "#bbc1ca",
					 },
					gridLines: {
						color: 'rgba(0,0,0,0.03)'
					}
				}],
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontColor: "#bbc1ca",
					},
					gridLines: {
						color: 'rgba(0,0,0,0.03)'
					},
				}]
			},
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.datasetIndex == 1 ? `Compras: ${convertNumberToCurrency(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index])}` : `Pagamentos: ${convertNumberToCurrency(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index])}`;
                    }
                }
            },
			legend: {
				labels: {
					fontColor: "#bbc1ca"
				},
			},
		}
	});

</script>