<template>
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Edicion de Editoriales</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Editoriales
                        <button type="button" class="btn btn-secondary float-right ml-1" @click="abrirModal(0)">
                            <i class="icon-plus"></i>&nbsp;Nueva
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="filtro">
                                        <option value="nombre">Nombre</option>
                                        <option value="descripcion">Descripcion</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEditoriales(1,buscar, filtro)" class="form-control" placeholder="...">
                                    <button type="submit" @click="listarEditoriales(1, buscar, filtro)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="editorial in arrayEditoriales" :key="editorial._id.$iod">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirModal(1, editorial)">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="editorial.estado">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarEditorial(editorial._id.$oid)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-success btn-sm" @click="activarEditorial(editorial._id.$oid)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="editorial.nombre"></td>
                                <td v-text="editorial.descripcion"></td>
                                <td>
                                    <div v-if="editorial.estado">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivado</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, filtro)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, filtro)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, filtro)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>

            <!-- Zona de Modales o ventanas del CRUD -->
            <!-- Modal agregar categorias -->
            <vue-window-modal :active="mostrarMR" width="400px" height="300px" :title="tituloVentana"  v-on:clickClose="mostrarMR=false">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" v-if="accion===0" class="btn btn-success" @click="registrarEditorial">Guardar</button>
                            <button type="button" v-if="accion===1" class="btn btn-success" @click="actualizarEditorial">Actualizar</button>
                        </div>
                    </div>
                </div>
            </vue-window-modal>
        </div>
    </main>
</template>

<script>
    import Swal from 'sweetalert2';
    export default {
        data() {
            return {
                mostrarMR: false,
                accion: 0,
                tituloVentana: '',
                arrayEditoriales:[],
                id: 0,
                nombre: '',
                descripcion: '',
                estado: '',
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                filtro: "nombre",
                buscar: ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;

            }
        },
        methods: {
            abrirModal(accion, data=[]) {
                switch(accion){
                    case 0:
                    {
                        this.tituloVentana = 'Nuevo editorial';
                        this.nombre = '';
                        this.descripcion = '';
                        this.mostrarMR = true;
                        this.accion = 0;
                        break;
                    }
                    case 1:
                    {
                        this.tituloVentana = 'Actualizar editorial';
                        this.nombre = data['nombre'];
                        this.descripcion = data['descripcion'];
                        this.id = data['_id'].$oid;
                        this.mostrarMR = true;
                        this.accion = 1;
                        break;
                    }

                }
            },
            listarEditoriales(page, buscar, filtro){
                let me = this;
                let url = '/editorial?page=' + page + '&buscar=' + buscar + '&filtro=' + filtro;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    me.arrayEditoriales = respuesta.editoriales.data;
                    me.pagination = respuesta.pagination;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            cambiarPagina(page, buscar, filtro){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarEditoriales(page, buscar, filtro);
            },
            //TODO
            registrarEditorial(){
                let me = this;
                axios.post('/editorial/registrar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Editorial agregada con exito!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    me.mostrarMR = false;
                    me.listarEditoriales(1,'','nombre');
                }).catch(function (error) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'warning',
                        title: 'Error (' + error.status + '): ' + error
                    });
                });
            },
            actualizarEditorial(){
                let me = this;
                axios.put('/editorial/actualizar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id': this.id
                }).then(function (response) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Editorial actualizada con exito!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    me.mostrarMR = false;
                    me.listarEditoriales(1,'','nombre');
                }).catch(function (error) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'warning',
                        title: 'Error (' + error.status + '): ' + error
                    });
                })
            },
            desactivarEditorial(id){
                Swal.fire({
                    title: 'Esta seguro de eliminar esta Editorial?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/editorial/desactivar',{
                            'id': id
                        }).then(function (response) {
                            me.listarEditoriales(1,'','nombre');
                            Swal.fire({
                                title:'Desactivado!',
                                text:'El registro ha sido desactivado con éxito.',
                                type:'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }).catch(function (error) {
                            console.log(error);
                        });


                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {

                    }
                });
            },
            activarEditorial(id){
                Swal.fire({
                    title: 'Esta seguro de recuperar esta Editorial?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/editorial/activar',{
                            'id': id
                        }).then(function (response) {
                            me.listarEditoriales(1,'','nombre');
                            Swal.fire({
                                title:'Recuperado!',
                                text:'El registro ha sido recuperado con éxito.',
                                type:'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }).catch(function (error) {
                            console.log(error);
                        });


                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {

                    }
                });
            }
        },
        mounted() {
            this.listarEditoriales(1, this.buscar, this.filtro);
        }
    }
</script>
<style>
    form{
        margin-top: 15px;
    }
</style>
