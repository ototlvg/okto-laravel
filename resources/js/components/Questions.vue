<template>
    <div class="questions contenedor p-4 p-md-0 pt-lg-4">
        <div class="loading" v-show="loading">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <!-- <button @click="eliminar">Eliminar</button>
        <button @click="check">Get</button> -->
        <div class="d-flex flex-wrap w-100 p-4 border mb-4">
            <div class="col-6 d-flex justify-content-start align-items-center">
                <p class="fs-4 fw-bold m-0">Agregar preguntas</p>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">                
                <button type="button" class="btn btn-primary" @click="addQuestion">Agregar pregunta</button>
            </div>
        </div>

        <div class="d-flex flex-wrap w-100">
            <div class="question w-100 border p-4 mb-4" v-for="(question,indexQuestion) in preguntas" :key="indexQuestion">
                
                <div class="row mb-4">
                    <div class="col-6">
                        <input type="text" name="" class="form-control" :placeholder="'Pregunta ' + (indexQuestion+1)" v-model="question.pregunta" @keyup.enter="updateQuestion(indexQuestion)">
                    </div>

                    <div class="col">
                        <select class="form-select" aria-label="Default select example" @change="onChangeAnswer($event, indexQuestion)" v-model="question.respuesta_correcta">
                            <!-- <option :selected="true" disabled hidden>Respuesta correcta</option> -->
                            <option :value="undefined" disabled style="display:none">Seleccione una opcion</option>
                            <option v-for="(answer,indexAnswer) in question.respuestas" :key="indexAnswer" :value="answer">{{answer.respuesta}}</option>
                        </select>
                    </div>

                    <div class="col-2" v-if="question.id==0">
                        <button type="button" class="btn btn-success w-100" @click="storeQuestion(indexQuestion)">Guardar</button>
                        <!-- <button type="button" class="btn btn-secondary w-100" v-else>Guardar</button> -->
                    </div>
                </div>

                <div class="d-flex w-100 flex-wrap">
                    <div class="d-flex answer w-100 mb-4" v-for="(answer,indexAnswer) in question.respuestas" :key="indexAnswer">
                        <div class="d-flex pe-3 align-items-center text-secondary">
                            <button v-if="answer.id!=0" type="button" class="btn btn-success btn-sm" @click="updateAnswer(indexQuestion,indexAnswer)"><i class="bi bi-file-earmark-check-fill"></i></button>
                            <i class="bi bi-circle" v-else></i>
                            <!-- <i class="bi bi-record-circle" v-else></i> -->
                            <!-- <i class="bi bi-file-earmark-check-fill"></i> -->
                        </div>
                        <div class="d-flex flex-grow-1">
                            <input @keyup="answerTextChange(indexQuestion,indexAnswer)" @keyup.enter="updateAnswer(indexQuestion,indexAnswer)" type="text" name="" class="form-control" v-model="answer.respuesta"  :placeholder="'Respuesta ' + (indexAnswer+1)">
                        </div>
                        <div class="d-flex ps-3 align-items-center">
                            <i class="bi bi-x-octagon-fill text-danger pointer" @click="destroyAnswer(indexQuestion, indexAnswer)"></i>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 justify-content-between">
                    <i class="bi bi-plus-square-dotted fs-5 pointer text-primary" @click="addAnswer(indexQuestion)"></i>
                    <i class="bi bi-trash-fill fs-5 pointer text-danger" @click="destroyQuestion(indexQuestion)"></i>
                </div>

            </div>

        </div>


        <!-- <div v-for="(question,index) in questions" :key="index">
            <p>{{question.question}}</p>
        </div> -->
    </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
