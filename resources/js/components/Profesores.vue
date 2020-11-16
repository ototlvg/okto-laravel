<template>
    <div id="app">
        <div class="row mt-3">
            <div class="col-6">
                <h1 class="mb-3"><span class="badge badge-primary">Profesores</span></h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No. Empleado</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="profesores != null">
                        <tr v-for="(profesor,index) in filteredprofesores" :key="index">
                        <!-- <tr v-for="(profesor,index) in profesores" :key="index"> -->
                            <th scope="row">{{profesor.id}}</th>
                            <td>{{profesor.noempleado}}</td>
                            <td>{{profesor.name}} {{profesor.apaterno}}</td>
                            <td>
                                <span class="material-icons text-primary pointer" @click="agregar(index)">add_circle</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h1 class="mb-3"><span class="badge badge-success">Profesores asignados</span></h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No. Empleado</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="agregados != null">
                        <tr v-for="(agregado, index) in agregados" :key="index">
                            <th scope="row">{{agregado.id}}</th>
                            <td>{{agregado.noempleado}}</td>
                            <td>{{agregado.name}} {{agregado.apaterno}}</td>

                            <td>
                                <span class="material-icons text-danger pointer" @click="eliminar(index)">remove_circle</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            agregados: []
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

            var removed = this.profesores.splice(index,1);

            console.log(removed)
            axios.post('/api/coordinador/addprofesortocarrera', {
                profesorid: removed[0].id,
                carreraid: window.carreraid
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
            
            this.agregados.push(removed[0])



            // console.log(removed[0])
        },
        eliminar(index){
            let elementForRemove = this.agregados[index]
            let removedCarrera
            let este = this
            // console.log(elementForRemove)

            axios.post('/api/coordinador/deletecarrerafromprofesor', {
                profesorid: elementForRemove.id,
                carreraid: window.carreraid
            })
            .then(function (response) {

                console.log('Retorno: ' + response.data);
                let i = 0
                este.agregados.forEach(element => {
                    console.log(element)
                    if(element.id == response.data){
                        console.log('Encontrado: ' + i)

                        let removedProfesor = este.agregados.splice(i,1)
                        
                        
                        
                        // este.getProfesores()
                        este.profesores.push(removedProfesor[0])
                    }
                    i++;
                });
            })
            .catch(function (error) {
                console.log(error);
            });
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
</style>