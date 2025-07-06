<script setup>
import Header from '@/Layouts/Header.vue'
import Footer from '@/Layouts/Footer.vue'
import { onMounted, ref, reactive, computed } from 'vue'
import { router } from '@inertiajs/vue3';


const correctAnswers = ref([])
const selectedAnswers = reactive({})
const currentQuestion = ref(0)
const done = ref(false)

const totalAnswered = computed(() => Object.keys(selectedAnswers).length)

const correctPercentage =  computed(() =>(score.value / props.questions.length) * 100)

const score = computed(() => {
  if (!correctAnswers.value || !Array.isArray(correctAnswers.value)) return 0

  return correctAnswers.value.filter(correct => {
    return selectedAnswers[correct.id] === correct.value
  }).length
})

const TakeExamination = (cat, catID) => {
  router.visit(route('practice', { name: cat ,id: catID}));
};

const props = defineProps({
  questions: Array,
  name: String,
  id: String
})

function addAnswer(id, value) {
  correctAnswers.value.push({ id, value })
}

function next() {
    currentQuestion.value++
}

function finish() {
   done.value = true;
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

  <div class="bg-gray-100 h-screen mb-4">
     <div class=" flex justify-center items bg-gray-100">
       <div class=" md:w-[65%] sm:w-[90%] bg-white border shadow-lg rounded border-l-4 mt-10 mb-10" v-show="done === false">
          <div class="grid grid-flow-col auto-cols-fr w-full h-2 rounded overflow-hidden">
            <div class="bg-blue-300 h-full" :style="{ width: (totalAnswered*5) + '%' }"></div> 
          </div>
          <div class="flex justify-end px-10">
             <p class="mt-2">Question {{ currentQuestion + 1 }} of {{ questions.length }}</p>
          </div>
           
          <div class="px-10 pb-16 pt-6">      
              <div>
                <p class=" text-2xl font-extrabold text-center mb-4">{{ name }}</p>
                <hr class="mb-2">
             
              <div v-if="question = questions[currentQuestion]">
                <p class="mb-10"><span class="font-bold">Direction: </span><span>{{ question.direction }}</span></p>
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
                
                <div  class="my-8 flex justify-end space-x-4 px-2">
                  <button v-show="selectedAnswers[question.id] !== undefined && questions.length !== totalAnswered" @click="next" :disabled="selectedAnswers[question.id] === undefined "
                  class="bg-green-600  border-green-100 py-1 px-4 rounded shadow-sm border text-white"
                  > Next </button>
                  <button v-show=" questions.length === totalAnswered"
                  class="bg-green-600  border-green-100 py-1 px-4 rounded shadow-sm border text-white" @click="finish"
                  > Finish </button>
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
       
       <div class="md:w-[65%]  md:h-[90%] sm:w-[90%] bg-white border shadow-lg rounded border-l-4 mt-10 mb-10 flex justify-center items-center p-10" v-show="done===true">
            <div>
                <h2 class="text-2xl font-bold text-blue-600 mb-4 text-center">{{ name }} Category Results</h2>
            
                <p class="text-gray-700 text-lg text-center">
                  You scored: <span class="font-semibold text-red-600"> {{ score }}</span> out of <span class="font-semibold text-black">{{questions.length}}</span>
                </p>
                
                <p class="text-gray-700 text-lg mt-2 text-center">
                  Percentage: <span class="font-semibold text-green-600">{{ correctPercentage }}%</span>
                </p>

                <p class="mt-4 text-sm text-gray-500 italic">
                  Keep practicing to improve your {{ name.toLowerCase() }} skills!
                </p>
                <div class="mt-4">
                    <button @click="TakeExamination( name ,id)">{{ name }}</button>
                </div>
            </div>
       </div>
    </div>
  </div>
 
  
 <Footer />
</template>
