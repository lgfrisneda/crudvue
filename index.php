<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP-VUE</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- font-awesome -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

	<!-- sweetalert2 -->
	<link rel="stylesheet" type="text/css" href="plugins/sweetalert2/sweetalert2.min.css">

	<!-- css local -->
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body class="container">
	<header>
		<h1 class="text-center display-3">Lista de libros</h1>
	</header>
	<div id="app">
		<div class="row">
			<div class="col">
				<button type="button" class="btn btn-outline-success" @click="addLibro"><i class="fas fa-plus"></i></button>
				
			</div>
			<div class="col text-center">
				<button type="button" class="btn btn-secondary" @click="searchLibros"><i class="fas fa-search"></i></button>
			</div>
			<div class="col text-right">
				<h5>Total: <span class="badge badge-primary">{{ totalLibros }}</span></h5>
			</div>
		</div>
		<div class="row mt-4">
			<table class="table table-sm table-hover">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>NOMBRE</th>
						<th>DUEÑO</th>
						<th>ESTADO</th>
						<th class="text-center">ACCIONES</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(libro, indice) of libros">
						<td>{{ libro.id }}</td>
						<td><em>{{ libro.nombre }}</em></td>
						<td>{{ libro.dueno }}</td>
						<td>
							<span v-if="(libro.estado == 'Leido')" class="badge badge-success">{{ libro.estado }}</span>
							<span v-else class="badge badge-warning">{{ libro.estado }}</span>
						</td>
						<td class="text-center">
							<div>
								<button class="btn btn-sm btn-info" @click="editLibro(libro.id, libro.nombre, libro.dueno, libro.estado)">
									<i class="fas fa-pen"></i>
								</button>
								<button class="btn btn-sm btn-danger" @click="deleteLibro(libro.id, libro.nombre)">
									<i class="fas fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<!-- popper -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<!-- bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<!-- vue -->
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>

	<!-- axios -->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

	<!-- sweetalert2 -->
	<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

	<!-- js local -->
	<script src="js/main.js"></script>

</body>
</html>