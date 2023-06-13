<script setup>
import { reactive, computed, provide, defineModel } from "vue";

const modelValue = defineModel();

defineProps({
    color: {
        type: String,
        default: "primary",
    },
});

const tabs = reactive({
    labels: [],
    items: [],
    active: 0,
});

const active = computed(() => {
    return tabs.active;
});

provide("tabs", tabs);

function changeTab(i) {
    tabs.active = i;
}
</script>

<template>
    <div>
        <ul class="tabs tabs-boxed">
            <label
                v-for="(label, index) in tabs.labels"
                :key="index"
                :class="`tab ${
                    index === active ? `tab-active tab-active-${color}` : ''
                }`"
                @click="changeTab(index)"
            >
                <input
                    v-model="modelValue"
                    :value="label"
                    type="radio"
                    class="hidden"
                />
                {{ label }}
            </label>
        </ul>

        <slot />
    </div>
</template>

<style lang="postcss" scoped>
.tabs-boxed {
    @apply bg-white bg-opacity-50 rounded-full gap-1;
}
.tab {
    @apply tab-lg flex-auto font-bold text-white rounded-full border-2 border-transparent hover:border-white hover:bg-white hover:bg-opacity-50;
}

.tab-active-primary {
    @apply border-primary bg-[#6BA5BE] !important;
}

.tab-active-secondary {
    @apply border-secondary bg-[#A7A282] !important;
}

.tab-active-accent {
    @apply border-accent bg-[#A766BB] !important;
}

.tab-active {
    @apply border-2 text-white !important;
}
</style>
