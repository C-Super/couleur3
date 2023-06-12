<script setup>
import { ref } from "vue";
import { useForm } from "laravel-precognition-vue-inertia";
const props = defineProps({
    answers: {
        type: Array,
        required: true,
    },
});
const form = useForm("post", route("interactions.winners.replace"), {
    nbWinner: "";
});

const submit = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            interactionStore.createdInteraction();
        },
    });
};
const number = ref(null);
const copyAnswers = props.answers.slice(0);
const randomWinners = [];
function fCtuion() {
    console.log(number.value);
    while (randomWinners.length < number.value)
        randomWinners.push(props.answers[1]);
}
</script>
<template>
    <form @submit.prevent="submit">
        <div class="flex join">
            <p class="flex-auto text-2xl font-semibold">
                Nombre de gagnants à sélectionner
            </p>
            <input
                id="nbOfWinner"
                v-model="number"
                type="input"
                placeholder="10"
                class="input input-bordered input-md w-20 focus:border-2 focus:border-primary focus:ring-0 bg-transparent border-white border-2 rounded-full text-xl text-center"
            />
            <button class="btn">Générer</button>
        </div>
    </form>
    <p class="text-2xl font-semibold">Sélection aléatoire</p>
    <div class="overflow-x-auto h-60">
        <!-- Array pinned -->
        <table class="table table-auto w-auto">
            <tbody
                v-for="randomWinner of randomWinners"
                :key="randomWinner.value"
                :for="randomWinner.value"
            >
                <tr class="border-none">
                    <td class="font-bold text-base">
                        <slot>{{ randomWinner.name }}</slot>
                    </td>
                    <td>
                        <slot class="text-base">{{
                            randomWinner.response
                        }}</slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
