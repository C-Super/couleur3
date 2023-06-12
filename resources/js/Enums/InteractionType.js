export default class InteractionType {
    static get QUICK_CLICK() {
        return "QUICK_CLICK";
    }

    static get CTA() {
        return "CTA";
    }

    static get SURVEY() {
        return "SURVEY";
    }

    static get MCQ() {
        return "MCQ";
    }

    static isQuestion(type) {
        return type === InteractionType.SURVEY || type === InteractionType.MCQ;
    }
}
