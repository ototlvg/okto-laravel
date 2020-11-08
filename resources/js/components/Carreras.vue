<template>
    <div id="app">
        <div class="row mt-3">
            <div class="col-6">
                <h1 class="mb-3"><span class="badge badge-primary">Programas Educativos</span></h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Carrera</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="areas != null">
                        <tr v-for="(area,index) in filteredAreas" :key="index">
                        <!-- <tr v-for="(area,index) in areas" :key="index"> -->
                            <th scope="row">{{area.id}}</th>
                            <td>{{area.nombre}}</td>
                            <td>
                                <span class="material-icons text-primary pointer" @click="agregar(index)">add_circle</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h1 class="mb-3"><span class="badge badge-success">Programas educativos asignados</span></h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Area</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="agregados != null">
                        <tr v-for="(agregado, index) in agregados" :key="index">
                            <th scope="row">{{agregado.id}}</th>
                            <td>{{agregado.nombre}}</td>
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
    name: "Carreras",
    created(){
        /* console.log('Exitos') */
        this.getAreas()
        this.getAgregados()
    },
    data(){
        return {
            sidebarOpen: false,
            areas: null,
            agregados: []
        }
    },
    methods: {
        getAreas(){ // Deberia de llamarse getCarreras
            let este = this
            axios.get('/api/admin/getcarreras')
                .then(function (response) {
                    console.log(response);
                    este.areas = response.data
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
            axios.get('/api/admin/getagregados', {params : {
                profesorid: window.profesorid
            }})
                .then(function (response) {
                    console.log(response);
                    este.agregados = response.data

                    // este.filterAreas()
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        },
        agregar(index){

            // let disponibles = this.agregados.length;
            /* console.log(disponibles) */

            // if(disponibles == 3){
            //     console.log('Capacidad completa')
            //     return false
            // }

            var removed = this.areas.splice(index,1);

            console.log(removed)
            axios.post('/api/admin/storecarrera', {
                carreraid: removed[0].id,
                profesorid: window.profesorid
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
            let elementForRemove = this.agregados[index];
            let removedCarrera;
            let este = this
            // console.log(elementForRemove)

            axios.post('/api/admin/deletecarrera', {
                carreraid: elementForRemove.id,
                profesorid: window.profesorid
            })
            .then(function (response) {
                console.log('Retorno: ' + response.data);
                let i = 0
                este.agregados.forEach(element => {
                    console.log(element)
                    if(element.id == response.data){
                        console.log('Encontrado: ' + i)

                        // este.areas.push(este.agregados[i])
                        este.agregados.splice(i,1)
                        este.getAreas()
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
        filteredAreas(){
            if(this.agregados.length == 0){
                return this.areas
            }else{
                let agregados = this.agregados;




                let filtered = this.areas.filter(function(value, index, arr){
                    
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