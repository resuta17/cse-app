<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm} from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2'
 
const props = defineProps({
  categories: Array,
  question: Object
})
const crud = ref(props.question.id ? 'Update' : 'Add');


const form = useForm({
  category_id: props.question.category_id || '',
  direction: props.question.direction || '',
  question: props.question.question_text || '',
  correctAnswer: '',
  explanation: '',
  wrongChoices: ['', '', '', ''],
})

onMounted(() => {
    const correct = props.question.choices.find(choice => choice.is_correct === 1)
    form.correctAnswer = correct?.choice_text || ''
    form.explanation = correct?.explanation || ''

    const wrongs = props.question.choices
        .filter(choice => choice.is_correct === 0)
        .map(choice => choice.choice_text)

    while (wrongs.length < 4) wrongs.push('')
    form.wrongChoices = wrongs.slice(0, 4)
})
function submit() {
    if(props.question.id === null){
        form.post(route('questions.store'), {
            onSuccess: () => {
            Swal.fire({
                title: 'Success!',
                text: 'Question added successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
            })
            },
        })
    } else {
        form.put(route('questions.update',  props.question.id), {
            onSuccess: () => {
            form.reset()
            Swal.fire({
                title: 'Success!',
                text: 'Question updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then(() => {
                location.reload();
            });
            },
        })
    }
}

</script>


<template>

    <Head title="Admin" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-8 bg-white border border-gray-100 shadow-md">
                    <p class="text-center text-xl font-bold mb-4"> {{crud}} Question </p>
                    <p>Category</p>
                    <select
                    v-model="form.category_id"
                    class="w-full border p-2 border-gray-300 rounded-md mb-4"
                    >
                    <option value="Select a category" disabled>Select a category</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                    </select>
                    <p class="">Direction</p>
                    <textarea v-model="form.direction" name="Direction" id="Direction" placeholder='Type the direction here...' class="w-full border p-2 border-gray-300 rounded-md	" />
                    <p>Question</p>
                    <textarea v-model="form.question" name="question" id="question" placeholder='Type the question here' class="w-full border p-2 border-gray-300 rounded-md	" />
                    
                    <p>Correct Answer</p>
                    <input v-model="form.correctAnswer" placeholder="Correct answer" class="w-full border p-2 border-gray-300 rounded-md	mb-2" />
                    <p>Explanation</p>
                    <textarea v-model="form.explanation" name="question" id="question" placeholder='Explanation of the correct answer' class="w-full border p-2 border-gray-300 rounded-md	" />
                    <p>Wrong choices </p>
                    <input v-model="form.wrongChoices[0]" placeholder="Wrong answer No. 1" class="w-full border p-2 border-gray-300 rounded-md	mb-2" />
                    <input v-model="form.wrongChoices[1]" placeholder="Wrong answer No. 2" class="w-full border p-2 border-gray-300 rounded-md	mb-2" />
                    <input v-model="form.wrongChoices[2]" placeholder="Wrong answer No. 3" class="w-full border p-2 border-gray-300 rounded-md	mb-2" />
                    <input v-model="form.wrongChoices[3]" placeholder="Wrong answer No. 4" class="w-full border p-2 border-gray-300 rounded-md	mb-2" />
                    <div class="flex justify-end mt-4">
                        <button @click="submit()" class="bg-green-500 border rounded-lg border-white py-1 px-4 shadow-xl text-white">{{crud}}</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>