<script setup>
defineEmits(["add:pinned", "remove:pinned"]);

defineProps({
    pinnedAnswers: {
        type: Array,
        required: true,
    },
    notPinnedResponses: {
        type: Array,
        required: true,
    },
});
</script>
<template>
    <p class="text-2xl font-semibold">Réponse obtenues</p>
    <p class="font-light">
        Cliquez sur les réponses que vous souhaitez épingler en haut de la
        liste.
    </p>
    <div class="overflow-x-auto h-60">
        <div>
            <!-- Array pinned -->
            <table class="table table-auto w-auto">
                <tbody
                    v-for="pinnedAnswer of pinnedAnswers"
                    :key="pinnedAnswer.value"
                    :for="pinnedAnswer.value"
                >
                    <tr class="border-none">
                        <th>
                            <label class="swap">
                                <input type="checkbox" class="hidden" />
                                <!-- icon on -->
                                <span
                                    id="fill"
                                    class="fill-current material-symbols-rounded text-5xl text-primary"
                                    @click="
                                        $emit('remove:pinned', pinnedAnswer)
                                    "
                                >
                                    push_pin
                                </span>
                            </label>
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ pinnedAnswer.name }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                pinnedAnswer.response
                            }}</slot>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <!-- Array not pinned -->
            <table class="table table-auto w-auto">
                <tbody
                    v-for="notPinnedResponse of notPinnedResponses"
                    :key="notPinnedResponse.value"
                    :for="notPinnedResponse.value"
                >
                    <tr class="border-none">
                        <th>
                            <label class="swap">
                                <input type="checkbox" class="hidden" />
                                <!-- icon off -->
                                <span
                                    class="fill-current material-symbols-rounded text-5xl"
                                    @click="
                                        $emit('add:pinned', notPinnedResponse)
                                    "
                                >
                                    push_pin
                                </span>
                            </label>
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ notPinnedResponse.name }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                notPinnedResponse.response
                            }}</slot>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<style>
#fill.material-symbols-rounded {
    font-variation-settings: "FILL" 1, "wght" 400, "GRAD" 0, "opsz" 48;
}
</style>
