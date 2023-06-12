import { reactive, computed } from "vue";

export default function useAnswers(answers = []) {
    const pinnedAnswers = reactive([]);

    const notPinnedAnswers = computed(() =>
        answers.filter((answer) => !pinnedAnswers.includes(answer))
    );

    const winners = reactive([]);

    const addPinned = (answer) => {
        pinnedAnswers.push(answer);
    };

    const removePinned = (answer) => {
        pinnedAnswers.splice(pinnedAnswers.indexOf(answer), 1);
    };

    const updateWinner = (updatedCandidate) => {
        if (winners.indexOf(updatedCandidate) == -1) {
            winners.push(updatedCandidate);
        } else winners.splice(winners.indexOf(updatedCandidate), 1);
    };

    return {
        pinnedAnswers,
        notPinnedAnswers,
        winners,
        addPinned,
        removePinned,
        updateWinner,
    };
}
