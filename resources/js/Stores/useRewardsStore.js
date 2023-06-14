import { defineStore } from "pinia";
import { ref, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useRewardsStore = defineStore("rewards", () => {
    const page = usePage();

    const rewards = ref(page.props.rewards);

    watchEffect(() => {
        rewards.value = page.props.rewards;
    });

    return { rewards };
});
