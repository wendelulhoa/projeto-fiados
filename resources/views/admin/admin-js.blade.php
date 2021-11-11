
<script type="text/javascript" defer>
    $('#cpf').mask('000.000.000-00');
    $('#phone').mask('(00)00000-0000');

    $('#amount').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $('#limit').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

    $('.status-mod').click(function(){
        var id = $(this).attr('data-id');
        var action = ()=>{
            $.ajax({
                url: "",
                method:'POST',
                data: {
                    id   : $(this).attr('data-id'),
                    type : $(this).attr('data-type') == 'true' ? true : false,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    $(`#tr-${id}`).fadeOut();
                }
            });
        }
        sweetAlert(`Tem certeza que deseja ${$(this).attr('data-type') != 'true' ? 'aprovar' : 'bloquear' }?`, action)
    });

    $('.delete-mod').click(function(e){
        e.preventDefault();
        var element = $(this).parent().parent()
        var action = ()=>{
            $.ajax({
                url: $(this).attr('href'),
                method:'POST',
                data: {
                    id   : $(this).attr('data-id'),
                    type : $(this).attr('data-type') == 'true' ? true : false,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    toastr.success("Cadastrado com sucesso")
                    element.fadeOut();
                }
            });
        };

        sweetAlert(`Tem certeza que deseja excluir?`, action)
    });

    var ctx = document.getElementById("barChart");
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['nov', 'dez'],
			datasets: [{
				label: "Pagamentos",
				data: ["60", "15"],
				borderColor: "#5964ff",
				borderWidth: "0",
				backgroundColor: "#5964ff"
			}, {
				label: "Compras",
				data: ["60", "25"],
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
                        // console.log(,  );
                        return tooltipItem.datasetIndex == 1 ? `Compras: ${data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]}%` : `Pagamentos: ${data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]}%`;
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