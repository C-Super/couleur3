<script setup>
defineProps({
    type: {
        type: String,
        default: "white",
    },
});
</script>

<template>
      <div class="flex justify-center">
        <button
            id="answer-choice"
            :class="`btn btn-${type} btn-wide btn-md text-lg rounded-full border-none mt-[20px] w-[228px] h-[34px] font-light text-blue-auditor `"
           style="background-color: rgba(255, 255, 255, 0.5)"
           >
           text
        </button>
    </div>
</template>
