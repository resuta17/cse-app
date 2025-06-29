<script setup>
import Header from '@/Layouts/Header.vue'
import { onMounted, ref, reactive } from 'vue'


const correctAnswers = ref([])
const selectedAnswers = reactive({})

const props = defineProps({
  questions: Array,
  name: String
})


function addAnswer(id, value) {
  correctAnswers.value.push({ id, value })
}

function handleAnswerChange(question) {
  
}


onMounted(() => {
  props.questions.forEach(question => {
    question.choices.forEach(choice => {
      if (choice.is_correct) {
        addAnswer(question.id, choice.choice_text)
      }
    })
  })
  
})


</script>

<template>
  <Header />
  
<div v-for="(question, index) in questions" :key="question.id" class="mb-6 px-40 py-5">
  <p class="font-semibold mb-2">{{ index + 1 }}. {{ question.question_text }}</p>

  <div
    v-for="choice in question.choices"
    :key="choice.id"
    class="flex items-start space-x-2 mb-1"
    :class="{
      'bg-green-100 border-l-4 border-green-500 px-2 py-1 rounded': selectedAnswers[question.id] !== undefined && choice.is_correct,
      'bg-red-100 border-l-4 border-red-500 px-2 py-1 rounded': selectedAnswers[question.id] === choice.id && !choice.is_correct
    }"
  >
    <input
      type="radio"
      :name="'question_' + question.id"
      :value="choice.id"
      v-model="selectedAnswers[question.id]"
      @change="handleAnswerChange(question)"
      :disabled="selectedAnswers[question.id] !== undefined"
      class="mt-1"
    />
    <label>{{ choice.choice_text }}</label>
  </div>

  <div v-if="selectedAnswers[question.id] !== undefined">
    <p v-if="question.choices.find(c => c.is_correct)?.explanation" class="text-sm text-gray-700 mt-1 bg-gray-200">
      💡 Explanation:
      {{ question.choices.find(c => c.is_correct)?.explanation }}
    </p>
  </div>
</div>


</template>
