<template>
    <div :class="`flex flex-row gap-3 h-[${barMaxHeight}px] items-end`">
        <div
            v-for="dataItem of data"
            :id="dataItem.id"
            :key="dataItem.id"
            :style="`height: ${getHeights(dataItem.value)}px`"
            class="bar"
            :class="`grid grid-cols-1 bg-${getBarColor(
                dataItem.id
            )} bg-opacity-50 rounded-t-[20px] w-full justify-items-center content-between`"
        >
            <div>{{ dataItem.value }}</div>
            <div class="text-[#1c1354] text-lg font-bold">
                {{ dataItem.label }}
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    data: {
        type: Array,
        required: true,
    },
    correct: {
        type: String,
        default: null,
    },
});

const getBarColor = (barId) => {
    if (+props.correct === barId) {
        return "primary";
    } else {
        return "white";
    }
};

const barMaxHeight = 200;
const values = [];
props.data.forEach((dataItem) => {
    values.push(dataItem.value);
});
const getHeights = (value) => {
    return (value / Math.max(...values)) * (barMaxHeight - 30) + 30;
};
</script>
