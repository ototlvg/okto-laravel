<template>
  <div class="question">
    <div class="question-left">
        <!-- <input type="checkbox" v-model="completed" @change="doneEdit"> -->
        <div v-if="!editing" @dblclick="editQuestion" class="question-label" >{{ title }}</div>
        <input v-else class="question-edit" type="text" v-model="title" @blur="doneEdit" @keyup.enter="doneEdit" @keyup.esc="cancelEdit" v-focus>
      </div>
      <div class="remove-item" @click="removeQuestion(question.id)">
        &times;
      </div>
  </div>
</template>

<script>
export default {
  name: 'question',
  props: {
    question: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      'id': this.question.id,
      'title': this.question.title,
      'editing': this.question.editing,
      'beforeEditCache': '',
    }
  },
  watch: {
  },
  directives: {
    focus: {
      inserted: function (el) {
        el.focus()
      }
    }
  },
  methods: {
    removeQuestion(id) {
      this.$emit('removedQuestion', id)
    },
    editQuestion() {
      this.beforeEditCache = this.title
      this.editing = true
    },
    doneEdit() {
      if (this.title.trim() == '') {
        this.title = this.beforeEditCache
      }
      this.editing = false
      this.$emit('finishedEdit', {
        'id': this.id,
        'title': this.title,
        'completed': this.completed,
        'editing': this.editing,
      })

    },
    cancelEdit() {
      this.title = this.beforeEditCache
      this.editing = false
    },
  }
}
</script>

