<template>
  <div>
    <input type="text" class="question-input" placeholder="What needs to be done" v-model="newQuestion" @keyup.enter="addQuestion">
    <transition-group name="fade" enter-active-class="animated fadeInUp" leave-active-class="animated fadeOutDown">
    <question v-for="question in questionsFiltered" :key="question.id" :question="question" @removedQuestion="removeQuestion" @finishedEdit="finishedEdit">
    </question>
    </transition-group>

    <div class="extra-container">
      <div><label><input type="checkbox" :checked="!anyRemaining" @change="checkAllQuestions"> Check All</label></div>
      <div>{{ remaining }} items left</div>
    </div>

    <div class="extra-container">

      <div>
        <transition name="fade">
        <button v-if="showClearCompletedButton" @click="clearCompleted">Clear Completed</button>
        </transition>
      </div>

    </div>
  </div>
</template>

<script>
import Question from './Question'

export default {
  name: 'questions',
  components: {
    Question,
  },
  data () {
    return {
      newQuestion: '',
      idForQuestion: 3,
      questions: [
        {
          'id': 1,
          'title': 'Finish Vue Screencast',
          'completed': false,
          'editing': false,
        },
        {
          'id': 2,
          'title': 'Take over world',
          'completed': false,
          'editing': false,
        },
      ]
    }
  },
  computed: {
    remaining() {
      return this.questions.filter(question => !question.completed).length
    },
    anyRemaining() {
      return this.remaining != 0
    },
    questionsFiltered() {
      if (this.filter == 'all') {
        return this.questions
      } else if (this.filter == 'active') {
        return this.questions.filter(question => !question.completed)
      } else if (this.filter == 'completed') {
        return this.questions.filter(question => question.completed)
      }

      return this.questions
    },
    showClearCompletedButton() {
      return this.questions.filter(question => question.completed).length > 0
    }
  },
  methods: {
    addQuestion() {
      if (this.newQuestion.trim().length == 0) {
        return
      }

      this.questions.push({
        id: this.idForQuestion,
        title: this.newQuestion,
        completed: false,
      })

      this.newQuestion = ''
      this.idForQuestion++
    },
    removeQuestion(id) {
      const index = this.questions.findIndex((item) => item.id == id)
      this.questions.splice(index, 1)
    },
    checkAllQuestions() {
      this.questions.forEach((question) => question.completed = event.target.checked)
    },
    clearCompleted() {
      this.questions = this.questions.filter(question => !question.completed)
    },
    finishedEdit(data) {
      const index = this.questions.findIndex((item) => item.id == data.id)
      this.questions.splice(index, 1, data)
    }
  }
}
</script>

<style lang="scss">
  @import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");

  .question-input {
    width: 100%;
    padding: 10px 18px;
    font-size: 18px;
    margin-bottom: 16px;

    &:focus {
      outline: 0;
    }
  }

  .question {
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation-duration: 0.3s;
  }

  .remove-item {
    cursor: pointer;
    margin-left: 14px;
    &:hover {
      color: black;
    }
  }

  .question-left { // later
    display: flex;
    align-items: center;
  }

  .question-label {
    padding: 10px;
    border: 1px solid white;
    margin-left: 12px;
  }

  .question-edit {
    font-size: 24px;
    color: #2c3e50;
    margin-left: 12px;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc; //override defaults
    font-family: 'Avenir', Helvetica, Arial, sans-serif;

    &:focus {
      outline: none;
    }
  }

  .completed {
    text-decoration: line-through;
    color: grey;
  }

  .extra-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 16px;
    border-top: 1px solid lightgrey;
    padding-top: 14px;
    margin-bottom: 14px;
  }

  .button-question{
    font-size: 14px;
    background-color: white;
    appearance: none;

    &:hover {
      background: lightgreen;
    }

    &:focus {
      outline: none;
    }
  }

  .active {
    background: lightgreen;
  }

  // CSS Transitions
  .fade-enter-active, .fade-leave-active {
    transition: opacity .2s;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
</style>
