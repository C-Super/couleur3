<script setup>
import { ref, computed } from "vue";
const props = defineProps({
    responses: {
        type: Array,
        required: true,
    },
});
const pinnedResponses = ref([]);
const notPinnedResponses = computed(() =>
    props.responses.filter(
        (response) => !pinnedResponses.value.includes(response)
    )
);
function functionPinned(el) {
    pinnedResponses.value.push(el);
}
function functionUnpinned(el) {
    pinnedResponses.value.splice(pinnedResponses.value.indexOf(el), 1);
}
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
                    v-for="pinnedResponse of pinnedResponses"
                    :key="pinnedResponse.value"
                    :for="pinnedResponse.value"
                >
                    <tr class="border-none">
                        <th>
                            <label class="swap">
                                <input type="checkbox" class="hidden" />
                                <!-- icon on -->
                                <span
                                    id="fill"
                                    class="fill-current material-symbols-rounded text-5xl text-primary"
                                    @click="functionUnpinned(pinnedResponse)"
                                >
                                    push_pin
                                </span>
                            </label>
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ pinnedResponse.name }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                pinnedResponse.response
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
                                    @click="functionPinned(notPinnedResponse)"
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
