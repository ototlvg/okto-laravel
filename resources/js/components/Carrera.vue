<template>
    <div id="app">
        <div class="row">
            <div class="col-6">
                <p>Disponible</p>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Area</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody v-if="areas != null">
                        <tr v-for="(area,index) in filteredAreas" :key="index">
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
                <p>Areas agregadas</p>
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
    name: "Carrera",
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
        getAreas(){
            let este = this
            axios.get('/api/admin/getareas')
                .then(function (response) {
                    /* console.log(response); */
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
                idcarrera: window.carrera.id
            }})
                .then(function (response) {
                    // console.log(response);
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

            let disponibles = this.agregados.length;
            /* console.log(disponibles) */

            if(disponibles == 3){
                console.log('Capacidad completa')
                return false
            }

            var removed = this.areas.splice(index,1);

            console.log(removed)
            axios.post('/api/admin/storearea', {
                idarea: removed[0].id,
                idcarrera: window.carrera.id
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
            var removed = this.agregados.splice(index,1);

            console.log(removed)
            axios.post('/api/admin/deletearea', {
                idarea: removed[0].id,
                idcarrera: window.carrera.id
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

            // this.areas.push(removed[0])
            this.areas.unshift(removed[0])
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