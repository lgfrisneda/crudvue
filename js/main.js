var url = "db/crud.php";

new Vue ({
	el:"#app",
	data:{
		libros:[],
		nombre:"",
		dueno:"",
		estado:""
	},
	methods:{
		addLibro:async function(){
			const { value: formValues } = await Swal.fire({
				title: 'Nuevo libro',
				html:
				'<div class="form-group"><input class="form-control" id="nombre" type="text" placeholder="Nombre del libro"></div>'+
				'<div class="form-group"><input class="form-control" id="dueno" type="text" placeholder="Dueno del libro"></div>'+
				'<div class="form-group"><select class="form-control" id="estado">'+
				'<option value="">Seleccione</option><option value="Leido">Leido</option><option value="Por Leer">Por Leer</option>'+
				'</select></div>',
				focusConfirm: false,
				showCancelButton: true,
				confirmButtonText: 'Guardar',
				confirmButtonColor: '#3885d6',
				cancelButtonColor: '#dc3545',
				preConfirm: () => {
					return [
					  this.nombre = document.getElementById('nombre').value,
					  this.dueno = document.getElementById('dueno').value,
					  this.estado = document.getElementById('estado').value
					]
				}
			})

			if(this.nombre == "" || this.dueno == "" || this.estado == ""){
				Swal.fire({
					type: 'info',
					title: 'Datos incompletos',
				})
			}else{
				this.createLibro();

				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000
				});
				Toast.fire({
					icon: 'success',
					title: 'Producto guardado exitosamente!'
				})
			}

			// if (formValues) {
			// 	Swal.fire(JSON.stringify(formValues))
			// }
		},
		editLibro:async function(id, nombre, dueno, estado){
			const { value: formValues } = await Swal.fire({
				title: 'Editar libro',
				html:
				'<div class="form-group"><input class="form-control" id="nombre" type="text" value="'+nombre+'"></div>'+
				'<div class="form-group"><input class="form-control" id="dueno" type="text" value="'+dueno+'"></div>'+
				'<div class="form-group"><select class="form-control" id="estado">'+
				'<option value="'+estado+'" >'+estado+'</option><option value="Leido" >Leido</option><option value="Por Leer">Por Leer</option>'+
				'</select></div>',
				focusConfirm: false,
				showCancelButton: true,
				confirmButtonText: 'Guardar',
				confirmButtonColor: '#3885d6',
				cancelButtonColor: '#dc3545',
				}).then((result) => {
					if(result.value){
						nombre = document.getElementById('nombre').value,
						dueno = document.getElementById('dueno').value,
						estado = document.getElementById('estado').value,

						this.updateLibro(id,nombre,dueno,estado);
						Swal.fire(
							'Modificado!',
							'El registro ha sido modificado exitosamente.',
							'success'
							)
					}
				});
			// if (formValues) {
			// 	Swal.fire(JSON.stringify(formValues))
			// }
		},
		deleteLibro:function(id, nombre){
			Swal.fire({
				title:'Desea borrar de la lista el libro '+nombre+'?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Borrar',
				confirmButtonColor: '#3885d6',
				cancelButtonColor: '#dc3545',
			}).then((result) => {
				if(result.value){
					this.borrarLibro(id);

					Swal.fire(
						'Borrado!',
						'El libro ha sido eliminado de la lista.',
						'success'
					)
				}
			})
		},
		listarLibros:function(){
			axios.post(url, {option:2}).then(res => {
				this.libros = res.data;

				//console.log(this.libros);
			});
		},
		createLibro:function(){
			axios.post(url, {option:1, nombre:this.nombre, dueno:this.dueno, estado:this.estado}).then(res => {
				this.listarLibros();
			});
			this.nombre = "";
			this.dueno = "";
			this.estado = "";
		},
		updateLibro:function(id, nombre, dueno, estado){
			axios.post(url, {option:3, id:id, nombre:nombre, dueno:dueno, estado:estado}).then(res => {
				this.listarLibros();
			});
		},
		borrarLibro:function(id){
			axios.post(url, {option:4, id:id}).then(res => {
				this.listarLibros();
			});
		}
	},
	created:function(){
		this.listarLibros();
	},
	computed:{
		totalLibros:function(){
			return this.libros.length;
		}
	}
})