axios.defaults.baseURL = '/api/coordinador/areas/';
export default {
    name: 'Questions',
    data() {
        return {
            key: 1,
            loading: false,
            preguntas: [
                // {
                //     id: 0,
                //     item: 1,
                //     pregunta: 'Pregunta 111',
                //     respuesta_correcta: undefined,
                //     respuestas: [
                //         {
                //             id: 0,
                //             item: 1,
                //             respuesta: 'Uno',
                //             pregunta_id: 0,
                //         },
                //         {
                //             id: 0,
                //             item: 2,
                //             respuesta: 'Dos',
                //             pregunta_id: 0,
                //         }
                //     ]
                // },
            ]
        }
    },
    created () {

        let self = this
        axios.get('preguntas', {
            params: {
                areaid: window.areaid
            }
        })
        .then(function (response) {
            console.log('respuestas')
            console.log(response);
            let preguntas = response.data

            preguntas.forEach(element => {
                element.respuesta_correcta = element.respuesta_correcta.respuesta
            });

            self.preguntas = response.data
        })
        .catch(function (error) {
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    },
    methods: {
        answerTextChange(indexQuestion, indexAnswer){
            // console.log(indexQuestion)
            let question = this.preguntas[indexQuestion]

            if(question.id != 0){
                let answer = question.respuestas[indexAnswer]
                // console.log(question.respuestas[indexAnswer])
    
                if(answer.id == question.respuesta_correcta.id){
                    console.log('correcto')
                    question.respuesta_correcta.respuesta = answer.respuesta
                }

            }


        },
        updateQuestion(indexQuestion){
            let question = this.preguntas[indexQuestion]
            let questionid = question.id

            if(questionid!=0){
                axios.put(`preguntas/${questionid}`, {
                    question: question.pregunta
                })
                .then((response) => {
                    console.log(response);
                    this.loading = false
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pregunta actualizada',
                        showConfirmButton: false,
                        timer: 800
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });
            }else{
                console.log('el id de la pregunta es 0, por lo que no se actualiza el nombre de la pregunta')
            }

        },

        addQuestion() {
            this.preguntas.unshift(
                {
                    id: 0,
                    item: 1,
                    pregunta: '',
                    respuesta_correcta: undefined,
                    respuestas: [
                        {
                            id: 0,
                            item: 1,
                            respuesta: '',
                            pregunta_id: 0,
                        },
                        {
                            id: 0,
                            item: 2,
                            respuesta: '',
                            pregunta_id: 0,
                        }
                    ]
                },
            )
        },
        destroyQuestion(indexQuestion){
            Swal.fire({
                title: '¿Esta seguro?',
                text: "La pregunta se eliminara permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
            if (result.isConfirmed) {
                
                let question = this.preguntas[indexQuestion]
                let questionid = question.id

                if(questionid!=0){
                    this.loading = true
                    axios.delete(`preguntas/${questionid}`)
                    .then((response) => {
                        console.log(response)
                        this.preguntas.splice(indexQuestion,1)
                        this.loading = false
                        Swal.fire(
                            'Pregunta eliminada',
                            'La pregunta se elimino satisfactoriamente ',
                            'success'
                        )
                    })
                    .catch((error) => {
                        alert('error')
                    });
                }else{
                    this.preguntas.splice(indexQuestion,1)
                }

            }
            })
        },
        addAnswer(indexQuestion){
            let pregunta = this.preguntas[indexQuestion]
            let respuestas = pregunta.respuestas

            if(pregunta.id!=0){
                this.loading = true
                let areaid = window.areaid
    

                axios.post('preguntas/addanswer', {
                    areaid: window.areaid,
                    questionid: this.preguntas[indexQuestion].id
                })
                .then((response) => {
                    console.log('respuesta de agregar answer')
                    console.log(response.data);
                    respuestas.push(response.data)
                    this.loading = false
                })
                .catch((error) => {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                });


            }else{
                console.log('la pregunta aun no ha sido guardada')
                let item = respuestas[respuestas.length-1].item+1

                let obj = {
                    id: 0,
                    item: item,
                    respuesta: '',
                    pregunta_id: 0,
                }

                respuestas.push(obj)
                // console.log(item)
            }
        },
        destroyAnswer(indexQuestion, indexAnswer){
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Se eliminara la respuesta permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                    

                    let pregunta = this.preguntas[indexQuestion]
                    let respuestas = pregunta.respuestas
                    let respuesta = respuestas[indexAnswer]
                    let respuesta_correcta = pregunta.respuesta_correcta

                    if(respuestas.length<=2){
                        // alert('no puede haber menos de una pregunta')
                        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Cantidad de respuestas',
                            text: 'No puede haber menos de 2 respuestas',
                        })
                        return false
                    }

                    if(!(respuesta_correcta == undefined)){
                        console.log('hay una respuesta correcta seleccionada: ')
                        console.log(respuesta_correcta)
                        if(respuesta_correcta.respuesta == respuesta.respuesta){
                            console.log('la respuesta a eliminar esta marcada como respuesta correcta')
                            // alert('la respuesta a eliminar esta marcada como respuesta correcta, primero escoja otra respuesta y despues elimine la respuesta que esta tratando de eliminar')

                            Swal.fire({
                                icon: 'error',
                                title: 'Se esta intentando eliminar la respuesta correcta',
                                text: 'La respuesta a eliminar esta marcada como respuesta correcta, primero escoja otra respuesta correcta y despues elimine la respuesta que esta tratando de eliminar',
                            })

                            return false
                            // respuesta_correcta = undefined
                        }
                    }

                    if(pregunta.id != 0){
                        this.loading = true
                        
                        console.log('respuesta a eliminar: ')
                        console.log(respuesta)
    
                        axios.delete(`preguntas/destroyAnswer/${respuesta.id}`)
                        .then(function (response) {
                            console.log(response);
                            respuestas.splice(indexAnswer,1)
                            this.loading = false
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Respuesta eliminada',
                                showConfirmButton: false,
                                timer: 800
                            })
                        }.call(this))
                        .catch(function (error) {
                            console.log(error);
                        });
                    }else{
                        respuestas.splice(indexAnswer,1)
                    }


                }
            })



        },

        storeQuestion(indexQuestion){
            let question = this.preguntas[indexQuestion]
            let answers = question.respuestas

            let questionReady = true
            let allAnswersReady = true
            let correctAnswerReady = true

            //
            if(question.respuestas.length<2){
                alert('debes tener al menos dos respuestas')
                return false
            }

            // detectar que la pregunta tenga texto
            if(question.pregunta == ''){
                questionReady = false
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos vacios',
                    text: 'Llene el campo de la pregunta',
                })  
                return false
            }
                
            // Detectar si todas las respuestas tienen texto
            for (let i = 0; i < answers.length; i++) {
                const element = answers[i];
                
                if(element.respuesta == ''){
                    allAnswersReady = false
                    i = answers.length
                }
            }

            if(!allAnswersReady){
                // alert('Llene todos los campos de las respuestas')
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos vacios',
                    text: 'Llene todos los campos de las respuestas',
                })                
                return false
            }


            // detectar que se halla escogido respuesta correcta
            if(question.respuesta_correcta==undefined){
                correctAnswerReady = false
                // alert('elige respuesta correcta')
                Swal.fire({
                    icon: 'warning',
                    title: 'Respuesta correcta no seleccionada',
                    text: 'Elija la respuesta correcta',
                })  
                return false
            }


            // alert('Podemos guardar la respuesta')
            this.loading = true
            let self = this

            axios.post('preguntas', {
                question: question,
                areaid: window.areaid
            })
            .then((response) => {
                console.log('respuesta a post')
                // console.log(response.data);
                // console.log('INDEXXX: ' + indexQuestion)
                // console.log(question)
                question.id = response.data.id

                for (let i = 0; i < question.respuestas.length; i++) {
                    const element = question.respuestas[i];

                    element.id = response.data.respuestas[i].id
                    
                }
                this.loading = false
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pregunta creada correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            .catch((error) => {
                console.log(error);
                alert('error')
            });
        },

        updateAnswer(indexQuestion,indexAnswer){
            let question = this.preguntas[indexQuestion]
            let answer = question.respuestas[indexAnswer]
            // console.log('se imprimira la respuesta a guardar')
            // console.log(answer)
            axios.post('preguntas/updateanswer', {
                answerid: answer.id,
                answer: answer.respuesta
            })
            .then(function (response) {
                console.log('respuesta actualizar answer')
                console.log(response.data);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    timer: 800
                })
            })
            .catch(function (error) {
                console.log(error);
            });
        },


        updateCorrectAnswer(questionid, newCorrectAnswer){
            console.log('se actualizara answer')
            // console.log(questionid)
            // console.log(newCorrectAnswer)

            axios.post('preguntas/updatecorrectanswer', {
                questionid: questionid,
                newCorrectAnswerId: newCorrectAnswer.id
            })
            .then(function (response) {
                console.log('respuesta actualizar answer')
                console.log(response.data);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    timer: 800
                })
            })
            .catch(function (error) {
                console.log(error);
            });
        },


        onChangeAnswer(event,index){
            console.log('Energia')

            let indexAnswer = event.target.value
            let indexQuestion = index



            let questionid = this.preguntas[indexQuestion].id


            if(questionid!=0){
                let newCorrectAnswer = this.preguntas[indexQuestion].respuesta_correcta
                this.updateCorrectAnswer(questionid, newCorrectAnswer)
            }else{
                console.log('la pregunta es nueva')
            }


        },
        eliminar(){
            this.questions.splice(0,1)
            console.log(this.questions)
        },
        check(){
            axios.get('preguntas', {
                params: {
                    ID: 12345
                }
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }
    },
}
</script>

<style>
*{
    box-sizing: border-box !important;
}
.contenedor{
    max-width: 770px;
    margin: 0 auto;
    /* background-color: red; */
}

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