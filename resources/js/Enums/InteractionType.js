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

    static get TEXT() {
        return "TEXT";
    }

    static get AUDIO() {
        return "AUDIO";
    }

    static get VIDEO() {
        return "VIDEO";
    }

    static get PICTURE() {
        return "PICTURE";
    }

    static isQuestion(type) {
        return type === InteractionType.SURVEY || type === InteractionType.MCQ || type === InteractionType.TEXT || type === InteractionType.AUDIO || type === InteractionType.VIDEO || type === InteractionType.PICTURE;
    }
}
