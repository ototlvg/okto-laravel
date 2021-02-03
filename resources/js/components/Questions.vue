<template>
    <div class="questions contenedor p-4 p-md-0 pt-lg-4">
        <button @click="eliminar">Eliminar</button>
        <button @click="check">Get</button>
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
                        <input type="text" name="" id="" class="form-control" :placeholder="'Pregunta ' + (indexQuestion+1)" v-model="question.pregunta">
                    </div>

                    <div class="col-4">
                        <select class="form-select" aria-label="Default select example" @change="onChangeAnswer($event, indexQuestion)">
                            <option :selected="true" disabled hidden>Respuesta correcta</option>
                            <option v-for="(answer,indexAnswer) in question.respuestas" :key="indexAnswer" :value="indexAnswer">{{answer.respuesta}}</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <button type="button" class="btn btn-success w-100" @click="storeQuestion(indexQuestion)">Guardar</button>
                    </div>
                </div>

                <div class="d-flex w-100 flex-wrap">
                    <div class="d-flex answer w-100 mb-4" v-for="(answer,indexAnswer) in question.respuestas" :key="indexAnswer">
                        <div class="d-flex pe-3 align-items-center text-secondary">
                            <button v-if="question.id != 0" type="button" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-check-fill"></i></button>
                            <!-- <i class="bi bi-record-circle" v-else></i> -->
                            <i class="bi bi-circle" v-else></i>
                            <!-- <i class="bi bi-file-earmark-check-fill"></i> -->
                        </div>
                        <div class="d-flex flex-grow-1">
                            <input type="text" name="" id="" class="form-control" v-model="answer.respuesta">
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
axios.defaults.baseURL = '/api/coordinador/areas/';
export default {
    name: 'Questions',
    data() {
        return {
            key: 1,
            preguntas: [
                {
                    id: 0,
                    item: 1,
                    pregunta: 'Pregunta 111',
                    respuesta_correcta: [],
                    respuestas: [
                        {
                            id: 0,
                            item: 1,
                            respuesta: 'Uno',
                            pregunta_id: 0,
                        },
                        {
                            id: 0,
                            item: 2,
                            respuesta: 'Dos',
                            pregunta_id: 0,
                        }
                    ]
                },
                {
                    id: 0,
                    item: 1,
                    pregunta: '',
                    respuesta_correcta: [],
                    respuestas: [
                        {
                            id: 0,
                            item: 1,
                            respuesta: 'YEYE',
                            pregunta_id: 0,
                        },
                        {
                            id: 0,
                            item: 2,
                            respuesta: 'YOYO',
                            pregunta_id: 0,
                        }
                    ]
                },
            ]
        }
    },
    methods: {
        addQuestion() {
            this.preguntas.unshift(
                {
                    id: 0,
                    item: 1,
                    pregunta: '',
                    respuesta_correcta: [],
                    respuestas: [
                        {
                            id: 0,
                            item: 1,
                            respuesta: 'Uno',
                            pregunta_id: 0,
                        },
                        {
                            id: 0,
                            item: 2,
                            respuesta: 'Dos',
                            pregunta_id: 0,
                        }
                    ]
                },
            )
        },
        destroyQuestion(indexQuestion){
            this.preguntas.splice(indexQuestion,1)
        },
        addAnswer(indexQuestion){
            let respuestas = this.preguntas[indexQuestion].respuestas

            respuestas.push(
                {
                    id: 0,
                    item: respuestas.length+1,
                    respuesta: 'Numero ' + (respuestas.length+1),
                    pregunta_id: 0,
                }
            )
        },
        destroyAnswer(indexQuestion, indexAnswer){
            let respuestas = this.preguntas[indexQuestion].respuestas

            respuestas.splice(indexAnswer,1)

        },

        storeQuestion(indexQuestion){
            let question = this.preguntas[indexQuestion]
            let answers = question.respuestas

            let questionReady = true
            let allAnswersReady = true
            let correctAnswerReady = true

            // detectar que se halla escogido respuesta correcta
            if(question.respuesta_correcta.length==0){
                correctAnswerReady = false
                alert('elige respuesta correcta')
                return false
            }

            // detectar que la pregunta tenga texto
            if(question.pregunta == ''){
                questionReady = false
                alert('contesta la pregunta')
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
                alert('contesta todas las preguntas')
                return false
            }


            alert('Podemos guardar la respuesta')

        },



        onChangeAnswer(event,index){
            console.log('Energia')
            let indexQuestion = index
            let indexAnswer = event.target.value
            // console.log('Index de respuesta: '+ event.target.value)
            // console.log('Index de pregunta: ' + index)

            console.log('Index de pregunta: ' + indexQuestion)
            console.log('Index de respuesta: '+ indexAnswer)
            console.log(this.preguntas[indexQuestion].respuestas[indexAnswer])

            let respuesta_correcta = this.preguntas[indexQuestion].respuestas[indexAnswer]

            this.preguntas[indexQuestion].respuesta_correcta[0] = respuesta_correcta

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
</style>