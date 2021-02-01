<template>
    <div class="questions contenedor p-4 p-md-0 pt-lg-4">
        <button @click="eliminar">Eliminar</button>
        <div class="d-flex flex-wrap w-100 p-4 border mb-4">
            <div class="col-6 d-flex justify-content-start align-items-center">
                <p class="fs-4 fw-bold m-0">Agregar preguntas</p>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">                
                <button type="button" class="btn btn-primary" @click="addQuestion">Agregar pregunta</button>
            </div>
        </div>

        <div class="d-flex flex-wrap w-100">
            <div class="question w-100 border p-4 mb-4" v-for="(question,index) in preguntas" :key="index">
                
                <div class="row mb-4">
                    <div class="col-6">
                        <input type="text" name="" id="" class="form-control" :placeholder="'Pregunta ' + (index+1)" v-model="question.question">
                    </div>

                    <div class="col-4">
                        <select class="form-select" aria-label="Default select example" @change="onChangeAnswer($event, index)">
                            <!-- <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> -->
                            <option v-for="(answer,indexAnswer) in question.respuestas" :key="indexAnswer" :value="indexAnswer">{{answer.answer}}</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <button type="button" class="btn btn-success w-100">Guardar</button>
                    </div>
                </div>

                <div class="d-flex w-100 flex-wrap">
                    <div class="d-flex answer w-100 mb-4" v-for="(answer,index) in question.respuestas" :key="index">
                        <div class="d-flex pe-3 align-items-center text-secondary">
                            <button v-if="question.id != 0" type="button" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-check-fill"></i></button>
                            <!-- <i class="bi bi-record-circle" v-else></i> -->
                            <i class="bi bi-circle" v-else></i>
                            <!-- <i class="bi bi-file-earmark-check-fill"></i> -->
                        </div>
                        <div class="d-flex flex-grow-1">
                            <input type="text" name="" id="" class="form-control" v-model="answer.answer">
                        </div>
                        <div class="d-flex ps-3 align-items-center">
                            <i class="bi bi-x-octagon-fill text-danger pointer"></i>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 justify-content-between">
                    <i class="bi bi-plus-square-dotted fs-5 pointer text-primary"></i>
                    <i class="bi bi-trash-fill fs-5 pointer text-danger"></i>
                </div>

            </div>

        </div>


        <!-- <div v-for="(question,index) in questions" :key="index">
            <p>{{question.question}}</p>
        </div> -->
    </div>
</template>

<script>
export default {
    name: 'Questions',
    data() {
        return {
            key: 1,
            preguntas: [
                {
                    id: 1,
                    item: 1,
                    question: '',
                    correct: null,
                    respuestas: [
                        {
                            item: 1,
                            answer: 'Uno'
                        },
                        {
                            item: 2,
                            answer: 'Dos'
                        }
                    ] 
                },
                {
                    id: 0,
                    item: 2,
                    question: '',
                    correct: null,
                    respuestas: [
                        {
                            item: 1,
                            answer: 'Uno'
                        },
                        {
                            item: 2,
                            answer: 'Dos'
                        }
                    ] 
                },
                {
                    id: 0,
                    item: 3,
                    question: '',
                    correct: null,
                    respuestas: [
                        {
                            item: 1,
                            answer: 'Uno'
                        },
                        {
                            item: 2,
                            answer: 'Dos'
                        }
                    ] 
                }
            ]
        }
    },
    methods: {
        addQuestion() {
            this.questions.unshift(
                {
                    id: 0,
                    item: 1,
                    question: '',
                    correct: null,
                    answers: [
                        {
                            item: 1,
                            answer: 'Tres'
                        },
                        {
                            item: 2,
                            answer: 'Cuatro'
                        },
                        {
                            item: 3,
                            answer: 'Cinco'
                        }
                    ] 
                }
            )
        },
        onChangeAnswer(event,index){
            console.log('Energia')
            console.log('Index de respuesta: '+ event.target.value)
            console.log('Index de pregunta: ' + index)
        },
        eliminar(){
            this.questions.splice(0,1)
            console.log(this.questions)
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