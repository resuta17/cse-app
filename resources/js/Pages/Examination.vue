<script setup>
import Header from '@/Layouts/Header.vue'
import Footer from '@/Layouts/Footer.vue'
import { onMounted, ref, reactive, computed } from 'vue'


const correctAnswers = ref([])
const selectedAnswers = reactive({})
const currentQuestion = ref(0)

const score = computed(() => {
  if (!correctAnswers.value || !Array.isArray(correctAnswers.value)) return 0

  return correctAnswers.value.filter(correct => {
    return selectedAnswers[correct.id] === correct.value
  }).length
})

const totalAnswered = computed(() => Object.keys(selectedAnswers).length)

const wrong = computed(() => totalAnswered.value - correct.value)

const unanswered = computed(() => correctAnswers.value.length - totalAnswered.value)



const props = defineProps({
  questions: Array,
  name: String,
  id: String
})


function addAnswer(id, value) {
  correctAnswers.value.push({ id, value })
}

function next() {
    currentQuestion.value++;
    
}


onMounted(() => {
  props.questions.forEach(question => {
    question.choices.forEach(choice => {
      if (choice.is_correct) {
        addAnswer(question.id, choice.id)
      }
    })
  })
  
})


</script>

<template>
  <Header />
  <div class="bg-gray-100 h-screen">
     <div class=" flex justify-center items bg-gray-100">
       <div class=" md:w-[65%] sm:w-[90%] bg-white border shadow-lg rounded border-l-4 mt-10 mb-10">
          <div class="grid grid-flow-col auto-cols-fr w-full h-2 rounded overflow-hidden">
            <div class="bg-blue-300 h-full" :style="{ width: (totalAnswered*5) + '%' }"></div> 
          </div>
          <div class="flex justify-end px-10">
             <p class="mt-2">Question {{ currentQuestion + 1 }} of {{ questions.length }}</p>
          </div>
           
          <div class="px-10 pb-16 pt-6">
             
              <div>
                
                <p class=" text-2xl font-extrabold text-center mb-4">{{ name }}</p>
                <hr class="mb-10">
            
              <div v-if="question = questions[currentQuestion]">
                <p class="font-semibold mb-4">{{ currentQuestion + 1 }}. {{ question.question_text }}</p>

                <div
                  v-for="choice in question.choices"
                  :key="choice.id"
                  class="flex items-start space-x-2 mb-1 border border-gray-300 px-2 py-1 rounded"
                  :class="{
                    'bg-green-100 border-l-4 border-green-500 ': selectedAnswers[question.id] !== undefined && choice.is_correct,
                    'bg-red-100 border-l-4 border-red-500 ': selectedAnswers[question.id] === choice.id && !choice.is_correct
                  }"
                >
                  <input
                    type="radio"
                    :name="'question_' + question.id"
                    :value="choice.id"
                    v-model="selectedAnswers[question.id]"
                    :disabled="selectedAnswers[question.id] !== undefined"
                    class="mt-1"
                  />
                  <label>{{ choice.choice_text }}</label>
                </div>
                
                <div v-show="selectedAnswers[question.id] !== undefined" class="my-8 flex justify-end space-x-4 px-2">
                  <button @click="next" :disabled="selectedAnswers[question.id] === undefined"
                  class="bg-green-600  border-green-100 py-1 px-4 rounded shadow-sm border text-white"
                  >Next</button>
                </div>
            
                <div v-show="selectedAnswers[question.id] !== undefined">
                  <p v-if="question.choices.find(c => c.is_correct)?.explanation" class="text-sm text-gray-700 mt-2 bg-gray-200 border rounded p-2">
                    Explanation:
                    {{ question.choices.find(c => c.is_correct)?.explanation }}
                  </p>
                </div>
              </div>
              </div>
          </div>
       </div>
        
    </div>
    
  </div>
 
  
<!-- <div v-for="(question, index) in questions" :key="question.id" class="mb-6 px-40 py-5">
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
      :disabled="selectedAnswers[question.id] !== undefined"
      class="mt-1"
    />
    <label>{{ choice.choice_text }}</label>
  </div>

  <div class="p-10" v-if="selectedAnswers[question.id] !== undefined">
    <p v-if="question.choices.find(c => c.is_correct)?.explanation" class="text-sm text-gray-700 mt-1 bg-gray-200">
      💡 Explanation:
      {{ question.choices.find(c => c.is_correct)?.explanation }}
    </p>
  </div>
</div> -->

 <Footer />
</template>
