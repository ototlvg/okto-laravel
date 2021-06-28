<template>
    <div id="app">

        <div class="loading" v-show="loading">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <h2 class="mb-3">Profesores</h2>
                <table class="table table-bordered align-middle bg-white table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">No. Empleado</th>
                            <th scope="col" class="text-center">Nombre</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="profesores != null">
                        <tr v-for="(profesor,index) in filteredprofesores" :key="index">
                            <th class="text-center" scope="row">{{profesor.id}}</th>
                            <td class="text-center">{{profesor.noempleado}}</td>
                            <td class="text-center">{{profesor.name}} {{profesor.apaterno}}</td>
                            <td class="text-center">
                                <span class="material-icons text-primary pointer" @click="agregar(index)">add_circle</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-100 text-center" v-if="profesores.length==0">
                    <p>Sin profesores para agregar</p>
                </div>
            </div>
            <div class="col-6">
                <h2 class="mb-3">Profesores asignados</h2>
                <table class="table table-bordered align-middle bg-white">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">No. Empleado</th>
                            <th scope="col" class="text-center">Nombre</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="agregados != null">
                        <tr v-for="(agregado, index) in agregados" :key="index">
                            <th class="text-center" scope="row">{{agregado.id}}</th>
                            <td class="text-center">{{agregado.noempleado}}</td>
                            <td class="text-center">{{agregado.name}} {{agregado.apaterno}}</td>
                            <td class="text-center">
                                <span class="material-icons text-danger pointer" @click="eliminar(index)">remove_circle</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-100 text-center" v-if="agregados.length==0">
                    <p>Sin profesores agregados</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
/* axios.defaults.baseURL = 'http://localhost:4200/api/admin' */
export default {
    name: "Profesores",
    created(){
        /* console.log('Exitos') */
        this.getProfesores()
    },
    data(){
        return {
            sidebarOpen: false,
            profesores: null,
            agregados: [],
            loading: false
        }
    },
    methods: {
        getProfesores(){ // Deberia de llamarse getCarreras
            let este = this
            axios.get('/api/coordinador/getprofesores')
                .then(function (response) {
                    console.log(response);
                    este.profesores = response.data
                    este.getAgregados()
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                }); 
        },
        getAgregados(){
            let este= this
            axios.get('/api/coordinador/getagregados', {params : {
                carreraid: window.carreraid
            }})
                .then(function (response) {
                    console.log(response);
                    este.agregados = response.data
                    este.checkFilter()
                    // este.filterprofesores()
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
        checkFilter(){
            let self = this
            let i
            if(!this.agregados.length == 0){
                this.agregados.forEach( profesoragregado => {
                    i= 0
                    self.profesores.forEach( profesor => {
                        if(profesoragregado.id == profesor.id){
                            self.profesores.splice(i,1)
                        }
                        i++
                    })
                })
            }
        },
        agregar(index){
            let self = this
            var removed = this.profesores.splice(index,1);

            console.log(removed)

            self.loading = true
            axios.post('/api/coordinador/addprofesortocarrera', {
                profesorid: removed[0].id,
                carreraid: window.carreraid
            })
            .then(function (response) {
                console.log(response);
                self.loading = false

            })
            .catch(function (error) {
                console.log(error);
                self.loading = false
            });
            
            self.agregados.push(removed[0])



            // console.log(removed[0])
        },
        eliminar(index){
            let elementForRemove = this.agregados[index]
            let removedCarrera
            let self = this
            // console.log(elementForRemove)

            self.loading = true
            axios.post('/api/coordinador/deletecarrerafromprofesor', {
                profesorid: elementForRemove.id,
                carreraid: window.carreraid
            })
            .then(function (response) {

                console.log('Retorno: ' + response.data);
                let i = 0
                self.agregados.forEach(element => {
                    console.log(element)
                    if(element.id == response.data){
                        console.log('Encontrado: ' + i)

                        let removedProfesor = self.agregados.splice(i,1)
                        
                        
                        
                        // self.getProfesores()
                        self.profesores.push(removedProfesor[0])
                    }
                    i++;
                });
            })
            .catch(function (error) {
                console.log(error);
            })
            .then( () => {
                self.loading = false
            })
        },
    },
    computed:{
        filteredprofesores(){
            if(this.agregados.length == 0){
                return this.profesores
            }else{
                let agregados = this.agregados;
                let filtered = this.profesores.filter(function(value, index, arr){
                    
                    let flag = true
                    agregados.forEach(element => {
                        if(element.id == value.id){
                            flag = false
                        }
                        
                    });
                    return flag;
                });

                return filtered

            }
        }
    }
}
</script>>

<style>
    .pointer{
        cursor: pointer;
    }

    .loading{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>