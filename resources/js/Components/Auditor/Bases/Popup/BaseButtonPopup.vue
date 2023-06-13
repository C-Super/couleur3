<script setup>
const props = defineProps({
    isValidate: {
        type: Boolean,
        required: true,
    },
    buttonType: {
        type: String,
        required: true,
    },
});

function clickButtonPopup() {
    if (props.buttonType === "login") {
        window.location.href = "/login";
    } else if (props.buttonType === "next") {
        window.location.href = "/profile";
    } else if (props.buttonType === "send") {
        console.log("slaut");
        // popupTitle.value = 'thanks';
        // popupButton.value = 'close';
    }
}
</script>

<template>
    <div class="flex justify-center mt-6">
        <button
            class="btn btn-md text-base rounded-full border-none w-36 h-9 min-h-0 font-bold text-base-100 bg-blue-auditor"
            :disabled="!isValidate"
            @click="clickButtonPopup"
        >
            <slot />
        </button>
    </div>
</template>
