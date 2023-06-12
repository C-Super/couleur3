<!-- <template>
     You can open the modal using ID.showModal() method
    <button class="btn" onclick="my_modal_3.showModal()">open modal</button>
    <dialog id="my_modal_3" class="modal">
        <form method="dialog" class="modal-box gradient-auditor flex flex-col text-blue-audior">
            <button
                for="my-modal-3"
                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            >
                <span class="material-symbols-rounded text-4xl mr-4 mt-1">
                    cancel
                </span>
            </button>
            <div>
                <div v-if="typeTitre === 'avis'">
                    <span class="material-symbols-rounded text-8xl text-center">
                        sentiment_very_satisfied
                    </span>
                    <p class="font-extrabold text-xl text-center">
                        L’animateur te remercie pour ta participation
                    </p>
                </div>
                <div v-if="typeTitre === 'participation'">
                    <span class="material-symbols-rounded text-8xl text-center">
                        help
                    </span>
                    <p class="font-extrabold text-xl text-center">
                        L’animateur aimerait connaître ton avis!
                    </p>
                </div>
                <div v-if="typeTitre === 'cadeau'">
                    <span class="material-symbols-rounded text-8xl text-center">
                redeem
            </span>
                    <p class="font-extrabold text-xl text-center">
                        Vous avez gagné{{ cadeau }}
                    </p>
                </div>
                <slot />
                <BaseButton />
            </div>
        </form>
    </dialog>
</template> -->
