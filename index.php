<html>
	<head>
		<title>Pizza Orders </title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <style>
			h4{
				text-align:center;
			}
			#max-data{
				text-align:center;
			}
			#hidden{
				visibility:hidden;
			}
			.red{
				color:red;
				text-align:center
			}
			.col-md-4{
				margin-bottom:30px!important;
			}
			img{
				width:95%;
			}
		  </style>
	</head>
	<body>	
		<div class = "container-fluid">
			<nav class="navbar navbar-inverse navbar-fixed">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand" href="#">Pizza</a>
				</div>
				<ul class="nav navbar-nav pull-right">
				  <li class="active"><a href="#">Home</a></li>
				  <li><a href="#">Page 1</a></li>
				  <li><a href="#">Page 2</a></li>
				  <li><a href="#">Page 3</a></li>
				</ul>
			  </div>
			</nav>
			<div id = 'hidden'></div>
			<div class = "container-fluid"><div class = "row">
				<div class = "col-md-9">
					<div class = "row" id = "show_product"></div>
				</div>
				<div class = "col-md-3 pull-right" style = "background-color:#f8f8f8; min-height:400px;">
					<h4>Order Summery <span class="glyphicon glyphicon-shopping-cart"></span> (<span id = "count">0</span>)</h4>
					<table class = "table">
						<tr>
							<th>Name</th>
							<th>Price</th>
						</tr>
						<tr>
							<td colspan = "2">
								<table width = "100%" id = 'show_product_detail'>
								</table>
							</td>
						</tr>
						<tr>
							<td>Delivery Charges</td>
							<td>INR 100</td>
						</tr>
						<tr>
							<th>Total</th>
							<th>INR <span class = "total">0</span></th>
						</tr>
					</table>
					<button class = "btn btn-success" id = "final">Place Order</button>
				</div>
			</div></div>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script>
		var count = 0, total = 100;
			$(document).ready(function(){
				$.getJSON( "server/pizzas.json", function(data) {
				  for(var i = 0; i<(data.pizza).length; i++){
					$("#hidden").append(data.pizza[i].name+"-");
					//alert((data.pizza[i].price-(data.pizza[i].price*data.pizza[i].discount)/100))
					$("#show_product").append("<div class = 'col-md-4'><img src = '"+data.pizza[i].image+"'><h4><strong>"+data.pizza[i].name+"</strong></h4><p class = 'red'>Discount "+data.pizza[i].discount+"%<p>"+data.pizza[i].ingredients+"</p></p><p id = 'max-data'><strong>INR "+(data.pizza[i].price-(data.pizza[i].price*data.pizza[i].discount)/100)+"</strong> | <strike><strong>INR "+data.pizza[i].price+"</strong></strike> | Size : "+data.pizza[i].size+" | <button class = 'btn btn-primary' id = '"+data.pizza[i].name+"-"+data.pizza[i].price+"' onclick = 'add_to_cart("+data.pizza[i].price+","+data.pizza[i].id+","+data.pizza[i].discount+")'>Add to cart</button></p></div>");
				  }
				});
				if($('#count').html() == '0'){
					$("#final").prop('disabled',true)
				}
			})
			var order = {}; pizza = {};
			order.pizza_name = [];
			function add_to_cart(price, id, discount){
				var a = ($("#hidden").html()).split("-");
				count++;
				dicount_price = price-(price*discount/100);
				$('#count').html(count);
				$("#show_product_detail").append("<tr><td>"+a[id]+"</td><td>"+dicount_price+"</td></tr>");
				pizza.name = a[id];
				pizza.price = dicount_price;
				order.pizza_name[count] = pizza;
				total = total + dicount_price;
				$(".total").html(total);
				if($('#count').html() != '0'){
					$("#final").prop('disabled',false)
					$("#final").click(function(){
						$.post('server/order.php',{'order':order}, function(data, status){
							alert(data);
						});
						//alert()
					})
				}
			}
		</script>
	</body>
</html>
