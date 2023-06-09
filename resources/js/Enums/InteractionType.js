export default class InteractionType {
    static get QUICK_CLICK() {
        return "quick_click";
    }

    static get CTA() {
        return "cta";
    }

    static get SURVEY() {
        return "survey";
    }

    static get MCQ() {
        return "mcq";
    }

    static isQuestion(type) {
        return type === InteractionType.SURVEY || type === InteractionType.MCQ;
    }
}
