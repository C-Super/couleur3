<script setup>
import { reactive, computed, provide } from "vue";

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
            <li
                v-for="(label, index) in tabs.labels"
                :key="index"
                class="tab"
                :class="{ 'tab-active': index === active }"
                @click="changeTab(index)"
            >
                {{ label }}
            </li>
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
.tab-active {
    @apply bg-opacity-50 border-primary border-2 text-white !important;
}
</style>
